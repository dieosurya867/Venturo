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

        $url = "http://tes-web.landa.id/intermediate/menu";
        $content = file_get_contents($url);
        $data = json_decode($content);

        $tahun = $request->tahun;
        $url2 = "http://tes-web.landa.id/intermediate/transaksi?tahun=" . $tahun;
        $content2 = file_get_contents($url2);
        $data2 = json_decode($content2);

        $totalSemua = 0;

        //hitung Perbulan
        foreach ($data as $menu) {
            for ($i = 1; $i <= 12; $i++) {
                $hasilBulan[$menu->menu][$i] = 0;
            }
        }

        foreach ($data2 as $item) {
            $bulan = date('n', strtotime($item->tanggal));
            $hasilBulan[$item->menu][$bulan] += $item->total;
        }

        //total perMenu
        foreach ($data as $itemMenu) {
            $totalMenu[$itemMenu->menu] = 0;
        }

        foreach ($data2 as $hitungMenu) {
            $totalMenu[$hitungMenu->menu] += $hitungMenu->total;
        }

        // hitung totalPerbulan
        foreach ($data2 as $itemBulan) {
            for ($i = 1; $i <= 12; $i++) {
                $totalBulanan[$i] = 0;
            }
        }

        foreach ($data2 as $hitungPerbulan) {
            $day = date('n', strtotime($hitungPerbulan->tanggal));
            $totalBulanan[$day] += $hitungPerbulan->total;
        }

        //total keseluruhan
        foreach ($data2 as $hitungSemua) {
            $totalSemua += $hitungSemua->total;
        }

        // dd($totalMenu);
        return view('pages.admin.venturo', compact('data', 'data2', 'hasilBulan', 'totalMenu', 'totalBulanan', 'totalSemua'));
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
