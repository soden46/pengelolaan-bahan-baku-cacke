<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    // Add Row
    $(document).ready(function() {
        // Ketika id_barang diubah, tampilkan nama_barang yang sesuai
        $('#tbody1').on('change', 'select[name="id_barang[]"]', function() {
            var barangID = $(this).val();
            var namaBarangSelect = $(this).closest('tr').find('select[name="barang[]"]');
            if (barangID) {
                $.ajax({
                    url: '/getBarangNama/' + barangID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Bersihkan dan tambahkan opsi nama barang
                        namaBarangSelect.empty();
                        if (data) {
                            $.each(data, function(key, value) {
                                namaBarangSelect.append('<option value="' + value + '">' + value + '</option>');
                            });
                        } else {
                            namaBarangSelect.append('<option value="" selected>Nama Barang</option>');
                        }
                    }
                });
            } else {
                // Jika tidak ada id_barang yang dipilih, reset nama_barang
                namaBarangSelect.empty();
                namaBarangSelect.append('<option value="" selected>Nama Barang</option>');
            }
        });

        // Ketika tombol tambah diklik, tambahkan baris baru
        $('#addBtn1').on('click', function() {
            var newRow = '<tr id="R' + ($('#tbody1 tr').length + 1) + '">';
            newRow += '<td class="row-index">';
            newRow += '<select class="form-control" name="id_barang[]" required>';
            newRow += '<option value="option_select" disabled selected>Kode Barang</option>';
            @foreach($barang as $bar)
            newRow += '<option value="{{ $bar->kode_barang }}">{{ $bar->kode_barang }}</option>';
            @endforeach
            newRow += '</select>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<select class="form-control" name="barang[]" required>';
            newRow += '<option value="" selected>Nama Barang</option>';
            newRow += '</select>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<input type="number" name="qty[]" class="form-control" placeholder="Masukan Qty Barang" required>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<input type="number" name="harga[]" step="0.0" class="form-control" placeholder="Masukan harga" required>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<input type="date" name="tanggal[]" class="form-control" placeholder="Masukan tanggal" required>';
            newRow += '</td>';
            newRow += '<td>';
            newRow += '<button class="btn btn-danger btn-sm mb-3 remove" type="button"><i class="fas fa-trash"></i></button>';
            newRow += '</td>';
            newRow += '</tr>';
            $('#tbody1').append(newRow);
        });

        // Menghapus baris ketika tombol hapus diklik
        $('#tbody1').on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });

        // Ketika id_barang diubah, tampilkan nama_barang yang sesuai
        $('#tbody2').on('change', 'select[name="id_barang[]"]', function() {
            var barangID = $(this).val();
            var namaBarangSelect = $(this).closest('tr').find('select[name="barang[]"]');
            if (barangID) {
                $.ajax({
                    url: '/getBarangNama/' + barangID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // Bersihkan dan tambahkan opsi nama barang
                        namaBarangSelect.empty();
                        if (data) {
                            $.each(data, function(key, value) {
                                namaBarangSelect.append('<option value="' + value + '">' + value + '</option>');
                            });
                        } else {
                            namaBarangSelect.append('<option value="" selected>Nama Barang</option>');
                        }
                    }
                });
            } else {
                // Jika tidak ada id_barang yang dipilih, reset nama_barang
                namaBarangSelect.empty();
                namaBarangSelect.append('<option value="" selected>Nama Barang</option>');
            }
        });

        // Ketika tombol tambah diklik, tambahkan baris baru
        $('#addBtn2').on('click', function() {
            var newRow = '<tr id="R' + ($('#tbody2 tr').length + 1) + '">';
            newRow += '<td class="row-index">';
            newRow += '<select class="form-control" name="id_barang[]" required>';
            newRow += '<option value="option_select" disabled selected>Kode Barang</option>';
            @foreach($barang as $bar)
            newRow += '<option value="{{ $bar->kode_barang }}">{{ $bar->kode_barang }}</option>';
            @endforeach
            newRow += '</select>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<select class="form-control" name="barang[]" required>';
            newRow += '<option value="" selected>Nama Barang</option>';
            newRow += '</select>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<input type="number" name="qty[]" class="form-control" placeholder="Masukan Qty Barang" required>';
            newRow += '</td>';
            newRow += '<td class="row-index">';
            newRow += '<input type="date" name="tanggal[]" class="form-control" placeholder="Masukan tanggal" required>';
            newRow += '</td>';
            newRow += '<td>';
            newRow += '<button class="btn btn-danger btn-sm mb-3 remove" type="button"><i class="fas fa-trash"></i></button>';
            newRow += '</td>';
            newRow += '</tr>';
            $('#tbody2').append(newRow);
        });

        // Menghapus baris ketika tombol hapus diklik
        $('#tbody2').on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });

        // Detail Barang Masuk
        $(document).ready(function() {
            $('#detailBarangMasukModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var detailBarangMasuks = JSON.parse(button.data('detailBarangMasuks'));

                var modalBody = $(this).find('.modal-body table tbody');
                modalBody.empty(); // Clear existing content

                $.each(detailBarangMasuks, function(index, detail) {
                    // ... (build table rows)
                });
            });
        });
    });
</script>