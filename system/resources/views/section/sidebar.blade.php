<div class="sidebar-left">

    <div data-simplebar class="h-100">

        <!--- Sidebar-menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="left-menu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ url('/') }}" class="">
                        <i class="fas fa-desktop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{-- <li class="menu-title">Elements</li> --}}
                <li>
                    <a href="javascript: void(0);" class="has-arrow ">
                        <i class="fa fa-folder"></i>
                        <span>ARSIPAN</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('arsip/create') }}"><i class="mdi mdi-folder-plus"
                                    style="
                                    font-size: 14px;
                                "></i>Tambah
                                Arsip</a></li>
                        <li><a href="{{ url('arsip') }}"><i class="mdi mdi-folder-search"
                            style="
                            font-size: 14px;
                        "></i>Cari
                                Arsip</a></li>
                        <li><a href="{{ url('#') }}"><i class="mdi mdi-microsoft-excel"
                                    style="
                                    font-size: 14px;
                        "></i>Impor/Ekspor
                                Arsip</a></li>
                    </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
