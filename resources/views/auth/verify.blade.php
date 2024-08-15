@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 2%">
                <div class="card" style="width: 40rem;">
                    <div class="card-body">
                        <h4 class="card-title">Verifikasi Alamat Email Anda</h4>
                        @if (session('resent'))
                            <p class="alert alert-success" role="alert">Link verifikasi baru telah dikirim ke email Anda!</p>
                        @endif
                        <p class="card-text">Apakah email tidak Anda terima?</p>
                        <a href="{{ route('verification.resend') }}">klik disini</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection