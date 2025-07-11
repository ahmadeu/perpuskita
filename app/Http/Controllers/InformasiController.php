<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function profil()
    {
        return view('informasi.profil');
    }

    public function standarPelayanan()
    {
        return view('informasi.standarPelayanan');
    }

    public function waktuPelayanan()
    {
        return view('informasi.waktuPelayanan');
    }

    public function pustakawan()
    {
        return view('informasi.pustakawan');
    }
} 