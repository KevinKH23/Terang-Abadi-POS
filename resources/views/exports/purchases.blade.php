<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>ID</th>
            <th>Supplier</th>
            <th>Total</th>
            <th>Dibayar</th>
            <th>Status Pembayaran</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{ \Carbon\Carbon::parse($purchase->date)->format('d M Y') }}</td>
                <td>{{ $purchase->reference }}</td>
                <td>{{ $purchase->supplier->supplier_name }}</td>
                <td>{{ format_currency($purchase->total_amount) }}</td>
                <td>{{ format_currency($purchase->paid_amount) }}</td>
                <td>{{ $purchase->payment_status }}</td>
                <td>{{ $purchase->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
