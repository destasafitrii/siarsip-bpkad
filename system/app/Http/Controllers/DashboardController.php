<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipSuratMasuk;
use App\Models\ArsipSuratKeluar;
use App\Models\ArsipDokumen;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $opdId = $user->opd_id; // Ambil opd_id dari user yang login

        $hariIni = Carbon::today();
        $awalMinggu = Carbon::now()->startOfWeek();
        $akhirMinggu = Carbon::now()->endOfWeek();
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();

        // 📬 Surat Masuk
        $arsipMasukHarian = ArsipSuratMasuk::where('opd_id', $opdId)
            ->whereDate('created_at', $hariIni)->count();
        $arsipMasukBulanan = ArsipSuratMasuk::where('opd_id', $opdId)
            ->whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $arsipMasukTotal = ArsipSuratMasuk::where('opd_id', $opdId)->count();

        // 📤 Surat Keluar
        $arsipKeluarHarian = ArsipSuratKeluar::where('opd_id', $opdId)
            ->whereDate('created_at', $hariIni)->count();
        $arsipKeluarBulanan = ArsipSuratKeluar::where('opd_id', $opdId)
            ->whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $arsipKeluarTotal = ArsipSuratKeluar::where('opd_id', $opdId)->count();

        // 📎 Arsip Dokumen
        $arsipDokumenHarian = ArsipDokumen::where('opd_id', $opdId)
            ->whereDate('created_at', $hariIni)->count();
        $arsipDokumenBulanan = ArsipDokumen::where('opd_id', $opdId)
            ->whereBetween('created_at', [$awalBulan, $akhirBulan])->count();
        $arsipDokumenTotal = ArsipDokumen::where('opd_id', $opdId)->count();

        // Total Harian, Mingguan, Bulanan
        $arsipHarian = $arsipMasukHarian + $arsipKeluarHarian + $arsipDokumenHarian;
        $arsipMingguan = ArsipSuratMasuk::where('opd_id', $opdId)->whereBetween('created_at', [$awalMinggu, $akhirMinggu])->count()
            + ArsipSuratKeluar::where('opd_id', $opdId)->whereBetween('created_at', [$awalMinggu, $akhirMinggu])->count()
            + ArsipDokumen::where('opd_id', $opdId)->whereBetween('created_at', [$awalMinggu, $akhirMinggu])->count();
        $arsipBulanan = $arsipMasukBulanan + $arsipKeluarBulanan + $arsipDokumenBulanan;

        // Statistik grafik 6 bulan terakhir
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $label = $bulan->format('M Y');

            $masuk = ArsipSuratMasuk::where('opd_id', $opdId)
                ->whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)->count();

            $keluar = ArsipSuratKeluar::where('opd_id', $opdId)
                ->whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)->count();

            $dokumen = ArsipDokumen::where('opd_id', $opdId)
                ->whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)->count();

            $chartData[] = [
                'bulan' => $label,
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
