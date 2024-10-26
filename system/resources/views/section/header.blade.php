<header id="page-topbar">
    <div class="navbar-header">
        <!-- Logo -->
        <div class="navbar-logo-box">
            <a class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{url('public')}}/assets/images/logo-ktg.png" alt="logo-sm-dark" height="45">
                </span>
                <span class="logo-lg">
                    <img src="{{url('public')}}/assets/images/download.jpeg" alt="logo-dark" height="100">
                </span>
            </a>
            <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{url('public')}}/assets/images/logo-sm.png" alt="logo-sm-light" height="20">
                </span>
                <span class="logo-lg">
                    <img src="{{url('public')}}/assets/images/download.jpeg" alt="logo-light" height="100">
                </span>
            </a>
            <button type="button" class="btn btn-sm top-icon sidebar-btn" id="sidebar-btn">
                <i class="mdi mdi-menu-open align-middle fs-19"></i>
            </button>
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
                <button type="button" class="btn btn-sm top-icon p-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class ="fa fa-user-alt"></i> 
                    {{-- <img class="rounded avatar-2xs p-0" src="{{url('public')}}/assets/images/users/avatar-1.png" alt="Header Avatar"> --}}
                </button>
                <div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0" style="z-index: 1050;">
                    <div class="card border-0">
                        <div class="card-header bg-primary rounded-0">
                            <div class="rich-list-item w-100 p-0">
                                <div class="rich-list-prepend">
                                    <div class="avatar avatar-label-light avatar-circle">
                                        <div class="avatar-display"><i class="fa fa-user-alt"></i></div>
                                    </div>
                                </div>
                                <div class="rich-list-content">
                                    <h3 class="rich-list-title text-white">Charlie Stone</h3>
                                    <span class="rich-list-subtitle text-white">admin@codubucks.in</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                <div class="grid-nav-row">
                                    <a href="apps-contact.html" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="far fa-address-card"></i></div>
                                        <span class="grid-nav-content">Profile</span>
                                    </a>
                                    <a href="#!" class="grid-nav-item">
                                        <div class="grid-nav-icon"><i class="fas fa-sign-out-alt"></i></div>
                                        <span class="grid-nav-content">Logout</span>
                                    </a>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Profil -->
        </div>
    </div>
</header>

