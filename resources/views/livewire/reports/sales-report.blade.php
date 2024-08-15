<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Awal <span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Akhir <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select wire:model="customer_id" class="form-control" name="customer_id">
                                        <option value="">Pilih Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="sale_status" class="form-control" name="sale_status">
                                        <option value="">Pilih Status</option>
                                        <option value="Hutang">Hutang</option>
                                        <!-- <option value="Shipped">Shipped</option> -->
                                        <option value="Lunas">Lunas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select wire:model="payment_status" class="form-control" name="payment_status">
                                        <option value="">Pilih Status Pembayaran</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Lunas">Belum Lunas</option>
                                        <option value="Belum Bayar">Belum Bayar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <span wire:target="generateReport" wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filter Laporan
                            </button>
                            <button wire:click.prevent="exportToExcel" class="btn btn-success">
                                <i class="bi bi-file-earmark-excel"></i> Excel
                            </button>
                            <button class="btn btn-info" onclick="printSalesReport()">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table id="sales-table" class="table table-bordered table-striped text-center mb-0">
                        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Total Bayar</th>
                            <th>Diterima</th>
                            <!-- <th>Due</th> -->
                            <th>Status Pembayaran</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                                <td>{{ $sale->reference }}</td>
                                <td>{{ $sale->customer_name }}</td>
                                <td>{{ format_currency($sale->total_amount) }}</td>
                                <td>{{ format_currency($sale->paid_amount) }}</td>
                                <!-- <td>{{ format_currency($sale->due_amount) }}</td> -->
                                <td>
                                    @if ($sale->payment_status == 'Belum Lunas')
                                    <span class="badge badge-warning">
                                    {{ $sale->payment_status }}
                                </span>
                                    @elseif ($sale->payment_status == 'Lunas')
                                        <span class="badge badge-success">
                                    {{ $sale->payment_status }}
                                </span>
                                @else
                                <span class="badge badge-danger">
                                    {{ $sale->payment_status }}
                                </span>
                                @endif 
                            </td>
                            <td>
                                @if ($sale->status == 'Hutang')
                                    <span class="badge badge-info">
                                {{ $sale->status }}
                            </span>
                                @elseif ($sale->status == 'Shipped')
                                    <span class="badge badge-primary">
                                {{ $sale->status }}
                            </span>
                                @else
                                    <span class="badge badge-success">
                                {{ $sale->status }}
                            </span>
                                @endif
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <span class="text-danger">Tidak Ada Data Penjualan!</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div @class(['mt-3' => $sales->hasPages()])>
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printSalesReport() {
        // Mengambil elemen tabel berdasarkan ID
        var table = document.getElementById('sales-table');
        
        // Membuka tab baru dan menyiapkan dokumen untuk pencetakan
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Laporan Penjualan</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('table { border-collapse: collapse; width: 100%; }'); // Menambahkan border-collapse untuk tabel
        printWindow.document.write('table, th, td { border: 1px solid black; padding: 8px; }'); // Menambahkan border dan padding untuk sel dan header
        printWindow.document.write('.print-title { text-align: center; font-size: 24px; margin-bottom: 20px; }'); // CSS untuk judul tengah
        printWindow.document.write('</style></head><body>');
        printWindow.document.write('<h1 class="print-title">Laporan Penjualan</h1>'); // Judul tengah
        printWindow.document.write(table.outerHTML); // Menyalin tabel ke dokumen baru
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        
        // Memanggil fungsi print pada dokumen baru
        printWindow.print();
    }
</script>
