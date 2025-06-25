@extends('template.admin')

@section('content')
    <div class="container">
        <h4>Cari Arsip Dokumen</h4>

        <form method="GET" action="{{ route('pengguna.cariArsipDokumen') }}" class="mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama dokumen..."
                value="{{ $request->keyword ?? '' }}">
        </form>

        @if ($arsip->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Dokumen</th>
                        <th>Keterangan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arsip as $a)
                        <tr>
                            <td>{{ $a->nama_dokumen }}</td>
                            <td>{{ $a->keterangan }}</td>
                            <td>
                                @if ($a->file)
                                    <a href="{{ asset('storage/file_dokumen/' . $a->file) }}" target="_blank"
                                        class="btn btn-sm btn-primary">Lihat</a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $arsip->withQueryString()->links() }}
        @else
            <p class="text-muted">Tidak ada data ditemukan.</p>
        @endif
    </div>
@endsection
