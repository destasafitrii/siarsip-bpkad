<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();

        // 📬 Surat Masuk
        $arsipMasukHarian = ArsipSuratMasuk::whereDate('created_at', $hariIni)->count();
        $arsipMasukBulanan = ArsipSuratMasuk::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $arsipMasukTotal = ArsipSuratMasuk::count();

        // 📤 Surat Keluar
        $arsipKeluarHarian = ArsipSuratKeluar::whereDate('created_at', $hariIni)->count();
        $arsipKeluarBulanan = ArsipSuratKeluar::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $arsipKeluarTotal = ArsipSuratKeluar::count();

        // 📎 Arsip Dokumen
        $arsipDokumenHarian = ArsipDokumen::whereDate('created_at', $hariIni)->count();
        $arsipDokumenBulanan = ArsipDokumen::whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $arsipDokumenTotal = ArsipDokumen::count();

        // Hitung total harian, mingguan, bulanan semua arsip
        $arsipHarian = $arsipMasukHarian + $arsipKeluarHarian + $arsipDokumenHarian;
        $arsipMingguan = ArsipSuratMasuk::whereBetween('created_at', [$awalMinggu, $akhirMinggu])->count()
            + ArsipSuratKeluar::whereBetween('created_at', [$awalMinggu, $akhirMinggu])->count()
            + ArsipDokumen::whereBetween('created_at', [$awalMinggu, $akhirMinggu])->count();
        $arsipBulanan = $arsipMasukBulanan + $arsipKeluarBulanan + $arsipDokumenBulanan;

        // Statistik bulanan untuk grafik (6 bulan terakhir)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $bulanLabel = $bulan->format('M Y');

            $masuk = ArsipSuratMasuk::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)->count();

            $keluar = ArsipSuratKeluar::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)->count();

            $dokumen = ArsipDokumen::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)->count();

            $chartData[] = [
                'bulan' => $bulanLabel,
                'masuk' => $masuk,
                'keluar' => $keluar,
                'dokumen' => $dokumen,
            ];
        }

        return view('backend.index', compact(
            'arsipHarian',
            'arsipMingguan',
            'arsipBulanan',
            'chartData',
            'arsipMasukHarian',
            'arsipMasukBulanan',
            'arsipMasukTotal',
            'arsipKeluarHarian',
            'arsipKeluarBulanan',
            'arsipKeluarTotal',
            'arsipDokumenHarian',
            'arsipDokumenBulanan',
            'arsipDokumenTotal'
        ));
    }
}
