<?php

namespace App\Exports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class StudentsSampleExport implements WithHeadings, WithEvents
{
    use Exportable;

    /**
     * Define the heading row for Excel export
     */
    public function headings(): array
    {
        return [
            'grade',
            'student_name',
            'father_name',
            'gender',
            'section',
            'roll_number',
            'dob',      // Date of Birth column (G)
            'b_form',
        ];
    }

    /**
     * Register Excel sheet styling and validation events
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // === Adjust column widths for better visibility ===
                foreach (range('A', 'H') as $column) {
                    $sheet->getColumnDimension($column)->setWidth(22);
                }

                // === Fetch all grade names dynamically ===
                $grades = Grade::pluck('name')->toArray();
                $gradesList = implode(',', $grades);

                // === Apply dropdowns for first 1000 rows ===
                for ($row = 2; $row <= 1000; $row++) {

                    // Grade dropdown (Column A)
                    $validationGrade = $sheet->getCell("A{$row}")->getDataValidation();
                    $validationGrade->setType(DataValidation::TYPE_LIST);
                    $validationGrade->setErrorStyle(DataValidation::STYLE_STOP);
                    $validationGrade->setAllowBlank(false);
                    $validationGrade->setShowInputMessage(true);
                    $validationGrade->setShowErrorMessage(true);
                    $validationGrade->setShowDropDown(true);
                    $validationGrade->setFormula1('"' . $gradesList . '"');
                    $validationGrade->setErrorTitle('Invalid Grade');
                    $validationGrade->setError('Please select a valid grade from the dropdown.');

                    // Gender dropdown (Column D)
                    $validationGender = $sheet->getCell("D{$row}")->getDataValidation();
                    $validationGender->setType(DataValidation::TYPE_LIST);
                    $validationGender->setErrorStyle(DataValidation::STYLE_STOP);
                    $validationGender->setAllowBlank(false);
                    $validationGender->setShowInputMessage(true);
                    $validationGender->setShowErrorMessage(true);
                    $validationGender->setShowDropDown(true);
                    $validationGender->setFormula1('"Male,Female,Other"');
                    $validationGender->setErrorTitle('Invalid Gender');
                    $validationGender->setError('Please select Male, Female, or Other.');
                }

                // === Set Date Format (G2:G1000) ===
                // ⚠ FIXED: replaced deprecated FORMAT_DATE_YYYYMMDD2 with FORMAT_DATE_YYYYMMDD
                $sheet->getStyle('G2:G1000')
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);

                       // === Apply light background to heading row ===
                $sheet->getStyle('A1:U1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'E8F0FE'], // Light blue shade
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '000000'], // Black text
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);


                // === Lock header row (A1:H1) ===
                $sheet->getStyle('A1:H1')->getProtection()->setLocked(true);

                // === Unlock data cells so user can edit them ===
                $sheet->getStyle('A2:H1000')->getProtection()->setLocked(false);

                // === Protect the sheet from structure changes ===
                $sheet->getProtection()->setSheet(true);
                // Optional: set password for sheet protection
                // $sheet->getProtection()->setPassword('secure123');
            },
        ];
    }
}
