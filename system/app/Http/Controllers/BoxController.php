<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Lemari;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;


class BoxController extends Controller
{
    // Menampilkan daftar box
 public function index()
{
    $user = Auth::user();

    // Ambil hanya lemari yang punya ruangan milik OPD user login
    $lemari = Lemari::whereHas('ruangan', function ($query) use ($user) {
        $query->where('opd_id', $user->opd_id);
    })->get();

    // Ambil box yang hanya dari lemari milik ruangan OPD tersebut
    $box = Box::with('lemari')
        ->whereHas('lemari.ruangan', function ($query) use ($user) {
            $query->where('opd_id', $user->opd_id);
        })->get();

    return view('backend.manajemen_lokasi.box', compact('box', 'lemari'));
}


    // Menyimpan box baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_box' => 'required|string|max:255',
            'lemari_id' => 'required|exists:lemari,lemari_id',
        ]);

        Box::create([
            'nama_box' => $request->nama_box,
            'lemari_id' => $request->lemari_id,
        ]);

        return redirect()->back()->with('success', 'Data box berhasil ditambahkan.');
    }

    // Mengupdate data box
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_box' => 'required|string|max:255',
            'lemari_id' => 'required|exists:lemari,lemari_id',
        ]);

        $box = Box::findOrFail($id);
        $box->update([
            'nama_box' => $request->nama_box,
            'lemari_id' => $request->lemari_id,
        ]);

        return redirect()->back()->with('success', 'Data box berhasil diperbarui.');
    }

    // Menghapus data box
    public function destroy($id)
    {
        $box = Box::findOrFail($id);
        $box->delete();

        return redirect()->back()->with('success', 'Data box berhasil dihapus.');
    }

    public function getByLemari($lemari_id)
{
    $box = Box::where('lemari_id', $lemari_id)->get();
    return response()->json($box);
}



public function showQR($id)
{
    $box = Box::with('lemari.ruangan')->findOrFail($id);

    // ✅ Ini URL hasil scan yang akan membuka isi box berdasarkan box_id
    $url = route('qr.box', $box->id); // contoh: /box/1

    // ✅ Buat QR Code dari URL, bukan teks biasa
    $qrCode = QrCode::size(200)->generate($url);

    return view('box.qr', compact('qrCode', 'box'));
}

public function cetakQR($id)
{
    $box = Box::with('lemari.ruangan')->findOrFail($id);
    $qrCode = \QrCode::size(250)->generate(url('/box/' . $box->box_id)); // URL QR

    return view('backend.manajemen_lokasi.cetak_qr_box', compact('box', 'qrCode'));
}



}
