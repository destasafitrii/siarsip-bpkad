<footer class="footer">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <script>document.write(new Date().getFullYear())</script> © Sistem Pengelolaan Arsip Perangkat Daerah | Ketapang
            </div>
        </div>
    </div>
</footer>

<style>
    .footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: rgba(255, 255, 255, 0) !important;
    /* backdrop-filter: blur(2px); */

    border-top: 1px solid #dee2e6;
    padding: 10px 0;
    transition: all 0.3s ease;
}

/* Ketika sidebar tidak collapsed */
.footer {
    margin-left: 245px; /* Sesuaikan dengan lebar sidebar penuh */
}

/* Ketika sidebar collapsed */
.sidebar-collapsed .footer {
    margin-left: 80px; /* Sesuaikan dengan lebar sidebar kecil */
}
</style>