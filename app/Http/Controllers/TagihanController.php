<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        // Logika untuk halaman tagihan UKT
        return view('mahasiswa.tagihan'); // Sesuaikan dengan path view yang benar
    }
}