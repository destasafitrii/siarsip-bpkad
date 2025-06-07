<div class="sidebar-left">

    <div data-simplebar class="h-100">

        <!--- Sidebar-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="left-menu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ url('dashboard') }}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-title">Menu Utama</li>
                <li>
                    <a href="{{ url('arsip_masuk') }}" class="">
                        <i class="mdi mdi-email"></i>
                        <span>Arsip Surat Masuk</span>
                    </a>

                </li>
                <li>
                    <a href="{{ url('arsip_keluar') }}" class="">
                        <i class="mdi mdi-email-open"></i>
                        <span>Arsip Surat Keluar</span>
                    </a>

                </li>
                {{-- <li>
                    <a href="{{ url('pencarian_arsip') }}" class="">
                        <i class="mdi mdi-folder-search"></i>
                        <span>Pencarian Arsip</span>
                    </a>
                </li> --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-tag-multiple"></i>
                        <span>Manajemen Kategori</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('bidang') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Bidang</a></li>
                        <li><a href="{{ url('kategori') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Kategori</a></li>
                    </ul>
                </li>
                <li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-map-marker"></i>
                        <span>Manajemen Lokasi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('ruangan') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Ruangan</a></li>
                        <li><a href="{{ url('lemari') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Lemari/Rak</a></li>
                        <li><a href="{{ url('box') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Box</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-upload"></i>
                        <span>Import Data Arsip</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('arsip_masuk.import.form') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Arsip Surat Masuk</a></li>
                        <li><a href="{{ route('arsip_keluar.import.form') }}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i>
                                Arsip Surat Keluar</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Left Menu End -->
        </div>
        <!-- Sidebar -->
    </div>
</div>
