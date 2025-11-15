<?php

namespace App\Imports;

use App\Models\ItemBank;
use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class ItemBankImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    use \Maatwebsite\Excel\Concerns\Importable;

    protected $rows = [];

    public function prepareForValidation($data, $index)
    {
        if (isset($data['item_type'])) {
            $data['item_type'] = strtoupper(trim($data['item_type']));
        }

        $this->rows[$index] = $data;
        return $data;
    }

    public function model(array $row)
    {
        if ($this->isRowEmpty($row)) {
            return null;
        }

        $subject = Subject::where('name', trim($row['subject'] ?? ''))->first();
        $grade   = Grade::where('name', trim($row['grade'] ?? ''))->first();

        if (!$subject || !$grade) {
            return null;
        }

        return new ItemBank([
            'subject_id'       => $subject->id,
            'grade_id'         => $grade->id,
            'slo'              => $row['slo'] ?? null,
            'slo_no'           => $row['slo_no'] ?? null,
            'skill'            => $row['skill'] ?? null,
            'semester'         => $row['semester'] ?? null,
            'month'            => $row['month'] ?? null,
            'difficulty'       => $row['difficulty'] ?? null,
            'category'         => $row['category'] ?? null,
            'item_type'        => $row['item_type'] ?? null,
            'item_description' => $row['item_description'] ?? null,
            'stimulus'         => $row['stimulus'] ?? null,
            'option_a'         => $row['option_a'] ?? null,
            'option_b'         => $row['option_b'] ?? null,
            'option_c'         => $row['option_c'] ?? null,
            'option_d'         => $row['option_d'] ?? null,
            'correct_answer'   => $row['correct_answer'] ?? null,
            'possible_answers' => $row['possible_answers'] ?? null,
            'marking_hints'    => $row['marking_hints'] ?? null,
            'rubric'           => $row['rubric'] ?? null,
            'total_marks'      => $this->parseTotalMarks($row['total_marks'] ?? null),
        ]);
    }

    public function rules(): array
    {
        return [
            'subject'         => ['required', Rule::exists('subjects', 'name')],
            'grade'           => ['required', Rule::exists('grades', 'name')],
            'item_type'       => ['required', Rule::in(['MCQ', 'RRQ', 'ERQ'])],
            'option_a'        => ['nullable', 'required_if:item_type,MCQ'],
            'option_b'        => ['nullable', 'required_if:item_type,MCQ'],
            'option_c'        => ['nullable', 'required_if:item_type,MCQ'],
            'option_d'        => ['nullable', 'required_if:item_type,MCQ'],
            'correct_answer'  => ['nullable', 'required_if:item_type,MCQ'],
            'possible_answers'=> ['nullable', 'required_if:item_type,RRQ'],
            'rubric'          => ['nullable', 'required_if:item_type,ERQ'],
            'total_marks'     => ['nullable', 'required_if:item_type,RRQ,ERQ', 'integer', 'min:1'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'subject.required'          => 'The subject field is required.',
            'subject.exists'            => 'The provided subject does not exist.',
            'grade.required'            => 'The grade field is required.',
            'grade.exists'              => 'The provided grade does not exist.',
            'item_type.required'        => 'Item type is required (MCQ, RRQ, or ERQ).',
            'item_type.in'              => 'Item type must be MCQ, RRQ, or ERQ.',

            'option_a.required_if'      => 'For MCQ type, Option A is required.',
            'option_b.required_if'      => 'For MCQ type, Option B is required.',
            'option_c.required_if'      => 'For MCQ type, Option C is required.',
            'option_d.required_if'      => 'For MCQ type, Option D is required.',
            'correct_answer.required_if'=> 'For MCQ type, the Correct Answer is required.',

            'possible_answers.required_if' => 'For RRQ type, Possible Answers are required.',
            'rubric.required_if'        => 'For ERQ type, Rubric is required.',
            'total_marks.required_if'   => 'For RRQ or ERQ type, Total Marks are required.',
            'total_marks.integer'       => 'Total Marks must be a whole number.',
            'total_marks.min'           => 'Total Marks must be at least 1.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($validator->getData() as $key => $data) {
                $itemType = strtoupper(trim($data['item_type'] ?? ''));

                // Additional validation for MCQ correct_answer
                if ($itemType === 'MCQ' && isset($data['correct_answer'])) {
                    $correctAnswer = strtoupper(trim($data['correct_answer']));
                    if (!in_array($correctAnswer, ['A', 'B', 'C', 'D'])) {
                        $validator->errors()->add(
                            "{$key}.correct_answer",
                            'Correct Answer for MCQ must be A, B, C, or D.'
                        );
                    }
                }
            }
        });
    }

    private function isRowEmpty(array $row): bool
    {
        // Check if all required fields are empty
        $requiredFields = ['subject', 'grade', 'item_type'];

        foreach ($requiredFields as $field) {
            if (isset($row[$field]) && !is_null($row[$field]) && trim((string)$row[$field]) !== '') {
                return false;
            }
        }

        return true;
    }

    private function parseTotalMarks($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        return null;
    }
}
