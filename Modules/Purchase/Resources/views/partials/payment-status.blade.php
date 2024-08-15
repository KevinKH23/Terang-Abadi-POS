@if ($data->payment_status == 'Belum Lunas')
    <span class="badge badge-warning">
        {{ $data->payment_status }}
    </span>
@elseif ($data->payment_status == 'Lunas')
    <span class="badge badge-success">
        {{ $data->payment_status }}
    </span>
@else
    <span class="badge badge-danger">
        {{ $data->payment_status }}
    </span>
@endif
