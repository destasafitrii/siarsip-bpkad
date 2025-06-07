@extends('template.admin')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Card untuk Preview Data -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Pratinjau Data Arsip Surat Masuk yang Akan Diimpor</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('arsip_masuk.import.save') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            @foreach (array_keys($rows[0]) as $key)
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

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                                 <a href="{{ route('arsip_masuk.import.form') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->
</div> <!-- end page-content -->
@endsection
