<div class="position-fixed top-0 end-0 p-3" style="z-index: 1111">
    @foreach (['success', 'warning', 'danger'] as $status)
        @if (session($status))
            <div class="toast overflow-hidden mt-3 alert alert-{{ $status }} alert-dismissible fade show custom-{{ $status }}-box"
                role="alert" aria-live="assertive" aria-atomic="true" autoc>
                <div class="d-flex align-items-center bg-label-{{ $status }}">
                    <div class="toast-body" style="padding: 0;">
                        <strong>{{ session($status) }}</strong>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menampilkan semua notifikasi yang tersedia
        const toastElements = document.querySelectorAll('.toast');
        toastElements.forEach(toastEl => {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
</script>
