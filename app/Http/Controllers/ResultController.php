<?php
namespace App\Http\Controllers;

use App\Models\GeneratedPaper;
use App\Models\Grade;
use App\Models\ItemBank;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    // show form
    public function index()
    {
        $school   = auth('school')->user();
        $grades   = Grade::orderBy('name')->get(['id', 'name']);
        $subjects = Subject::orderBy('name')->get(['id', 'name']);

        return view('school.results.create', compact('grades', 'subjects', 'school'));
    }

    // fetch the specific generated paper based on selection and current academic year
    public function fetchPaper(Request $request)
    {
        $validated = $request->validate([
            'paper_type' => 'required|in:formative,semester',
            'grade_id'   => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'month'      => 'nullable|string',
            'semester'   => 'nullable|string',
        ]);

        $school      = auth('school')->user();
        $districtId  = $school->district_id;
        $currentYear = date('Y'); //  Automatically detect current year

        // Base query with current academic year filter
        $query = GeneratedPaper::where('district_id', $districtId)
            ->where('grade_id', $validated['grade_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('paper_type', $validated['paper_type'])
            ->where('academic_year', $currentYear); //  auto filter by current year

        // Apply month/semester filter
        if ($validated['paper_type'] === 'formative') {
            if (empty($validated['month'])) {
                return response()->json(['error' => 'Month is required for formative papers.'], 422);
            }
            $query->where('month', $validated['month']);
        } else {
            if (empty($validated['semester'])) {
                return response()->json(['error' => 'Semester is required for semester papers.'], 422);
            }
            $query->where('semester', $validated['semester']);
        }

        // Get latest version of that paper
        $paper = $query->latest('version')->first();

        if (! $paper) {
            return response()->json(['error' => 'No generated paper found for this selection.'], 404);
        }

        // Load questions (maintain order)
        $questionIds      = $paper->question_ids ?? [];
        $questions        = ItemBank::whereIn('id', $questionIds)->get()->keyBy('id');
        $orderedQuestions = collect($questionIds)
            ->map(fn($id) => $questions->get($id))
            ->filter();

        // Fetch students of that school
        $students = Student::where('school_id', $school->id)
            ->where('grade_id', $validated['grade_id'])
            ->orderBy('student_name')
            ->get(['id', 'student_name']);

        // Prepare per-question marks
        $perQuestionMarks = [];
        foreach ($orderedQuestions as $q) {
            $perQuestionMarks[$q->id] = (int) ($q->total_marks ?? 0);
        }

        // Fetch existing results for this paper
        $results = Result::where('paper_id', $paper->id)
            ->get(['student_id', 'marks']);

        // Decode stored marks
        $studentResults = $results->mapWithKeys(function ($r) {
            return [$r->student_id => json_decode($r->marks, true)];
        });

        // Send response
        return response()->json([
            'paper'              => [
                'id'            => $paper->id,
                'grade'         => $paper->grade_id,
                'subject'       => $paper->subject_id,
                'paper_type'    => $paper->paper_type,
                'month'         => $paper->month,
                'semester'      => $paper->semester,
                'academic_year' => $paper->academic_year,
                'version'       => $paper->version,
                'total_marks'   => $paper->total_marks,
            ],
            'questions'          => $orderedQuestions->map(function ($q) {
                return [
                    'id'               => $q->id,
                    'item_description' => $q->item_description,
                    'item_type'        => $q->item_type,
                    'total_marks'      => (int) ($q->total_marks ?? 0),
                ];
            })->values(),
            'students'           => $students,
            'per_question_marks' => $perQuestionMarks,
            'existing'           => $studentResults,
        ]);
    }

    // store results in bulk
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paper_id' => 'required|exists:generated_papers,id',
            'results'  => 'required|array', // results[student_id][question_id]
        ]);

        $school     = auth('school')->user();
        $paper      = GeneratedPaper::findOrFail($validated['paper_id']);
        $savedCount = 0;

        foreach ($validated['results'] as $studentId => $questions) {
            // Skip rows where teacher didn’t enter any marks
            $totalObtained = collect($questions)->sum();
            if ($totalObtained <= 0) {
                continue;
            }

            // Calculate total paper marks from question marks
            $totalMarks = $paper->total_marks ?? collect($questions)->count() * 1;

            // Save or update
            Result::updateOrCreate(
                [
                    'paper_id'   => $paper->id,
                    'student_id' => $studentId,
                ],
                [
                    'school_id'      => $school->id,
                    'marks'          => json_encode($questions), // store all question marks
                    'total_obtained' => $totalObtained,
                    'total_marks'    => $totalMarks,
                    'remarks'        => $request->input("remarks.$studentId") ?? null,
                ]
            );

            $savedCount++;
        }

        if ($savedCount === 0) {
            return response()->json(['message' => 'No marks were entered. Nothing was saved.']);
        }

        return response()->json(['message' => "$savedCount student result(s) saved successfully."]);
    }
}
