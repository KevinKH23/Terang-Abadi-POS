<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>ID</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Total Bayar</th>
            <th>Diterima</th>
            <th>Status Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                <td>{{ $sale->reference }}</td>
                <td>{{ $sale->customer->customer_name }}</td>
                <td>{{ $sale->status }}</td>
                <td>{{ format_currency($sale->total_amount) }}</td>
                <td>{{ format_currency($sale->paid_amount) }}</td>
                <td>{{ $sale->payment_status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
