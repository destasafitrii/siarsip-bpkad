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
                    <a href="{{ url('arsip_masuk')}}" class="">
                        <i class="mdi mdi-email"></i>
                        <span>Arsip Surat Masuk</span>
                    </a>

                </li>
                <li>
                    <a href="{{ url('arsip_keluar')}}" class="">
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
                        <i class="fa fa-chart-bar"></i>
                        <span>Manajemen</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('bidang')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Bidang</a></li>
                        <li><a href="{{ url('kategori')}}"><i class="mdi mdi-checkbox-blank-circle align-middle"></i> Kategori</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('import') }}" class="">
                        <i class="mdi mdi-email"></i>
                        <span>Import</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('klasifikasi') }}" class="">
                        <i class="mdi mdi-email"></i>
                        <span>Klasifikasi</span>
                    </a>
                </li>
            </ul>

            <!-- Left Menu End -->
        </div>
        <!-- Sidebar -->
    </div>
</div>