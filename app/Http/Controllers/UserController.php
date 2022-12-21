<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Produk;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil()
    {
        // untuk tampilan User Home

        // $data = produk::all()->sortByDesc('jumlahTerjual')->skip(0)->take(8);
        return view('welcome');
    }

    public function index()
    {
        return view('pages.user.rekomendasi');
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
        $saran = new childJamu($request->keluhan, $request->lahir);
        $data = [
            'namaOrang' => $request->namaOrang,
            'pilKeluhan' => $saran->keluhan,
            'umur' => $saran->umur(),
            'saran' => $saran->saran(),
            'namaJamu' => $saran->namaJamu(),
        ];
        return view('pages.user.rekomendasi', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

abstract class ParentJamu
{
    public function __construct($keluhan, $lahir)
    {
        $this->keluhan = $keluhan;
        $this->lahir = $lahir;
    }

    public function umur()
    {
        return 2022 - $this->lahir;
    }

    public function namaJamu()
    {
        $namaJamu = $this->keluhan;

        if ($namaJamu == "Keseleo") {
            return "Beras Kencur";
        } elseif ($namaJamu == "Pegal") {
            return "Kunyit Asam";
        } elseif ($namaJamu == "Darah Tinggi") {
            return "BrotoWali";
        } elseif ($namaJamu == "Kram Perut") {
            return "Temulawak";
        }
    }
    protected function konsumsi()
    {
        $umur = $this->umur();
        if ($umur < 10) {
            return " 1x";
        } elseif ($umur >= 10) {
            return " 2x";
        }
    }

    abstract public function saran(): string;
}

class childJamu extends ParentJamu
{
    public function saran(): string
    {

        $namaJamu = $this->namaJamu();
        if ($namaJamu == 'Beras Kencur' && $this->keluhan == 'Keseleo') {
            return 'Dioleskan ' . $this->konsumsi();
        } else {
            return "Dikonsumsi " . $this->konsumsi();
        }
    }
}
