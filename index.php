<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kp_jayaperkasa";

    $c = new mysqli($servername, $username, $password, $dbname);
    if ($c->connect_errno) {
        echo $c->connect_errno;
    }
    
    if (!isset($_SESSION["nama"])) {
        header("location: login.php");
        exit;
    }

    $query_produkmasuk = "SELECT SUM(jumlah_produk) FROM produk WHERE tanggal_masuk";
    $result_produkmasuk = mysqli_query($c, $query_produkmasuk);
    $masuk = mysqli_fetch_assoc($result_produkmasuk);

    $query_produkkeluar = "SELECT SUM(jumlah_produk) FROM produk WHERE tanggal_keluar";
    $result_produkkeluar = mysqli_query($c, $query_produkkeluar);
    $keluar = mysqli_fetch_assoc($result_produkkeluar);

    $barang_gudang = $masuk["SUM(jumlah_produk)"] - $keluar["SUM(jumlah_produk)"];

    // Jika produk akan habis
    $query_sedikit = "SELECT COUNT(jumlah_produk) as sisa_stok FROM produk WHERE jumlah_produk < 10 AND tanggal_masuk";
    $result_sedikit = mysqli_query($c, $query_sedikit);
    $data_sedikit = mysqli_fetch_assoc($result_sedikit);

    // Jika produk sudah habis
    $query_habis = "SELECT COUNT(jumlah_produk) as sisa_stok FROM produk WHERE jumlah_produk = 0 AND tanggal_masuk";
    $result_habis = mysqli_query($c, $query_habis);
    $data_habis = mysqli_fetch_assoc($result_habis);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #F6E8DA;
        }
        span {
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #8B4513;">
        <div class="container-fluid">
            <a class="navbar-brand" style="padding-left: 20px; padding-right: 1000px; color: white;">Toko Jaya Perkasa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" style="color: white;"><?= $_SESSION["nama"] ?></a>
                    </li>
                </ul>                
            </div>
        </div>
    </nav>
    <div class="container-fluid pt-5">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <a href="index.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline" style="font-size: 20px;">Dashboard</span></a>
                        </li>
                        <?php if ($_SESSION["nama"] == "Admin" || $_SESSION["nama"] == "Manager") : ?>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline" style="font-size: 20px;">Master Transaksi</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="transaksi_penjualan.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Transaksi Penjualan</span></a>
                                </li>
                                <li>
                                    <a href="transaksi_pembelian.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Transaksi Pembelian</span></a>
                                </li>
                                <li>
                                    <a href="transaksi_pengeluaran.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Transaksi Pengeluaran</span></a>
                                </li>
                                <li>
                                    <a href="transaksi_pembayaran.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Transaksi Pembayaran</span></a>
                                </li>
                                <li>
                                    <a href="retur_penjualan.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Retur Penjualan</span></a>
                                </li>
                                <li>
                                    <a href="retur_pembelian.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Retur Pembelian</span></a>
                                </li>
                                <li>
                                    <a href="pengiriman.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Pengiriman</span></a>
                                </li>
                                <li>
                                    <a href="laporan_transaksi.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Laporan Transaksi</span></a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php if ($_SESSION["nama"] == "Kepala Gudang" || $_SESSION["nama"] == "Manager") : ?>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline" style="font-size: 20px;">Master Gudang</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="gudang.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Gudang</span></a>
                                </li>
                                <li class="w-100">
                                    <a href="supplier.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Supplier</span></a>
                                </li>
                                <?php if ($_SESSION["nama"] == "Kepala Gudang") : ?>
                                <li>
                                    <a href="produk_masuk.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Tambah Produk Masuk</span></a>
                                </li>
                                <li>
                                    <a href="produk_keluar.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Tambah Produk Keluar</span></a>
                                </li>
                                <?php endif; ?>
                                <li>
                                    <a href="riwayatstok.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Riwayat Stok</span></a>
                                </li>
                                <li>
                                    <a href="laporan_gudang.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Laporan Gudang</span></a>
                                </li>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline" style="font-size: 20px;">Akun</span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="logout.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Logout</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    
                </div>
            </div>
            <div class="col py-5">
                <div class="row ps-5 pe-5">
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body" style="background-color: #4169E1;">
                            <h5 class="card-title" style="color: white;"><?= $barang_gudang; ?></h5>
                            <p class="card-text" style="color: white;">Total barang di gudang</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body" style="background-color: #4169E1;">
                            <h5 class="card-title" style="color: white;"><?= $keluar["SUM(jumlah_produk)"]; ?></h5>
                            <p class="card-text" style="color: white;">Total barang yang siap dijual</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body" style="background-color: #FF7F00;">
                            <h5 class="card-title" style="color: white;"><?= $data_sedikit["sisa_stok"]; ?></h5>
                            <p class="card-text" style="color: white;">Jumlah produk akan habis</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                        <div class="card-body" style="background-color: #DC143C;">
                            <h5 class="card-title" style="color: white;"><?= $data_habis["sisa_stok"]; ?></h5>
                            <p class="card-text" style="color: white;">Jumlah produk sudah habis</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>