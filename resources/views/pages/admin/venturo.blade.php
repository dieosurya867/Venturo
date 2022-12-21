@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin / </span>Perhitungan BMI</h4>

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

                        @isset($data)
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" style="margin: 0;">
                                    <thead>
                                        <tr class="table-dark">
                                            <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">
                                                Menu</th>
                                            <th colspan="12" style="text-align: center;">Periode Pada 2021
                                            </th>
                                            <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total
                                            </th>
                                        </tr>
                                        <tr class="table-dark">
                                            <th style="text-align: center;width: 75px;">Jan</th>
                                            <th style="text-align: center;width: 75px;">Feb</th>
                                            <th style="text-align: center;width: 75px;">Mar</th>
                                            <th style="text-align: center;width: 75px;">Apr</th>
                                            <th style="text-align: center;width: 75px;">Mei</th>
                                            <th style="text-align: center;width: 75px;">Jun</th>
                                            <th style="text-align: center;width: 75px;">Jul</th>
                                            <th style="text-align: center;width: 75px;">Ags</th>
                                            <th style="text-align: center;width: 75px;">Sep</th>
                                            <th style="text-align: center;width: 75px;">Okt</th>
                                            <th style="text-align: center;width: 75px;">Nov</th>
                                            <th style="text-align: center;width: 75px;">Des</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                        </tr>
                                        @foreach ($data as $menu)
                                            <tr>
                                                @if ($menu->kategori == 'makanan')
                                                    <td>{{ $menu->menu }}</td>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <td>{{ number_format($hasilBulan[$menu->menu][$i], 0, ',', '.') }}</td>
                                                    @endfor
                                                    <td>{{ number_format($totalMenu[$menu->menu], 0, ',', '.') }}</td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="table-secondary" colspan="14"><b>Minuman</b></td>
                                        </tr>
                                        @foreach ($data as $menu)
                                            <tr>
                                                @if ($menu->kategori == 'minuman')
                                                    <td>{{ $menu->menu }}</td>
                                                    @for ($i = 1; $i <= 12; $i++)
                                                        <td>{{ number_format($hasilBulan[$menu->menu][$i], 0, ',', '.') }}</td>
                                                    @endfor
                                                    <td>{{ number_format($totalMenu[$menu->menu], 0, ',', '.') }}</td>
                                                @endif

                                            </tr>
                                        @endforeach
                                        <tr class="table-dark">
                                            <td><b>Total</b></td>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <td>{{ number_format($totalBulanan[$i], 0, ',', '.') }}</td>
                                            @endfor
                                            <td>{{ number_format($totalSemua, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endisset
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
