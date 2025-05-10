<?php

namespace App\Http\Controllers;

use App\Models\ImportArsip;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KlasifikasiController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        $query = ImportArsip::query();

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    return view('backend.import.index');
}
}

