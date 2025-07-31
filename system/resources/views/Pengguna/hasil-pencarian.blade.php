@extends('template.user')

@section('content')
    <div class="container-fluid min-vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="col-md-10">
            <div class="container-fluid py-5">
                <div class="row justify-content-center mt-5">
                    <div class="col-12 col-lg-10">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div
                                    class="container {{ request()->hasAny(['keyword', 'bidang_id', 'kategori_id']) ? 'py-2' : 'py-5' }}">

                                    {{-- Judul dan Deskripsi Pencarian --}}
                                    <div
                                        class="text-center mb-4 {{ request()->hasAny(['keyword', 'bidang_id', 'kategori_id']) ? 'd-none' : '' }}">
                                        <h4 class="fw-bold text-success">Silahkan Melakukan Pencarian Arsip</h4>
                                        <p class="text-muted">Cari arsip berdasarkan kata kunci, bidang, atau kategori</p>
                                    </div>

                                    {{-- FORM: Kotak Putih Saja --}}
                                    <div class="p-4 rounded shadow mx-auto" style="background: #ffffff; max-width: 900px;">
                                        <form method="GET" action="{{ route('arsip.cari') }}" id="form-pencarian">

                                            <div class="row g-3 align-items-center mb-4">
                                                <div class="col-lg-10">
                                                    <div class="input-group input-group-lg shadow-sm">
                                                        <input type="text" name="keyword"
                                                            class="form-control border-start-0"
                                                            placeholder="Ketik kata kunci arsip..."
                                                            value="{{ request('keyword') }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 d-grid">
                                                    <button type="submit" class="btn btn-success btn-lg shadow-sm">
                                                        <i class="bi bi-arrow-right-circle-fill me-1"></i> Cari
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-md-6 col-lg-6">
                                                    <select name="bidang_id" class="form-select form-select-lg shadow-sm">
                                                        <option value="">-- Semua Bidang --</option>
                                                        @foreach ($bidang as $b)
                                                            <option value="{{ $b->bidang_id }}"
                                                                {{ request('bidang_id') == $b->bidang_id ? 'selected' : '' }}>
                                                                {{ $b->nama_bidang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 col-lg-6">
                                                    <select name="kategori_id" class="form-select form-select-lg shadow-sm">
                                                        <option value="">-- Semua Kategori --</option>
                                                        @foreach ($kategori as $k)
                                                            <option value="{{ $k->kategori_id }}"
                                                                {{ request('kategori_id') == $k->kategori_id ? 'selected' : '' }}>
                                                                {{ $k->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div id="hasil-pencarian">
                                    @if (request()->filled('keyword') || request()->filled('bidang_id') || request()->filled('kategori_id'))
                                        <div class="text-center mt-4">
                                            <p class="text-muted">
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                Ditemukan <strong>{{ $arsip->total() }}</strong> arsip
                                                @if (request('keyword'))
                                                    untuk kata kunci <em>"{{ request('keyword') }}"</em>
                                                @endif
                                                @if (request('bidang_id'))
                                                    pada bidang
                                                    <em>{{ $bidang->firstWhere('bidang_id', request('bidang_id'))->nama_bidang ?? '-' }}</em>
                                                @endif
                                                @if (request('kategori_id'))
                                                    dan kategori
                                                    <em>{{ $kategori->firstWhere('kategori_id', request('kategori_id'))->nama_kategori ?? '-' }}</em>
                                                @endif
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Hasil Pencarian --}}
                                    @if (request()->hasAny(['keyword', 'bidang_id', 'kategori_id', 'jenis_arsip_id']))
                                        <hr class="my-4">
                                        <h5 class="mb-3" id="hasil">Hasil Pencarian</h5>

                                        @if ($arsip->count())
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover align-middle">
                                                    <thead class="table-primary text-center">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nomor</th>
                                                            <th>Nama</th>
                                                            <th>Bidang</th>
                                                            <th>Kategori</th>
                                                            <th>Ruangan</th>
                                                            <th>Lemari</th>
                                                            <th>Box</th>
                                                            <th>Urutan</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($arsip as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                                <td>{{ $item->nomor_surat }}</td>
                                                                <td>{{ $item->nama_surat }}</td>
                                                                <td>{{ $item->bidang->nama_bidang ?? '-' }}</td>
                                                                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                                                                <td>{{ $item->box->lemari->ruangan->nama_ruangan ?? '-' }}
                                                                </td>
                                                                <td>{{ $item->box->lemari->nama_lemari ?? '-' }}</td>
                                                                <td>{{ $item->box->nomor_box ?? '-' }}</td>
                                                                <td>{{ $item->urutan ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mt-3">
                                                {{ $arsip->withQueryString()->links() }}
                                            </div>
                                        @else
                                            <div class="alert alert-warning text-center mt-3">
                                                <i class="bi bi-exclamation-circle"></i> Tidak ada arsip ditemukan untuk
                                                pencarian "<strong>{{ request('keyword') }}</strong>".
                                            </div>
                                        @endif
                                    @endif
                                </div> {{-- penutup hasil-pencarian --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#form-pencarian').on('submit', function(e) {
            e.preventDefault(); // Hindari reload

            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();

            // Ambil nilai input
            let keyword = $('input[name="keyword"]').val().trim();
            let bidang = $('select[name="bidang_id"]').val();
            let kategori = $('select[name="kategori_id"]').val();

            // Validasi: jika semua kosong
            if (!keyword && !bidang && !kategori) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Form Kosong!',
                    text: 'Silakan isi kata kunci, pilih bidang, atau kategori terlebih dahulu.',
                });
                return; // Jangan lanjut AJAX
            }

            // Animasi loading
            $('#hasil-pencarian').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-success" role="status"></div>
                    <p class="mt-2 text-muted">Sedang mencari arsip...</p>
                </div>
            `);

            // Kirim AJAX GET
            $.get(url, data, function(response) {
                let hasilHTML = $(response).find('#hasil-pencarian').html();
                $('#hasil-pencarian').html(hasilHTML);

                // Scroll ke hasil
                $('html, body').animate({
                    scrollTop: $('#hasil-pencarian').offset().top - 100
                }, 500);
            }).fail(function() {
                $('#hasil-pencarian').html(`
                    <div class="alert alert-danger text-center mt-4">
                        <i class="bi bi-x-circle"></i> Terjadi kesalahan. Silakan coba lagi.
                    </div>
                `);
            });
        });
    });
</script>
@endpush

