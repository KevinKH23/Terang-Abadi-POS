<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Sale\Entities\Sale;

class SalesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $sales = Sale::all();

        $data = [];
        foreach ($sales as $sale) {
            $data[] = [
                'Tanggal' => \Carbon\Carbon::parse($sale->date)->format('d M Y'),
                'ID' => $sale->reference,
                'Customer' => $sale->customer_name,
                'Total Bayar' => format_currency($sale->total_amount),
                'Diterima' => format_currency($sale->paid_amount),
                'Status Pembayaran' => $sale->payment_status,
                'Status' => $sale->status,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'ID',
            'Customer',
            'Total Bayar',
            'Diterima',
            'Status Pembayaran',
            'Status',
        ];
    }
}

