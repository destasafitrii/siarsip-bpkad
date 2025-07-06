<div class="sidebar-left" style="width: 245px">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="left-menu list-unstyled" id="side-menu">
                @if (auth()->user()->role == 'pengelola')
                    <li>
                        <a href="{{ url('pengelola/dashboard') }}">
                            <i class="fas fa-desktop"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <li class="menu-title">Menu Utama</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-email"></i>
                            <span>Manajemen Arsip Surat</span>
                        </a>
                        <ul class="sub-menu">
                            <li> <a href="{{ url('pengelola/arsip_masuk') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Surat Masuk</a>
                            </li>
                            <li><a href="{{ url('pengelola/arsip_keluar') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Surat Keluar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('pengelola/arsip_dokumen') }}">
                            <i class="mdi mdi-archive"></i>
                            <span>Arsip Dokumen</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-tag-multiple"></i>
                            <span>Manajemen Kategori</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ url('pengelola/bidang') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Bidang</a>
                            </li>
                            <li><a href="{{ url('pengelola/kategori') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Kategori</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-map-marker"></i>
                            <span>Manajemen Lokasi</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ url('pengelola/ruangan') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Ruangan</a>
                            </li>
                            <li><a href="{{ url('pengelola/lemari') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Lemari/Rak</a></li>
                            <li><a href="{{ url('pengelola/box') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Box</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-upload"></i>
                            <span>Import Data Arsip</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('arsip_masuk.import.form') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i> Arsip Surat Masuk</a></li>
                            <li><a href="{{ route('arsip_keluar.import.form') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i> Arsip Surat Keluar</a></li>
                             <li><a href="{{ route('arsip_dokumen.import.form') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i> Arsip Dokumen</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-account-multiple"></i>
                            <span>Manajemen Pengguna</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ url('pengelola/pegawai') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Data Pegawai</a>
                            </li>
                            <li><a href="{{ url('pengelola/pengguna') }}"><i class="mdi mdi-checkbox-blank-circle"></i>
                                    Pengguna</a></li>
                        </ul>
                    </li>

                    {{-- <li>
                        <a href="{{ route('pengguna.index') }}">
                            <i class="mdi mdi-account-multiple"></i>
                            <span>Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengguna.index') }}">
                            <i class="mdi mdi-account-multiple"></i>
                            <span>Pengguna</span>
                        </a>
                    </li> --}}
                @elseif(auth()->user()->role == 'superadmin')
                    <li>
                        <a href="{{ url('superadmin/dashboard') }}">
                            <i class="fas fa-desktop"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="menu-title">Menu Utama</li>

                    <li>
                        <a href="{{ url('superadmin/opd') }}">
                            <i class="mdi mdi-city"></i>
                            <span>Manajemen OPD</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('superadmin/pengelola') }}">
                            <i class="mdi mdi-account-key"></i>
                            <span>Manajemen Pengelola</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-bookshelf"></i>
                            <span>Data Arsip</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ url('superadmin/arsip-masuk') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Surat Masuk</a>
                            </li>
                            <li><a href="{{ url('superadmin/arsip-keluar') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Surat Keluar</a></li>
                            <li><a href="{{ url('superadmin/arsip-dokumen') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Dokumen</a></li>
                        </ul>
                    </li>
                   

                    {{-- Pengguna (Pegawai Biasa) --}}
                @elseif(auth()->user()->role == 'pengguna')
                    <li>
                        <a href="{{ url('pengguna/dashboard') }}">
                            <i class="fas fa-desktop"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <li class="menu-title">Menu Utama</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="mdi mdi-bookshelf"></i>
                            <span>Data Arsip</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ url('pengguna/arsip-masuk') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Surat Masuk</a>
                            </li>
                            <li><a href="{{ url('pengguna/arsip-keluar') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Surat Keluar</a></li>
                            <li><a href="{{ url('pengguna/arsip-dokumen') }}"><i
                                        class="mdi mdi-checkbox-blank-circle"></i>
                                    Arsip Dokumen</a></li>
                        </ul>
                    </li>


                @endif
            </ul>
        </div>
    </div>
</div>
