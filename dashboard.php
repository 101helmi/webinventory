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
            background-color: #F7F8FE;
        }
        span {
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #8B4513;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
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
                            </ul>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline" style="font-size: 20px;"><?= $_SESSION["nama"] ?></span></a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
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
                <h4>User = <?= $_SESSION["nama"] ?></h4>
                <a href="logout.php">Logout</a>
                <h1>Dashboard</h1>
                <h3>Total barang di gudang = <?= $barang_gudang; ?></h3>
                <h3>Total barang yang siap dijual = <?= $keluar["SUM(jumlah_produk)"]; ?></h3>
                <h3>Jumlah produk yang akan habis = </h3>
                <h3>Jumlah produk yang sudah habis = </h3>
                <a href="transaksi.php"><button>Transaksi</button></a><br><br>
            </div>
        </div>
    </div>
</body>
</html>