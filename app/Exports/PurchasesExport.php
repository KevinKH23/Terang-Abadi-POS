<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Purchase\Entities\Purchase;

class PurchasesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $purchases = Purchase::all();

        $data = [];
        foreach ($purchases as $purchase) {
            $data[] = [
                'Tanggal' => \Carbon\Carbon::parse($purchase->date)->format('d M Y'),
                'ID' => $purchase->reference,
                'Supplier' => $purchase->supplier_name,
                'Total' => format_currency($purchase->total_amount),
                'Dibayar' => format_currency($purchase->paid_amount),
                'Status Pembayaran' => $purchase->payment_status,
                'Status' => $purchase->status,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'ID',
            'Supplier',
            'Total',
            'Dibayar',
            'Status Pembayaran',
            'Status',
        ];
    }
}

