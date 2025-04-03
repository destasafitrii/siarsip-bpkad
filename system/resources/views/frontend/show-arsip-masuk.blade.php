@extends('template.frontend')
@section('content')
<div class="container py-5 position-relative" style="margin-top: 100px; background: linear-gradient(to right, #002454, #4f6d9d); color: white; border-radius: 15px; padding: 40px;"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-center flex-grow-1" style="color: white; font-weight: 600;">Detail Arsip Surat Masuk</h5>
        <a href="{{ route('hasil-pencarian') }}" class="btn btn-primary px-4 py-2 rounded-3 d-flex align-items-center" style="transition: background-color 0.3s ease-in-out;">
            <span>Kembali</span>
            <i class="fas fa-arrow-left ms-2"></i>
        </a>
    </div>
    
    <div class="card shadow-lg p-4 mb-4" style="background-color: #ffffff; color: #333333; border-radius: 15px;">
        <div class="row">
            <!-- Bagian Detail Arsip dibagi dua kolom -->
            <div class="col-md-6">
                <h6 class="mb-3"><strong>Nama Surat:</strong> {{ $arsip->nama_surat_masuk }}</h6>
                <p class="mb-3"><strong>No Surat:</strong> {{ $arsip->no_surat_masuk }}</p>
                <p class="mb-3"><strong>Bidang:</strong> {{ $arsip->bidang->nama_bidang }}</p>
                <p class="mb-3"><strong>Kategori:</strong> {{ $arsip->kategori->nama_kategori ?? 'Tidak Diketahui' }} </p>
            </div>
            <div class="col-md-6">
                <p class="mb-3"><strong>Lokasi:</strong> {{ $arsip->lokasi_surat_masuk }}</p>
                <p class="mb-3"><strong>No Berkas:</strong> {{ $arsip->no_berkas_surat_masuk }}</p>
                <p class="mb-3"><strong>Urutan:</strong> {{ $arsip->urutan_surat_masuk }}</p>
                <p class="mb-3"><strong>Keterangan:</strong> {{ $arsip->keterangan }}</p>
            </div>
        </div>
    </div>

    <!-- Bagian Pratinjau File -->
    <div class="card shadow-lg p-4 d-flex align-items-center justify-content-center" style="background-color: #ffffff; border-radius: 15px; padding: 20px;">
        @if($arsip->file_surat_masuk)
            <embed src="{{ asset('storage/' . $arsip->file_surat_masuk) }}" type="application/pdf" width="100%" height="400px">
        @else
            <p class="text-danger">Tidak ada file tersedia untuk pratinjau.</p>
        @endif
    </div>
</div>  
@endsection
