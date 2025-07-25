<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Imports\PegawaiImport;
use Illuminate\Support\Facades\Session;
class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pegawai = Pegawai::where('opd_id', Auth::user()->opd_id);
            return DataTables::of($pegawai)
                ->addIndexColumn()
                ->editColumn('nip', function ($row) {
                    return $row->status_kepegawaian === 'ASN'
                        ? ($row->nip ?? '-')
                        : ($row->nik ?? '-');
                })

                ->editColumn('golongan', function ($row) {
                    return $row->golongan ?? '-';
                })
                ->editColumn('jabatan', function ($row) {
                    return $row->jabatan ?? '-';
                })
                ->addColumn('aksi', function ($row) {
                    return '
            <a href="' . route('pegawai.edit', $row->id) . '" class="btn btn-sm btn-warning"> <i class="mdi mdi-pencil"></i></a>
            <button class="btn btn-sm btn-danger btn-hapus-pegawai"
        data-url="' . route('pegawai.destroy', $row->id) . '"
        data-nama="' . e($row->nama) . '">
        <i class="mdi mdi-trash-can-outline"></i>
    </button>
        ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('backend.pegawai.index');
    }

    public function create()
    {
        return view('backend.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status_kepegawaian' => 'required|in:ASN,Honor',
            'nip' => 'required_if:status_kepegawaian,ASN|nullable|unique:pegawai,nip',
            'nik' => 'required_if:status_kepegawaian,Honor|nullable|unique:pegawai,nik',
        ]);

        $data = [
            'nama' => $request->nama,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan ?? '-',
            'jabatan' => $request->jabatan ?? '-',
            'opd_id' => auth()->user()->opd_id,
        ];

        if ($request->status_kepegawaian === 'ASN') {
            $data['nip'] = $request->nip;
        } else {
            $data['nik'] = $request->nik;
        }

        Pegawai::create($data);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }




    public function edit($id)
    {
        $pegawai = Pegawai::where('id', $id)
            ->where('opd_id', Auth::user()->opd_id)
            ->firstOrFail();

        return view('backend.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::where('id', $id)
            ->where('opd_id', Auth::user()->opd_id)
            ->firstOrFail();

        $request->validate([
            'nama' => 'required',
            'status_kepegawaian' => 'required|in:ASN,Honor',
            'nip' => 'required_if:status_kepegawaian,ASN|nullable|unique:pegawai,nip,' . $pegawai->id,
            'nik' => 'required_if:status_kepegawaian,Honor|nullable|unique:pegawai,nik,' . $pegawai->id,
        ]);

        $pegawai->update([
            'nama' => $request->nama,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan ?? '-',
            'jabatan' => $request->jabatan ?? '-',
            'nip' => $request->status_kepegawaian === 'ASN' ? $request->nip : null,
            'nik' => $request->status_kepegawaian === 'Honor' ? $request->nik : null,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $pegawai = Pegawai::where('id', $id)
            ->where('opd_id', Auth::user()->opd_id)
            ->firstOrFail();

        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function importForm()
    {
        return view('backend.pegawai.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:3072',
        ]);

        (new FastExcel)->import($request->file('file'), function ($row) {
            return \App\Models\Pegawai::create([
                'nama' => $row['Nama'] ?? '-',
                'status_kepegawaian' => $row['Status Kepegawaian'] ?? 'Honor',
                'nip' => $row['Status Kepegawaian'] === 'ASN' ? ($row['NIP'] ?? null) : null,
                'nik' => $row['Status Kepegawaian'] === 'Honor' ? ($row['NIK'] ?? null) : null,
                'golongan' => trim($row['Golongan'] ?? '') ?: '-',
                'jabatan' => trim($row['Jabatan'] ?? '') ?: '-',

                'opd_id' => auth()->user()->opd_id,
            ]);
        });

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diimport.');
    }
    public function getPegawaiByNip($nip)
    {
        $pegawai = Pegawai::where('nip', $nip)->first();

        if ($pegawai) {
            return response()->json([
                'status' => 'success',
                'data' => $pegawai
            ]);
        }

        return response()->json([
            'status' => 'not_found'
        ], 404);
    }

    public function getPegawaiByNipNik($nipNik)
    {
        $pegawai = Pegawai::where('nip', $nipNik)
            ->orWhere('nik', $nipNik)
            ->first();

        if ($pegawai) {
            return response()->json([
                'status' => 'success',
                'data' => $pegawai
            ]);
        }

        return response()->json([
            'status' => 'not_found'
        ]);
    }

public function importPreview(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:3072',
    ]);

    $rows = (new FastExcel)->import($request->file('file'));

    // Validasi jika file tidak ada data
    if ($rows->isEmpty()) {
        return redirect()->route('pegawai.import.form')->withErrors(['File Excel tidak berisi data.']);
    }

    Session::put('preview_pegawai', $rows);

    return view('backend.pegawai.preview', compact('rows'));
}



public function importSave(Request $request)
{
    $rows = Session::get('preview_pegawai');

    if (!$rows || count($rows) === 0) {
        return redirect()->route('pegawai.import.form')->withErrors(['Tidak ada data yang bisa disimpan.']);
    }

    $opdId = auth()->user()->opd_id;
    $dataBerhasil = 0;

    foreach ($rows as $row) {
        $status = $row['Status Kepegawaian'] ?? 'Honor';

        $nip = $status === 'ASN' ? ($row['NIP'] ?? null) : null;
        $nik = $status === 'Honor' ? ($row['NIK'] ?? null) : null;

        $exists = Pegawai::where('opd_id', $opdId)
            ->when($nip, fn($q) => $q->where('nip', $nip))
            ->when($nik, fn($q) => $q->orWhere('nik', $nik))
            ->exists();

        if ($exists) {
            continue;
        }

        Pegawai::create([
            'nama' => $row['Nama'] ?? '-',
            'status_kepegawaian' => $status,
            'nip' => $nip,
            'nik' => $nik,
            'golongan' => trim($row['Golongan'] ?? '') ?: '-',
            'jabatan' => trim($row['Jabatan'] ?? '') ?: '-',
            'opd_id' => $opdId,
        ]);

        $dataBerhasil++;
    }

    Session::forget('preview_pegawai');

    if ($dataBerhasil === 0) {
        return redirect()->route('pegawai.index')->with('warning', 'Tidak ada data baru yang diimpor. Semua data sudah ada.');
    }

    return redirect()->route('pegawai.index')->with('success', "$dataBerhasil data pegawai berhasil diimpor.");
}


}
