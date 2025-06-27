<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk dropdown pemilih peminjam
        $('#user_id').select2({
            placeholder: 'Cari dan Pilih Peminjam...',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Tidak ada hasil yang ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });

        // Inisialisasi Select2 untuk dropdown pemilih buku
        $('#book_id').select2({
            placeholder: 'Cari dan Pilih Buku...',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Tidak ada buku yang ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });
    });
</script>