<?php

namespace Modules\Sale\DataTables;

use Modules\Sale\Entities\Sale;
use Modules\Sale\Entities\SaleDetails;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('product_name', function ($data) {
                // Mengambil nama produk dari relasi saleDetails
                return $data->saleDetails->map(function ($detail) {
                    return $detail->product->product_name;
                })->implode(', ');
            })
            ->addColumn('quantity', function ($data) {
                // Mengambil jumlah produk dari relasi saleDetails
                return $data->saleDetails->map(function ($detail) {
                    return $detail->quantity;
                })->implode(', ');
            })
            ->addColumn('payment_date', function ($data) {
                return optional($data->salePayments->first())->date; // Mengambil tanggal pembayaran pertama
            }) 
            ->addColumn('total_amount', function ($data) {
                return format_currency($data->total_amount);
            })
            ->addColumn('paid_amount', function ($data) {
                return format_currency($data->paid_amount);
            })
            ->addColumn('due_amount', function ($data) {
                return format_currency($data->due_amount);
            })
            ->addColumn('status', function ($data) {
                return view('sale::partials.status', compact('data'));
            })
            ->addColumn('payment_status', function ($data) {
                return view('sale::partials.payment-status', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('sale::partials.actions', compact('data'));
            })
            ->filterColumn('product_name', function($query, $keyword) {
                $query->whereHas('saleDetails.product', function($query) use ($keyword) {
                    $query->where('product_name', 'like', "%{$keyword}%");
                });
            });
    }

    public function query(Sale $model) {
        return $model->newQuery()->with(['saleDetails.product', 'salePayments']);
    }

    public function html() {
        return $this->builder()
            ->setTableId('sales-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(8)
            ->buttons(
                Button::make('excel')
                    ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')
                    ->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')
                    ->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')
                    ->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns() {
        return [
            Column::make('reference')
                ->title('ID')
                ->className('text-center align-middle'),

            Column::make('payment_date')
                ->title('Tanggal')
                ->className('text-center align-middle'),

            // Column::make('customer_name')
            //     ->title('Customer')
            //     ->className('text-center align-middle'),
            
            Column::computed('product_name')
                ->title('Nama Barang')
                ->className('text-center align-middle')
                ->searchable(true),

            Column::computed('quantity')
                ->title('Jumlah')
                ->className('text-center align-middle'),

            Column::computed('total_amount')
                ->title('Total')
                ->className('text-center align-middle'),

            Column::computed('paid_amount')
                ->title('Jumlah Bayar')
                ->className('text-center align-middle'),

            Column::computed('status')
                ->className('text-center align-middle'),

            // Column::computed('payment_status')
            //     ->title('Status Pembayaran')
            //     ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
                ->printable(false)
        ];
    }

    protected function filename(): string {
        return 'Sales_' . date('YmdHis');
    }
}
