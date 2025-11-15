<?php
namespace App\Services;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\ItemBank;
use App\Models\PaperFormat;
use App\Models\GeneratedPaper;
use Illuminate\Support\Facades\Auth;

class PaperGeneratorService
{
    public function generate(array $data, $districtId, $academicYear)
    {
        try {
            // 1. Fetch latest format (school paper format)
            $format = PaperFormat::where('paper_type', $data['paper_type'])
                ->where('school_id', Auth::user()->id)
                ->latest('version')
                ->first();

            if (! $format) {
                return ['error' => 'No paper format found. Please create one first.'];
            }

            // Fetch grade & subject details
            $grade   = Grade::select('id', 'name')->find($data['grade_id']);
            $subject = Subject::select('id', 'name')->find($data['subject_id']);

            if (! $grade || ! $subject) {
                return ['error' => 'Grade or subject not found.'];
            }

            // 2. Check if existing paper already exists
            $existingQuery = GeneratedPaper::where([
                'district_id'   => $districtId,
                'grade_id'      => $data['grade_id'],
                'subject_id'    => $data['subject_id'],
                'paper_type'    => $data['paper_type'],
                'month'         => $data['month'] ?? null,
                'semester'      => $data['semester'] ?? null,
                'academic_year' => $academicYear,
                'version'       => $format->version,
            ]);

            if ($data['paper_type'] === 'formative' && ! empty($data['month'])) {
                $existingQuery->where('month', $data['month']);
            } elseif ($data['paper_type'] === 'semester' && ! empty($data['semester'])) {
                $existingQuery->where('semester', $data['semester']);
            }

            $existingPaper = $existingQuery->first();

            if ($existingPaper) {
                return $this->prepareResponse($existingPaper, $format, $grade, $subject);
            }
            // 3. Generate a new paper
            return $this->createNewPaper($data, $districtId, $academicYear, $format, $grade, $subject);

        } catch (\Exception $e) {

            return [
                'error'   => 'Something went wrong while generating the paper.',
                'message' => $e->getMessage(),
            ];
        }
    }

    protected function prepareResponse(GeneratedPaper $paper, PaperFormat $format, $grade, $subject)
    {
        $questionIds = is_array($paper->question_ids)
            ? $paper->question_ids
            : json_decode($paper->question_ids, true);

        $items = ItemBank::whereIn('id', $questionIds)->get();

        return [
            'paper_type'    => $paper->paper_type,
            'month'         => $paper->month,
            'semester'      => $paper->semester,
            'grade'         => $grade->name,
            'subject'       => $subject->name,
            'items'         => $items->values(),
            'total_marks'   => $paper->total_marks,
            'version'       => $format->version,
            'academic_year' => $paper->academic_year,
            'paper_id'      => $paper->id,
        ];
    }

    protected function createNewPaper(array $data, $districtId, $academicYear, PaperFormat $format, $grade, $subject)
    {
        $baseQuery = ItemBank::where('grade_id', $data['grade_id'])
            ->where('subject_id', $data['subject_id']);

        if ($data['paper_type'] === 'formative' && ! empty($data['month'])) {
            $baseQuery->where('month', $data['month']);
        } elseif ($data['paper_type'] === 'semester' && ! empty($data['semester'])) {
            $baseQuery->where('semester', $data['semester']);
        }

        $itemsCollection = collect();

        $distributions = [
            'MCQ' => ['easy' => $format->mcq_easy, 'medium' => $format->mcq_medium, 'hard' => $format->mcq_hard],
            'FIB' => ['easy' => $format->fib_easy, 'medium' => $format->fib_medium, 'hard' => $format->fib_hard],
            'RRQ' => ['easy' => $format->rrq_easy, 'medium' => $format->rrq_medium, 'hard' => $format->rrq_hard],
            'ERQ' => ['easy' => $format->erq_easy, 'medium' => $format->erq_medium, 'hard' => $format->erq_hard],
        ];

        foreach ($distributions as $type => $levels) {
            foreach ($levels as $difficulty => $count) {
                if ($count > 0) {
                    $queryClone       = clone $baseQuery;
                    $alreadyPickedIds = $itemsCollection->pluck('id')->toArray();

                    $fetched = $queryClone
                        ->whereNotIn('id', $alreadyPickedIds)
                        ->where('item_type', $type)
                        ->where('difficulty', ucfirst($difficulty))
                        ->inRandomOrder()
                        ->take($count)
                        ->get();

                    $itemsCollection = $itemsCollection->merge($fetched);
                }
            }
        }

        if ($itemsCollection->count() === 0) {
            return [
                'paper_type'  => $data['paper_type'],
                'month'       => $data['month'] ?? null,
                'semester'    => $data['semester'] ?? null,
                'grade'       => $grade->name,
                'subject'     => $subject->name,
                'items'       => [],
                'total_marks' => 0,
                'version'     => $format->version,
                'paper_id'    => null,
            ];
        }

        $itemsCollection = $itemsCollection->shuffle()->values();
        $totalMarks      = $itemsCollection->sum('total_marks');

        $paper = GeneratedPaper::create([
            'district_id'   => $districtId,
            'grade_id'      => $data['grade_id'],
            'subject_id'    => $data['subject_id'],
            'paper_type'    => $data['paper_type'],
            'month'         => $data['month'] ?? null,
            'semester'      => $data['semester'] ?? null,
            'version'       => $format->version,
            'academic_year' => $academicYear,
            'question_ids'  => $itemsCollection->pluck('id')->toArray(),
            'total_marks'   => $totalMarks,
        ]);

        return [
            'paper_type'    => $data['paper_type'],
            'month'         => $data['month'] ?? null,
            'semester'      => $data['semester'] ?? null,
            'grade'         => $grade->name,
            'subject'       => $subject->name,
            'items'         => $itemsCollection,
            'total_marks'   => $totalMarks,
            'version'       => $format->version,
            'academic_year' => $paper->academic_year,
            'paper_id'      => $paper->id,
        ];
    }
}
