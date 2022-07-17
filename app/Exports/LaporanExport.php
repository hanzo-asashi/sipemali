<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LaporanExport implements FromCollection, Responsable, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private string $fileName = 'laporan-pajak.xlsx';

    /**
     * Optional Writer Type
     */
    private string $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private array $headers = [
        'Content-Type' => 'text/csv',
    ];

//    /**
//     * @var Report $report
//     */
    public function map($report): array
    {
        return [
            $report->invoice_number,
            $report->user->name,
            Date::dateTimeToExcel($report->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($user) {
            $user->name .= ' (prepared)';

            return $user;
        });
    }

    public function collection()
    {
        //
    }
}
