<header id="page-topbar" style="background-color: #f9f9f9; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border-bottom: 1px solid #eaeaea;"  >
    <div class="navbar-header">
        <!-- Logo -->
        <div class="navbar-logo-box" style="background-color: #f9f9f9;  border-bottom: 1px solid #eaeaea;">
            <a class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ url('public') }}/assets/images/logo-ktg.png" alt="logo-sm-dark" height="45">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('public') }}/assets/images/Sipadddd.svg" alt="logo-dark" height="45" >
                </span>
            </a>
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ url('public') }}/assets/images/logo-sm.png" alt="logo-sm-light" height="20">
                </span>
                <span class="logo-lg">
                    <img src="{{ url('public') }}/assets/images/download.jpeg" alt="logo-light" height="100">
                </span>
            </a>
        
        </div>

        <!-- Menu -->
        <div class="d-flex justify-content-end align-items-center px-3 ms-auto">
            {{-- <!-- Notifikasi -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-sm top-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell align-middle"></i>
                    <span class="btn-marker"><i class="marker marker-dot text-danger"></i><span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-md dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown" style="z-index: 1050;">
                    <!-- Konten notifikasi seperti sebelumnya -->
                </div>
            </div>
            <!-- Akhir Notifikasi --> --}}

            <!-- Profil -->
           <div class="dropdown d-inline-block ms-3">
    <button type="button" class="btn btn-sm d-flex align-items-center flex-row gap-2 p-0"
        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <div class="text-end">
            <div class="fw-semibold" style="font-size: 14px;">{{ Auth::user()->name }}</div>
            <div class="text-muted" style="font-size: 12px;">{{ Auth::user()->opd->nama_opd ?? '-' }}</div>
        </div>

        <div class="bg-light rounded-circle p-2">
            <i class="fa fa-user-alt"></i>
        </div>
    </button>


    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated shadow border-0 overflow-hidden"
        style="min-width: 250px; z-index: 1050;">
        <div class="card border-0 mb-0">
            <!-- Header Profile -->
            <div class="card-header text-white bg-gradient bg-success rounded-0 d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <div class="me-2 bg-white rounded-circle p-1">
                        <i class="fa fa-user-alt text-success"></i>
                    </div>
                    <div>
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <div style="font-size: 0.875rem;">{{ Auth::user()->email }}</div>
                        <div style="font-size: 0.75rem;">{{ Auth::user()->opd->nama_opd ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Body Menu -->
            <div class="card-body px-0 py-2">
                <div class="card-body px-0 py-2">
                 <a href="{{ route('profil') }}" class="dropdown-item d-flex align-items-center px-3 py-2">
        <i class="fas fa-user me-2 text-primary"></i> Profil
    </a>
              <!-- Tombol logout pakai SweetAlert -->
<button type="button" class="dropdown-item d-flex align-items-center px-3 py-2" id="btnLogout">
    <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
</button>

<!-- Form logout tersembunyi -->
<form id="formLogout" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

            </div>
        </div>
    </div>
</div>
        </div>
</header>
