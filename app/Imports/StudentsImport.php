<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\Grade;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Events\ImportFailed;

class StudentsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithEvents, SkipsEmptyRows
{
    use Importable, SkipsFailures;

    protected $schoolId;

    public function __construct()
    {
        $this->schoolId = auth('school')->id();
    }

    /**
     * Prepare data before validation runs.
     */
    public function prepareForValidation($data, $index)
    {
        // Skip if the row is empty
        if ($this->isRowEmpty($data)) {
            return [];
        }

        $data = array_change_key_case($data, CASE_LOWER);

        // Trim all string values
        foreach ($data as $key => $value) {
            $data[$key] = is_string($value) ? trim($value) : $value;
        }

        /**
         * Handle different date formats safely
         */
        if (!empty($data['dob'])) {
            try {
                if (is_numeric($data['dob'])) {
                    // Excel date number format
                    $data['dob'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['dob'])->format('Y-m-d');
                } else {
                    // Try to parse known formats (with or without time)
                    $possibleFormats = ['d-m-Y', 'd/m/Y', 'Y-m-d', 'Y/m/d', 'd-m-Y H:i', 'Y-m-d H:i:s'];

                    foreach ($possibleFormats as $format) {
                        try {
                            $data['dob'] = Carbon::createFromFormat($format, $data['dob'])->format('Y-m-d');
                            break;
                        } catch (\Exception $e) {
                            // keep trying formats
                        }
                    }
                }
            } catch (\Exception $e) {
                // If still invalid, nullify date
                $data['dob'] = null;
            }
        }

        // Convert numeric B-Form to string
        if (!empty($data['b_form']) && !is_string($data['b_form'])) {
            $data['b_form'] = (string) $data['b_form'];
        }

        return $data;
    }

    /**
     * Skip empty rows before processing.
     */

    protected function isRowEmpty(array $row): bool
    {
        return collect($row)->filter(fn($v) => !is_null($v) && trim($v) !== '')->isEmpty();
    }

    /**
     * Create model for valid rows.
     */

    public function model(array $row)
    {
        if ($this->isRowEmpty($row)) {
            return null;
        }

        $row = array_change_key_case($row, CASE_LOWER);

        // === Find Grade ===
        $grade = Grade::where('name', trim($row['grade'] ?? ''))->first();
        if (!$grade) {
            throw new \Exception("Grade '{$row['grade']}' not found in database.");
        }

        // === Duplicate check ===
        $exists = Student::where('school_id', $this->schoolId)
            ->where('grade_id', $grade->id)
            ->where(function ($q) use ($row) {
                $q->where('roll_number', $row['roll_number'])
                  ->orWhere('b_form', $row['b_form']);
            })
            ->exists();

        if ($exists) {
            return null; // skip duplicates
        }

        // === Create Student ===
        return new Student([
            'school_id'     => $this->schoolId,
            'grade_id'      => $grade->id,
            'student_name'  => $row['student_name'],
            'father_name'   => $row['father_name'],
            'gender'        => $row['gender'],
            'section'       => $row['section'] ?? '',
            'roll_number'   => $row['roll_number'],
            'date_of_birth' => $row['dob'], // already formatted properly
            'b_form'        => $row['b_form'],
        ]);
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            '*.grade'         => 'required|string',
            '*.student_name'  => 'required|string',
            '*.father_name'   => 'required|string',
            '*.gender'        => 'required|string|in:Male,Female,Other',
            '*.section'       => 'nullable|string',
            '*.roll_number'   => 'required',
            '*.dob'           => 'required|date',
            '*.b_form'        => 'required|string',
        ];
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                // Optional: handle global import failure
            },
        ];
    }
}
