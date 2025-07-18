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
                            <p class="text-muted">
                                Silakan login ke Sistem Pengelolaan Arsip Perangkat Daerah Kabupaten Ketapang
                            </p>
                        </div>

                        {{-- Pesan kesalahan login (email & password salah) --}}
                        @if ($errors->has('login'))
                            <div class="alert alert-danger text-center">
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email"
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan kata sandi" required>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Masuk --}}
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
