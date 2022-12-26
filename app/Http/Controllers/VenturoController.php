<?php

namespace App\Http\Controllers;

use App\Models\Venturo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VenturoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.venturo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tahun = $request->tahun;
        $url = "http://tes-web.landa.id/intermediate/menu";
        $content = file_get_contents($url);
        $dataMenu = json_decode($content);

        $url2 = "http://tes-web.landa.id/intermediate/transaksi?tahun=" . $tahun;
        $content2 = file_get_contents($url2);
        $dataTransaksi = json_decode($content2);

        $totalSemua = 0;

        //data perbulan dengan hasil 0
        foreach ($dataMenu as $menu) {
            for ($i = 1; $i <= 12; $i++) {
                $hasilPerbulan[$menu->menu][$i] = 0;
            }
        }

        //mengisi data perbulan
        foreach ($dataTransaksi as $transaksi) {
            $bulan = date('n', strtotime($transaksi->tanggal));
            $hasilPerbulan[$transaksi->menu][$bulan] += $transaksi->total;
        }

        //total perMenu
        foreach ($dataMenu as $itemMenu) {
            $totalMenu[$itemMenu->menu] = 0;
        }

        //mengisi data perMenu
        foreach ($dataTransaksi as $hitungMenu) {
            $totalMenu[$hitungMenu->menu] += $hitungMenu->total;
        }

        //hitung totalPerbulan
        foreach ($dataTransaksi as $itemBulan) {
            for ($i = 1; $i <= 12; $i++) {
                $totalBulanan[$i] = 0;
            }
        }

        //mengisi data Total Perbulan Dari Keseluruhan Menu
        foreach ($dataTransaksi as $hitungPerbulan) {
            $bulan = date('n', strtotime($hitungPerbulan->tanggal));
            $totalBulanan[$bulan] += $hitungPerbulan->total;
        }

        //membuat data totalPerbulan Dari Keseluruhan Menu
        foreach ($dataTransaksi as $itemBulan) {
            for ($i = 1; $i <= 12; $i++) {
                $totalBulanan[$i] = 0;
            }
        }

        //mengisi data totalPerbulan Dari Keseluruhan Menu
        foreach ($dataTransaksi as $hitungPerbulan) {
            $bulan = date('n', strtotime($hitungPerbulan->tanggal));
            $totalBulanan[$bulan] += $hitungPerbulan->total;
        }

        //total keseluruhan
        foreach ($dataTransaksi as $hitungSemua) {
            $totalSemua += $hitungSemua->total;
        }

        return view('pages.admin.venturo', compact('dataMenu', 'totalMenu', 'hasilPerbulan', 'totalBulanan', 'totalSemua'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venturo  $venturo
     * @return \Illuminate\Http\Response
     */
    public function show(Venturo $venturo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venturo  $venturo
     * @return \Illuminate\Http\Response
     */
    public function edit(Venturo $venturo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venturo  $venturo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venturo $venturo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venturo  $venturo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venturo $venturo)
    {
        //
    }
}
