<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    // Menampilkan daftar data arsip
    public function index()
    {
        $data['list_arsip'] = Arsip::all();
        return view('content.arsip.index', $data);
    }

    // Menampilkan form untuk membuat data arsip baru
    public function create()
    {
        return view('content.arsip.create');
    }

    // Menyimpan data arsip baru ke database
    public function store(Request $request)
    {
        // Validasi input berdasarkan kombinasi bidang dan jenis arsip
        $validatedData = $request->validate([
            'nomor_surat' => 'required|unique:arsip',
            'tanggal' => 'required|date',
            'bidang' => 'required|in:anggaran,pembendaharaan,akuntansi,sekretariat',
            'jenis_arsip' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi logika untuk jenis arsip berdasarkan bidang
                    $validTypes = match ($request->bidang) {
                        'anggaran' => ['APBD'],
                        'pembendaharaan' => ['SPD', 'SP2D'],
                        'akuntansi' => ['SPJ'],
                        'sekretariat' => ['masuk', 'keluar'],
                        default => []
                    };

                    if (!in_array($value, $validTypes)) {
                        $fail("Jenis arsip tidak valid untuk bidang yang dipilih.");
                    }
                },
            ],
            'tujuan_dari' => 'required|string',
            'no_berkas' => 'required|string',
            'urutan' => 'required|integer',
            'lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data jika validasi berhasil
        $arsip = new Arsip($validatedData);
        $arsip->save();

        return redirect()->route('arsip.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $data['arsip'] = Arsip::findOrFail($id);
        return view('content.arsip.edit', $data);
    }

    // Function untuk mengupdate data arsip yang sudah diedit
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'bidang' => 'required|string|max:255',
            'jenis_arsip' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi logika untuk jenis arsip berdasarkan bidang
                    $validTypes = match ($request->bidang) {
                        'anggaran' => ['APBD'],
                        'pembendaharaan' => ['SPD', 'SP2D'],
                        'akuntansi' => ['SPJ'],
                        'sekretariat' => ['masuk', 'keluar'],
                        default => []
                    };

                    if (!in_array($value, $validTypes)) {
                        $fail("Jenis arsip tidak valid untuk bidang yang dipilih.");
                    }
                },
            ],
            'tujuan_dari' => 'required|string',
            'no_berkas' => 'required|string',
            'urutan' => 'required|integer',
            'lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // Temukan data arsip berdasarkan ID
        $arsip = Arsip::findOrFail($id);

        // Update data arsip
        $arsip->update([
            'nomor_surat' => $request->nomor_surat,
            'tanggal' => $request->tanggal,
            'bidang' => $request->bidang,
            'jenis_arsip' => $request->jenis_arsip,
            'tujuan_dari' => $request->tujuan_dari,
            'no_berkas' => $request->no_berkas,
            'urutan' => $request->urutan,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect ke halaman daftar arsip dengan pesan sukses
        return redirect()->route('arsip.index')->with('success', 'Data arsip berhasil diperbarui.');
    }

    // Menghapus data arsip dari database
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);
        $arsip->delete();
        
        return redirect()->route('arsip.index')->with('success', 'Arsip Berhasil Dihapus.');
    }
    
}
