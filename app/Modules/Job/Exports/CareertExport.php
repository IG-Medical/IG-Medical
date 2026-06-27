<?php

namespace Job\Exports;

use Job\Http\Resources\Exports\GenerateCareerExportResources;
use Job\Models\Career;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class CareertExport implements  FromCollection, WithHeadings, WithEvents, WithColumnWidths, WithStyles
{


    public function collection()
    {
        //with('user','status','title','companyIndustry','jobCountry','employmentType')->
        $careers = Career::all();

        return GenerateCareerExportResources::collection($careers);
    }

    public function headings(): array
    {
        return [
            'JobID',
            'Title',
            'Company Industry',
            'Job Location',
            'Job city',
            'Employment Type',
            'Salary Range',
            'Remote Career',
            'No Of Vacancies',
            'Job Level',
            'Min Year Of Experience',
            'Max Year Of Experience',
            'Major',
            'Degree',
            'Residence Country The Applicant',
            'Residence City The Applicant',
            'Nationality The Applicant',
            'Gender The Applicant',
            'Min Age The Applicant',
            'Max Age The Applicant',
            'OwnerID',
            'Owner Full Name',
            'Owner Email',
            'Owner Mobile',
            'Date Created',
            'Date Of Publication',
            'Number Of Applicants',
            'Status',
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
            'F' => 30,
            'G' => 25,
            'H' => 25,
            'I' => 20,
            'J' => 20,
            'K' => 40,
            'L' => 30,
            'M' => 30,
            'N' => 30,
            'O' => 30,
            'P' => 30,
            'Q' => 30,
            'R' => 30,
            'S' => 15,
            'T' => 30,
            'U' => 30,
            'V' => 30,
            'W' => 30,
            'X' => 30,
            'Y' => 30,
            'Z' => 30,
            'AA' => 30,
            'AB' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
        ];
    }
}
