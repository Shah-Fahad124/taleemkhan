<?php

namespace App\Exports;

use App\Models\Subject;
use App\Models\Grade;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ItemBankSampleExport implements WithHeadings, WithEvents
{
    use Exportable;

    public function headings(): array
    {
        return [
            'subject',           // Dropdown (Subjects)
            'grade',             // Dropdown (Grades)
            'slo',               // Optional
            'slo_no',            // Optional
            'skill',             // Optional
            'semester',          // Dropdown (Fall / Spring)
            'month',             // Dropdown (Months)
            'difficulty',        // Dropdown (Easy / Medium / Hard)
            'category',          // Dropdown (Knowledge, Understanding, etc.)
            'item_type',         // Dropdown (MCQ, RRQ, ERQ)
            'item_description',  // Required
            'stimulus',          // Optional
            'option_a',          // Required if MCQ
            'option_b',          // Required if MCQ
            'option_c',          // Required if MCQ
            'option_d',          // Required if MCQ
            'correct_answer',    // Required if MCQ
            'possible_answers',  // Required if RRQ
            'marking_hints',     // Optional
            'rubric',            // Required if ERQ
            'total_marks',       // Required if RRQ or ERQ
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // === Adjust column widths for readability ===
                foreach (range('A', 'U') as $column) {
                    $sheet->getColumnDimension($column)->setWidth(22);
                }

                // === Dropdown data lists ===
                $subjects      = Subject::pluck('name')->toArray();
                $grades        = Grade::pluck('name')->toArray();
                $semestersList = 'Fall,Spring';
                $monthsList    = 'January,February,March,April,May,June,July,August,September,October,November,December';
                $difficulties  = 'Easy,Medium,Hard';
                $categories    = 'Knowledge,Understanding,Application,Synthesis,Evaluation';
                $itemTypes     = 'MCQ,RRQ,ERQ';

                $subjectsList  = implode(',', $subjects);
                $gradesList    = implode(',', $grades);

                // === Apply dropdowns for up to 1000 rows ===
                for ($row = 2; $row <= 1000; $row++) {
                    // Subject (A)
                    $this->applyDropdown($sheet, "A{$row}", $subjectsList);

                    // Grade (B)
                    $this->applyDropdown($sheet, "B{$row}", $gradesList);

                    // Semester (F)
                    $this->applyDropdown($sheet, "F{$row}", $semestersList);

                    // Month (G)
                    $this->applyDropdown($sheet, "G{$row}", $monthsList);

                    // Difficulty (H)
                    $this->applyDropdown($sheet, "H{$row}", $difficulties);

                    // Category (I)
                    $this->applyDropdown($sheet, "I{$row}", $categories);

                    // Item Type (J)
                    $this->applyDropdown($sheet, "J{$row}", $itemTypes);
                }

                // === Keep month column as text format ===
                $sheet->getStyle('G2:G1000')->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_TEXT);


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


                // === Lock header row and protect sheet ===
                $sheet->getStyle('A1:U1')->getProtection()->setLocked(true);
                $sheet->getStyle('A2:U1000')->getProtection()->setLocked(false);
                $sheet->getProtection()->setSheet(true);
            },
        ];
    }

    /**
     * Helper method to apply dropdown validation
     */
    private function applyDropdown($sheet, string $cell, string $list): void
    {
        $validation = $sheet->getCell($cell)->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setErrorStyle(DataValidation::STYLE_STOP);
        $validation->setAllowBlank(true);
        $validation->setShowDropDown(true);
        $validation->setFormula1('"' . $list . '"');
        $validation->setErrorTitle('Invalid Input');
        $validation->setError('Please select a valid option from the dropdown list.');
        $validation->setPromptTitle('Select from list');
        $validation->setPrompt('Choose one of the options available.');
    }
}
