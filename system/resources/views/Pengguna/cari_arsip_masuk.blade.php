@extends('template.admin')

@section('content')
    <div class="container">
        <h4>Cari Arsip Surat Masuk</h4>

        <form method="GET" action="{{ route('pengguna.cariArsipMasuk') }}" class="mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Cari nama surat..."
                value="{{ $request->keyword ?? '' }}">
        </form>

        @if ($arsip->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No Surat</th>
                        <th>Nama Surat</th>
                        <th>Tanggal</th>
                        <th>Asal</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arsip as $a)
                        <tr>
                            <td>{{ $a->no_surat_masuk }}</td>
                            <td>{{ $a->nama_surat_masuk }}</td>
                            <td>{{ $a->tanggal_surat_masuk }}</td>
                            <td>{{ $a->asal_surat_masuk }}</td>
                            <td>
                                @if ($a->file_surat_masuk)
                                    <a href="{{ asset('storage/file_surat_masuk/' . $a->file_surat_masuk) }}" target="_blank"
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
