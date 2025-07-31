@extends('template.admin')

@section('content')
<div class="page-content">

<div class="container pt-3 pb-5">

    <div class="row justify-content-center">
        <div class="col-md-10">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('success_password'))
                <div class="alert alert-success">{{ session('success_password') }}</div>
            @endif

            {{-- Informasi Profil --}}
            <div class="border-start border-4 border-success bg-white rounded shadow-sm p-4 mb-4">
                <h5 class="mb-3 text-success">
                    <i class="fas fa-user-circle me-2"></i> Informasi Pengguna
                </h5>

                <form action="{{ route('pengelola.profil.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            {{-- Ubah Password --}}
            <div class="border-start border-4 border-warning bg-white rounded shadow-sm p-4 mt-2">
                <h5 class="mb-3 text-warning">
                    <i class="fas fa-key me-2"></i> Ubah Password
                </h5>

                <form action="{{ route('pengelola.profil.updatePassword') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Password Lama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="current_password" class="form-control" id="current_password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="new_password" class="form-control" id="new_password" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button" data-target="new_password">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        @error('new_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="btn btn-warning w-100">
                        <i class="fas fa-key me-1"></i> Ubah Password
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    });
</script>
@endpush
