@extends('layouts.app')

@section('title', 'Detail Customer')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Customer</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $customer->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $customer->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th>Telp.</th>
                                    <td>{{ $customer->customer_phone }}</td>
                                </tr>
                                <!-- <tr>
                                    <th>Kota</th>
                                    <td>{{ $customer->city }}</td>
                                </tr> -->
                                <!-- <tr>
                                    <th>Country</th>
                                    <td>{{ $customer->country }}</td>
                                </tr> -->
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

