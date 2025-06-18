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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <small>© {{ date('Y') }} Sistem Arsip | Ketapang</small>
            </div>
        </div>
    </div>
</div>
@endsection
