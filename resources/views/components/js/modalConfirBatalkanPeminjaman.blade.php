<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pop up konfirmasi untuk tombol batalkan peminjaman user
        document.querySelectorAll('.btn-cancel').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Konfirmasi Pembatalan',
                    text: "Apakah Anda yakin ingin membatalkan peminjaman ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, batalkan!',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script> 