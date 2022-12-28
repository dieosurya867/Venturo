@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / </span>Laporan penjualan tahunan per menu</h4>

        <!-- Form controls -->
        <div class="row">

            <div class="card mb-4">
                <h5 class="card-header">Venturo - Laporan penjualan tahunan per menu</h5>
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('venturo.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <select id="my-select" class="form-control" name="tahun">
                                            <option value="">Pilih Tahun</option>
                                            <option value="2021" selected="">2021</option>
                                            <option value="2022">2022</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary">
                                        Tampilkan
                                    </button>
                                </div>
                        </form>

                        @isset($dataMenu)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" style="margin: 0;">
                                    <thead>
                                        <tr class="table-dark">
                                            <th rowspan="2"
                                                style="text-align:center;vertical-align: middle;width: 250px; color:white;">
                                                Menu</th>
                                            <th colspan="12" style="text-align: center; color:white;">Periode Pada 2021
                                            </th>
                                            <th rowspan="2"
                                                style="text-align:center;vertical-align: middle;width:75px; color:white;">Total
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th style="text-align: center;width: 75px; color:white">Jan</th>
                                            <th style="text-align: center;width: 75px; color:white">Feb</th>
                                            <th style="text-align: center;width: 75px; color:white">Mar</th>
                                            <th style="text-align: center;width: 75px; color:white">Apr</th>
                                            <th style="text-align: center;width: 75px; color:white">Mei</th>
                                            <th style="text-align: center;width: 75px; color:white">Jun</th>
                                            <th style="text-align: center;width: 75px; color:white">Jul</th>
                                            <th style="text-align: center;width: 75px; color:white">Ags</th>
                                            <th style="text-align: center;width: 75px; color:white">Sep</th>
                                            <th style="text-align: center;width: 75px; color:white">Okt</th>
                                            <th style="text-align: center;width: 75px; color:white">Nov</th>
                                            <th style="text-align: center;width: 75px; color:white">Des</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                        </tr>

                                        @php
                                            $id = 0;
                                        @endphp

                                        @foreach ($dataMenu as $menu)
                                            <tr>
                                                {{-- mengeluarkan data makanan --}}
                                                @if ($menu->kategori == 'makanan')
                                                    {{-- mengeluarkan data nama menu --}}
                                                    <td>{{ $menu->menu }}</td>

                                                    @for ($i = 1; $i <= 12; $i++)
                                                        {{-- memberi id total bulanan setiap menu makanan --}}
                                                        @php
                                                            $id++;
                                                        @endphp

                                                        <td data-bs-toggle="modal" data-bs-target="#makanan{{ $id }}">
                                                            {{ number_format($hasilPerbulan[$menu->menu][$i], 0, ',', '.') }}
                                                        </td>
                                                    @endfor

                                                    <td style="font-weight:bold;">
                                                        {{ number_format($totalMenu[$menu->menu], 0, ',', '.') }}
                                                    </td>
                                            </tr>
                                        @endif
                                        @endforeach

                                        <tr>
                                            <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                        </tr>

                                        @foreach ($dataMenu as $menu)
                                            {{-- mengeluarkan data minuman --}}
                                            @if ($menu->kategori == 'minuman')
                                                <tr>
                                                    <td>{{ $menu->menu }}</td>

                                                    @for ($i = 1; $i <= 12; $i++)
                                                        {{-- memberi id total bulanan setiap menu makanan --}}
                                                        @php
                                                            $id++;
                                                        @endphp

                                                        <td data-bs-toggle="modal" data-bs-target="#makanan{{ $id }}">
                                                            {{ number_format($hasilPerbulan[$menu->menu][$i], 0, ',', '.') }}
                                                        </td>
                                                    @endfor

                                                    <td style="font-weight:bold;" data-bs-toggle="modal">
                                                        {{ number_format($totalMenu[$menu->menu], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        <tr class="table-dark">
                                            <td><b>Total</b></td>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <td>{{ number_format($totalBulanan[$i], 0, ',', ',') }}</td>
                                            @endfor
                                            <td>{{ number_format($totalSemua, 0, ',', ',') }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                @php
                                    $modal = 0;
                                @endphp

                                @foreach ($dataMenu as $menu)
                                    {{-- menampilkan id pilihan modal --}}
                                    @for ($i = 1; $i <= 12; $i++)
                                        @php
                                            $modal++;
                                        @endphp

                                        {{-- MODAL DETAIL MAKANAN --}}
                                        <div class="modal fade" id="makanan{{ $modal }}"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            Detail Total Bulanan {{ $menu->menu }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="text-center">{{ $judul[$menu->menu][$i] }}</h5>

                                                        {{-- Mengambil isi data transaksi --}}
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tanggal Transaksi</th>
                                                                    <th>Total Transaksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($dataTransaksi as $transaksi)
                                                                    {{-- Translate Tanggal ke angka dari 1-12 --}}
                                                                    @php
                                                                        $bulan = date('n', strtotime($transaksi->tanggal));
                                                                    @endphp

                                                                    {{-- Jika Translate tanggal sesuai dengan looping dan menu menu sama dengan transaksi menu --}}
                                                                    @if ($bulan == $i && $menu->menu == $transaksi->menu)
                                                                        <tr>
                                                                            <td>{{ $transaksi->tanggal }}</td>
                                                                            <td>Rp
                                                                                {{ number_format($transaksi->total, 0, ',', '.') }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <hr>
                                                        <h6>Harga Total :
                                                            <span class="badge bg-info">Rp
                                                                {{ number_format($hasilPerbulan[$menu->menu][$i], 0, ',', '.') }}</span>
                                                        </h6>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endforeach
                            @endisset
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
