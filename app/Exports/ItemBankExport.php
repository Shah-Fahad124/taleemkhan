<?php

namespace App\Exports;

use App\Models\ItemBank;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ItemBankExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    public function collection()
    {
        return ItemBank::with(['subject:id,name', 'grade:id,name'])->get();
    }

    public function headings(): array
    {
        return [
            'subject',
            'grade',
            'slo',
            'slo_no',
            'skill',
            'semester',
            'month',
            'difficulty',
            'category',
            'item_type',
            'item_description',
            'stimulus',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'correct_answer',
            'possible_answers',
            'marking_hints',
            'rubric',
            'total_marks',
        ];
    }

    public function map($item): array
    {
        return [
            optional($item->subject)->name,
            optional($item->grade)->name,
            $item->slo,
            $item->slo_no,
            $item->skill,
            $item->semester,
            $item->month,
            $item->difficulty,
            $item->category,
            $item->item_type,
            $item->item_description,
            $item->stimulus,
            $item->option_a,
            $item->option_b,
            $item->option_c,
            $item->option_d,
            $item->correct_answer,
            $item->possible_answers,
            $item->marking_hints,
            $item->rubric,
            $item->total_marks,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // === Apply light background color and bold text to header row ===
                $sheet->getStyle('A1:U1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'color' => ['rgb' => 'E8F0FE'], // light blue
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '000000'], // black text
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // === Adjust column width for better readability ===
                foreach (range('A', 'U') as $col) {
                    $sheet->getColumnDimension($col)->setWidth(22);
                }

                // === Freeze (lock) the header row so it stays visible when scrolling ===
                $sheet->freezePane('A2');

                // === Protect the sheet: header locked, data editable ===
                $sheet->getStyle('A1:U1')->getProtection()->setLocked(true);
                $sheet->getStyle('A2:U10000')->getProtection()->setLocked(false);
                $sheet->getProtection()->setSheet(true);
            },
        ];
    }
}
