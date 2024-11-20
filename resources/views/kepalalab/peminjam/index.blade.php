<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Lab</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets//plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets//dist/css/adminlte.min.css') }}">
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <script>
        \
        Carbon\ Carbon::setLocale('id');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="icon" href="{{ asset('assets/dist/img/logounib.png') }}" type="image/png">


</head>
<style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        background: linear-gradient(to right, #3cb1ff, rgb(58, 153, 247));
        /* Gradien warna latar belakang */
        color: #fff;
    }

    .modal-title {
        font-size: 24px;
        font-weight: bold;
    }

    .modal-label {
        font-size: 18px;
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #3498db;
        border-radius: 8px;
        color: #333;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #2ecc71;
        box-shadow: 0 0 0 0.2rem rgba(46, 204, 113, 0.25);
    }

    .modal-footer {
        background: linear-gradient(to right, #3cb1ff, rgb(58, 153, 247));
        /* Gradien warna latar belakang footer */
        border-top: 1px solid #fff;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #2ecc48;
        color: #fff;
    }

    .sidebar .nav-item {
        margin-bottom: 5px;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }

    .table-striped tbody tr:nth-child(even) {
        background-color: #ffffff;
    }
</style>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('assets/dist/img/logounib.png ') }}" alt="AdminLTE Logo "
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Inventaris Lab</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/dist/img/logouser.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('kepalalab.profile.index', ['id' => auth()->user()->id]) }}" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('datapeminjaman.kepalalab') }}" class="nav-link">
                                <i class="fas fa-th-large"></i>
                                <p>
                                    Daftar Peminjaman
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('kategori.kepalalab') }}" class="nav-link">
                                <i class="nav-icon fas fa-shapes"></i>
                                <p>
                                    Kategori Barang
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('barang.kepalalab') }}"
                                class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Daftar Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview {{ Request::is('kepalalab/peminjam*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-feather"></i>
                                <p>
                                    Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('tersedia.kepalalab') }}" class="nav-link ">
                                        <i class="fas fa-list-ul"></i>
                                        <p>Barang Tersedia</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('peminjam.kepalalab') }}"
                                        class="nav-link {{ Request::is('kepalalab/peminjam*') ? 'active' : '' }}">
                                        <i class="fas fa-file-invoice"></i>
                                        <p>Peminjaman Barang</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('riwayatpeminjam.kepalalab') }}"
                                class="nav-link {{ Request::is('Riwayatpeminjam*') ? 'active' : '' }}">
                                <i class="fas fa-indent"></i>
                                <p>Riwayat Peminjaman</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporaninventaris.kepalalab') }}"
                                class="nav-link">
                                <i class="fas fa-cogs"></i>
                                <p>
                                    Pemeliharaan Inventaris
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Manajemen User
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('lokasi.kepalalab') }}"
                                class="nav-link">
                                <i class="fas fa-door-closed"></i>
                                <p>
                                    Lokasi
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="nav-link"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </form>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Transaksi</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DAFTAR PEMINJAM</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '{{ $message }}',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>
                        @endif

                        @if ($error = Session::get('error'))
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: '{{ $error }}',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK'
                                });
                            </script>
                        @endif
                        <div class="box-body">
                            <div class="container">
                                <button style="margin-bottom: 20px; width: 190px; height: 40px; border-radius: 20px;"
                                    data-toggle="modal" data-target="#myModal" class="btn btn-info"><span
                                        class="glyphicon glyphicon-plus"></span>Tambah Data peminjam</button>
                                <table id="datatabel" class="table table-striped table-bordered" style="width:100%">
                                    <thead style="background-color: rgba(27, 145, 255, 0.726); color: rgb(0, 0, 0);">
                                        <tr>
                                            <th>No</th>
                                            <th>Pengurus</th>
                                            <th>NPM</th>
                                            <th>Nama peminjam</th>
                                            <th>Kontak</th>
                                            <th>Instansi</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Keterangan Peminjaman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data_peminjam as $items)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $items->user->name }}</td>
                                                <td>{{ $items->NPM }}</td>
                                                <td>{{ $items->namapeminjam }}</td>
                                                <td>{{ $items->kontak }}</td>
                                                <td>{{ $items->instansi }}</td>
                                                <td>{{ \Carbon\Carbon::parse($items->created_at)->formatLocalized('%A, %d %B %Y %H:%M') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($items->tanggalpengembalian)->formatLocalized('%A, %d %B %Y %H:%M') }}
                                                </td>
                                                <td>{{ $items->keterangan }}</td>
                                                <td>
                                                    <div
                                                        style="display: flex; gap: 10px; justify-content: center; align-items: center;">

                                                        @if ($items->status == 'disetujui')
                                                            @php
                                                                $peminjaman = $items->peminjamans->first();
                                                            @endphp
                                                            @if ($peminjaman)
                                                                <a href="{{ route('peminjamankepalalab.cetakpdf', ['idpeminjaman' => $peminjaman->idpeminjaman, 'idpeminjam' => optional($peminjaman->peminjam)->idpeminjam]) }}"
                                                                    class="btn btn-info">
                                                                    <i class="fas fa-print"> Cetak</i>
                                                                </a>
                                                            @else
                                                                <span class="text-muted">Data peminjaman tidak
                                                                    tersedia</span>
                                                            @endif
                                                        @endif

                                                        @if ($items->status == 'ditolak')
                                                            <form
                                                                action="{{ route('peminjamkepalalab.hapus', ['peminjam' => $items->idpeminjam]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    @if ($items->status == 'ditolak')
                                                                        <i class="fas fa-trash-alt"> Peminjaman
                                                                            Ditolak</i>
                                                                    @else
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    @endif
                                                                </button>
                                                            </form>
                                                        @endif

                                                        <form method="get"
                                                            action="{{ route('peminjamankepalalab.index', ['idpeminjam' => $items->idpeminjam]) }}">
                                                            <button type="submit" class="btn btn-primary">
                                                                <i class="fas fa-file-alt"></i>
                                                            </button>

                                                        </form>

                                                        <form method="post"
                                                            action="{{ route('peminjamankepalalab.selesai', ['idpeminjam' => $items->idpeminjam]) }}"
                                                            id="selesaiForm">
                                                            @csrf
                                                            <button type="button" class="btn btn-success"
                                                                onclick="confirmSelesai()">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>

                                                            <button data-toggle="modal"
                                                                data-target="#modaledit_{{ $items->idpeminjam }}"
                                                                class="btn btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <button class="btn btn-danger" data-toggle="modal"
                                                                data-target="#modaldelete_{{ $items->idpeminjam }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>


                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <a href="{{ route('peminjamcetak.kepalalab') }}" class="btn btn-primary">
                                    <i class="fas fa-print"> CETAK DATA</i>
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{-- Footer --}}
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2024 INVENTARIS LAB INFORMATIKA</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- modal input -->

    @if (!empty($data_peminjam))
        @foreach ($data_peminjam as $item)
            <!-- Modal Edit -->
            <div id="modaledit_{{ $item->idpeminjam }}" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data Peminjam</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="post"
                                action="{{ route('peminjamkepalalab.update', ['idpeminjam' => $item->idpeminjam]) }}"
                                novalidate>
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                <div class="form-group">
                                    <label for="edit-NPM" class="modal-label">Nama Peminjam</label>
                                    <input type="text" id="edit-NPM" name="NPM" value="{{ $item->NPM }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit-nama-peminjam" class="modal-label">Nama Peminjam</label>
                                    <input type="text" id="edit-nama-peminjam" name="namapeminjam"
                                        value="{{ $item->namapeminjam }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-kontak" class="modal-label">Kontak Peminjam</label>
                                    <input type="text" id="edit-kontak" name="kontak"
                                        value="{{ $item->kontak }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-instansi" class="modal-label">Instansi Peminjam</label>
                                    <input type="text" id="edit-instansi" name="instansi"
                                        value="{{ $item->instansi }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-keterangan" class="modal-label">Keterangan Peminjaman</label>
                                    <input type="text" id="edit-keterangan" name="keterangan"
                                        value="{{ $item->keterangan }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-tanggal-pengembalian" class="modal-label">Tanggal
                                        Pengembalian</label>
                                    <input type="datetime-local" id="edit-tanggal-pengembalian"
                                        name="tanggalpengembalian"
                                        value="{{ \Carbon\Carbon::parse($item->tanggalpengembalian)->format('Y-m-d\TH:i') }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-created-at" class="modal-label">Tanggal Peminjaman</label>
                                    <input type="datetime-local" id="edit-created-at" name="created_at"
                                        value="{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d\TH:i') }}"
                                        class="form-control" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Delete -->
            <div class="modal fade" id="modaldelete_{{ $item->idpeminjam }}" tabindex="-1" role="dialog"
                aria-labelledby="modaldelete_{{ $item->idpeminjam }}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modaldelete_{{ $item->idpeminjam }}Label">Konfirmasi
                                penghapusan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus data peminjam ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('peminjamkepalalab.hapus', ['peminjam' => $item->idpeminjam]) }}"
                                method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-danger" style="text-align: center">
            Tidak ada data peminjam.
        </div>
    @endif

    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">MASUKAN DATA PEMINJAM</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="myForm" action="{{ route('peminjamkepalalab.post') }}" novalidate>
                        @csrf

                        <input type="hidden" name="id" value="{{ Auth::id() }}">

                        <div class="form-group">
                            <label class="modal-label">NPM</label>
                            <input name="NPM" id="NPM" type="text" autocomplete="off"
                                class="form-control" placeholder="NPM" required>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Nama Peminjam</label>
                            <input name="namapeminjam" id="namapeminjam" type="text" autocomplete="off"
                                class="form-control" placeholder="Nama Peminjam" required>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Kontak Peminjam</label>
                            <input name="kontak" id="kontak" type="text" autocomplete="off"
                                class="form-control" placeholder="Kontak" required>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Instansi Peminjam</label>
                            <input name="instansi" id="instansi" type="text" autocomplete="off"
                                class="form-control" placeholder="Instansi" required>
                        </div>
                        <div class="form-group">
                            <label class="modal-label">Keterangan Peminjaman</label>
                            <input name="keterangan" id="keterangan" type="text" autocomplete="off"
                                class="form-control" placeholder="Keterangan" required>
                        </div>
                        <div class="form-group">
                            <label class="modal-label" for="tanggalpengembalian">Tanggal Pengembalian</label>
                            <input type="datetime-local" class="form-control" id="tanggalpengembalian"
                                name="tanggalpengembalian" required
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}">
                        </div>

                        <div class="form-group">
                            <label class="modal-label" for="created_at">Tanggal Peminjaman</label>
                            <input type="datetime-local" class="form-control" id="created_at" name="created_at"
                                required value="{{ \Carbon\Carbon::now()->format('Y-m-d\TH:i:s') }}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ./wrapper -->

    <!-- jQuery -->
    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            var namapeminjam = document.getElementById('namapeminjam').value;
            var kontak = document.getElementById('kontak').value;
            var instansi = document.getElementById('instansi').value;
            var durasi = document.getElementById('durasi').value;
            var keterangan = document.getElementById('keterangan').value;
            var created_at = document.getElementById('created_at').value;

            if (!namapeminjam || !kontak || !instansi || !durasi || !keterangan || !created_at) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua kolom harus diisi!',
                });

                event.preventDefault(); // Prevent form submission
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datakategoribarang').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Cetak PDF',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6] // Sesuaikan dengan kolom yang ingin dicetak
                    }
                }]
            });
        });
    </script>


@if(isset($items))
    <script>
        function confirmSelesai() {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menyelesaikan peminjaman?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set action formulir sesuai dengan kebutuhan
                    var form = document.getElementById('selesaiForm');
                    form.action = '{{ route("peminjamankepalalab.selesai", ["idpeminjam" => isset($items) ? $items->idpeminjam : null]) }}';

                    // Submit formulir jika dikonfirmasi
                    form.submit();
                }
            });
        }
    </script>
@endif





    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-4h+BRmBl5S9WJotZIv6KGanRgDFGg/M93ba8zRVcqsILwvCWpR9tC6zW+oRb26qJ" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-rfIEsHV2RvU9z4uZDf1eIHsj4nAjQ0d30z5fS4U9LjPi3ecSQ3xqC2CMEZ7gxzVo" crossorigin="anonymous">
    </script>

    <!-- DataTables Initialization Script -->
    <script>
        $(function() {
            $("#datatabel").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>



    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
