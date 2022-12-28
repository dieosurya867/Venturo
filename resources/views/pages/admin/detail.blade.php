@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Form controls -->
        <div class="row">

            <div class="card mb-4">
                <h5 class="card-header">Nama Menu - Laporan Penjualan NamaBulan</h5>
                <div class="card-body">

                    <form id="formAccountSettings" method="POST" onsubmit="return false">

                        <div class="mb-3 col-md-6">
                            @csrf
                            <label for="firstName" class="form-label">Tanggal = </label>
                            <input class="form-control" type="text" id="tanggal" name="tanggal" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Total</label>
                            <input class="form-control" type="text" name="total" id="total" />
                        </div>
                </div>

            </div>
        </div>
    @endsection
