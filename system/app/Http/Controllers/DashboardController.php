<?php

namespace App\Http\Controllers;

use App\Models\ArsipSuratMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah arsip yang ditambahkan hari ini
        $jumlahHariIni = ArsipSuratMasuk::whereDate('created_at', today())->count();

        // Mengirim data ke view
        return view('dashboard.index', compact('jumlahHariIni'));
    }
}

