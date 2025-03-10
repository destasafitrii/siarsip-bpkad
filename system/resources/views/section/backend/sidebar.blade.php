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
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-email"></i>
                        <span>Arsip Surat Masuk</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('arsip_masuk')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Daftar Arsip Masuk </a></li>
                        <li><a href="{{ url('pencarian-arsip-masuk')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Pencarian Arsip Masuk</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="mdi mdi-email-open"></i>
                        <span>Arsip Surat Keluar</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('arsip_keluar')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Daftar Arsip Keluar </a></li>
                        <li><a href="{{ url('pencarian-arsip-keluar')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Pencarian Arsip Keluar</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="{{ url('pencarian_arsip') }}" class="">
                        <i class="mdi mdi-folder-search"></i>
                        <span>Pencarian Arsip</span>
                    </a>
                </li> --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fa fa-chart-bar"></i>
                        <span>Manajemen</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('bidang')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Bidang</a></li>
                        <li><a href="{{ url('kategori')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Kategori</a></li>
                    </ul>
                </li>
                {{-- <li>
                    <a href="{{ url('#') }}" class="">
                        <i class="mdi mdi-email"></i>
                        <span>Impor/Ekspor Arsip</span>
                    </a>
                </li> --}}
            </ul>
            
            <!-- Left Menu End -->
        </div>
        <!-- Sidebar -->
    </div>
</div>
