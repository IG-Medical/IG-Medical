<?php

namespace User\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use User\Http\Resources\Exports\GenerateUserExportResources;
use User\Models\User;
use User\Models\UserStatus;
use User\Models\UserType;

class UsersExport implements  FromCollection, WithHeadings, WithEvents, WithColumnWidths, WithStyles
{

    public function collection()
    {
        $users = User::where('user_status', UserStatus::ACCEPTED)
            ->where('user_type', UserType::NORMAL)
            ->with(['profile'])
            ->get();

        return GenerateUserExportResources::collection($users);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Mobile',
            'Email',
            'Job Title',
            'Hourly Price',
            'About',
            'Country',
            'City',
            'Address1',
            'Address2',
            'Date Birth',
            'Gender',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // All headers - set font size to 14
                $cellRange = 'A1:Z1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11);

                // Set first row to height 20
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(20);

            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 25,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 10,
            'G' => 25,
            'H' => 10,
            'I' => 10,
            'J' => 25,
            'K' => 25,
            'L' => 30,
            'M' => 30,
            'N' => 30,
            'O' => 30,
            'P' => 15,
            'Q' => 30,
            'R' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
