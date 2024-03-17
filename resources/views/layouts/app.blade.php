<x-laravel-ui-adminlte::adminlte-layout>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <span class="d-none d-md-inline"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="https://assets.infyom.com/logo/blue_logo_150x150.png" class="img-circle elevation-2" alt="User Image">
                                <p>

                                    <small>Bergabung Pada </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
        <!-- Dependent Select -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('#id_barang').on('change', function() {
                    var barangID = $(this).val();
                    if (barangID) {
                        $.ajax({
                            url: '/getBarang/' + barangID,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                if (data) {
                                    $('#barang').val(data);
                                } else {
                                    $('#barang').val('');
                                }
                            }
                        });
                    } else {
                        $('#barang').val('');
                    }
                });
            });
            // Detail Barang Masuk
            $(document).ready(function() {
                $('#detailBarangMasukModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var detailBarangMasuks = JSON.parse(button.data('detailBarangMasuks'));

                    var modalBody = $(this).find('.modal-body table tbody');
                    modalBody.empty(); // Clear existing content

                    $.each(detailBarangMasuks, function(index, detail) {
                        var row = '<tr>';
                        row += '<td>' + (index + 1) + '</td>';
                        row += '<td>' + detail.barang.nama_barang + '</td>';
                        row += '<td>' + detail.qty + '</td>';
                        row += '<td>' + detail.harga.toLocaleString('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }) + '</td>';
                        row += '</tr>';

                        modalBody.append(row);
                    });
                });
            });
        </script>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>