@extends('template.login')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ url('public/assets/images/logo-ktg.png') }}" height="50" alt="logo">
                        <h4 class="mt-3">Selamat Datang</h4>
                        <p class="text-muted">Silakan login ke Sistem Pengelolaan Arsip Perangkat Daerah Kabupaten Ketapang</p>
                    </div>

                    {{-- Tampilkan pesan gagal login --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" autofocus value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small>© {{ date('Y') }} Sistem Pengelolaan Arsip Perangkat Daerah | Ketapang</small>
            </div>
        </div>
    </div>
</div>
@endsection
