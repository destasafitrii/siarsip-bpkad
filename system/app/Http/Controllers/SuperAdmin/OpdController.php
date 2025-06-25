<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index()
    {

        $opds = Opd::all();
        return view('superadmin.opd.index', compact('opds'));
    }

    public function create()
    {

        return view('superadmin.opd.create');
    }

   public function store(Request $request)
{
    // dd($request->all()); // ✅ Komentar atau hapus
    $request->validate([
        'kode_opd' => 'required|string|max:50|unique:opds,kode_opd',
        'nama_opd' => 'required|string|max:255',
        'alamat' => 'nullable|string|max:255',
        'surel' => 'nullable|email|max:255',
      'maps' => 'nullable|string|max:65535',
        'kepala_dinas' => 'nullable|string|max:255',
    ]);

    Opd::create($request->all());

    return redirect()->route('opd.index')->with('success', 'OPD berhasil ditambahkan.');
}



    public function edit(Opd $opd)
    {
        return view('superadmin.opd.edit', compact('opd'));
    }

    public function update(Request $request, Opd $opd)
    {
        $request->validate([
            'kode_opd' => 'required|string|max:50|unique:opds,kode_opd,' . $opd->id,
            'nama_opd' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'surel' => 'nullable|email|max:255',
         'maps' => 'nullable|string|max:65535',
            'kepala_dinas' => 'nullable|string|max:255',
        ]);

        $opd->update($request->all());

        return redirect()->route('opd.index')->with('success', 'OPD berhasil diperbarui.');
    }

    public function show(Opd $opd)
{
    return view('superadmin.opd.show', compact('opd'));
}



    public function destroy(Opd $opd)
    {
        $opd->delete();
        return redirect()->route('opd.index')->with('success', 'OPD berhasil dihapus.');
    }
}
