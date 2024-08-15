<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Penjualan</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div style="text-align: center;margin-bottom: 25px;">
                <img width="120" src="{{ public_path('images/logo toko.png') }}" alt="Logo">
                <h4 style="margin-bottom: 20px;">
                    <span>ID:</span> <strong>{{ $sale->reference }}</strong>
                </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Info Toko:</h4>
                            <div><strong>{{ settings()->company_name }}</strong></div>
                            <div>{{ settings()->company_address }}</div>
                            <div>Email: {{ settings()->company_email }}</div>
                            <div>Telp: {{ settings()->company_phone }}</div>
                        </div>

                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Info Customer:</h4>
                            <div><strong>{{ $customer->customer_name }}</strong></div>
                            <div>{{ $customer->address }}</div>
                            <div>Email: {{ $customer->customer_email }}</div>
                            <div>Telp: {{ $customer->customer_phone }}</div>
                        </div>

                        <div class="col-xs-4 mb-3 mb-md-0">
                            <h4 class="mb-2" style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">Info Transaksi:</h4>
                            <div>Invoice: <strong>INV/{{ $sale->reference }}</strong></div>
                            <div>Tanggal: {{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</div>
                            <div>
                                Status: <strong>{{ $sale->status }}</strong>
                            </div>
                            <div>
                                Status Pembayaran: <strong>{{ $sale->payment_status }}</strong>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive-sm" style="margin-top: 30px;">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="align-middle">Nama Barang</th>
                                <th class="align-middle">Harga per Unit</th>
                                <th class="align-middle">Jumlah</th>
                                <!-- <th class="align-middle">Discount</th>
                                <th class="align-middle">Tax</th> -->
                                <th class="align-middle">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sale->saleDetails as $item)
                                <tr>
                                    <td class="align-middle">
                                        {{ $item->product_name }} <br>
                                        <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span>
                                    </td>

                                    <td class="align-middle">{{ format_currency($item->unit_price) }}</td>

                                    <td class="align-middle">
                                        {{ $item->quantity }}
                                    </td>

                                    <!-- <td class="align-middle">
                                        {{ format_currency($item->product_discount_amount) }}
                                    </td>

                                    <td class="align-middle">
                                        {{ format_currency($item->product_tax_amount) }}
                                    </td> -->

                                    <td class="align-middle">
                                        {{ format_currency($item->sub_total) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-8">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="left"><strong>Diskon ({{ $sale->discount_percentage }}%)</strong></td>
                                    <td class="right">{{ format_currency($sale->discount_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Pajak ({{ $sale->tax_percentage }}%)</strong></td>
                                    <td class="right">{{ format_currency($sale->tax_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Shipping</strong></td>
                                    <td class="right">{{ format_currency($sale->shipping_amount) }}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Grand Total</strong></td>
                                    <td class="right"><strong>{{ format_currency($sale->total_amount) }}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-xs-12">
                            <p style="font-style: italic;text-align: center">{{ settings()->company_name }} &copy; {{ date('Y') }}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
