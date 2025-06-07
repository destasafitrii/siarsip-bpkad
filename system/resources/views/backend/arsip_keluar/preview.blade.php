@extends('template.admin')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-dark">
                    <h5 class="mb-0"><i class=""></i>Pratinjau Data Arsip Surat Masuk yang Akan Diimpor</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('arsip_keluar.import.save') }}" method="POST">
                        @csrf

                        <div class="table-responsive border rounded shadow-sm">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        @foreach ($rows->first() as $key => $val)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $row)
                                        @if (!empty(array_filter($row)))
                                            <tr>
                                                @foreach ($row as $val)
                                                    <td>{{ $val }}</td>
                                                @endforeach
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <input type="hidden" name="data" value="{{ json_encode($rows) }}">

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('arsip_keluar.import.form') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
