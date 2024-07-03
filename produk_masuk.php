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

    if ($_SESSION["nama"] != "Kepala Gudang") :
?>

<h1>Maaf hanya kepala gudang yang bisa menambah data produk</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                                    <a href="laporan_gudang.php" class="nav-link px-0"> <span class="d-none d-sm-inline" style="font-size: 15px;">Laporan</span></a>
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
                <a href="gudang.php" style="color: black;">Home</a> -> <a href="gudang.php" style="color: black;">Gudang</a> -> Tambah Produk Masuk
                <br><br>
                <p style="font-size: 35px; font-family: Arial, Helvetica, sans-serif;">Tambah Produk Masuk</p>
                <form action="" method="post">
                    Nama produk : <input type="text" name="nama_produk" required><br><br>
                    Jenis produk : <input type="text" name="jenis_produk" required><br><br>
                    Jumlah : <input type="text" name="jumlah_produk" required><br><br>
                    Harga satuan : <input type="text" name="harga_produk" required><br><br>
                    Tanggal Masuk Produk : <input type="datetime-local" name="tanggal_masuk" required><br><br>
                    Satuan : <input type="text" name="satuan" required><br><br>
                    <button type="submit" name="tambahproduk">Tambah</button>       
                </form><br>
                <a href="gudang.php"><button>Kembali</button></a><br><br>
                <?php
                    endif;

                    $query = "SELECT * 
                             FROM produk p
                             INNER JOIN riwayatstok r
                             ON p.id_produk = r.produk_id
                             ORDER BY id_produk DESC";
                            
                    $result = mysqli_query($c, $query);
                    $data = mysqli_fetch_assoc($result);

                    if (isset($_POST["tambahproduk"])) {
                        $nama_produk = $_POST["nama_produk"];
                        $jenis_produk = $_POST["jenis_produk"];
                        $jumlah_produk = $_POST["jumlah_produk"];
                        $harga_produk = $_POST["harga_produk"];
                        $tanggal_masuk = $_POST["tanggal_masuk"];
                        $satuan = $_POST["satuan"];

                        if (!$data) {
                            $id_produk = 0 + 1;
                            $id_riwayatstok = 0 + 1;
                        } else {
                            $id_produk = $data["id_produk"] + 1;
                            $id_riwayatstok = $data["id_riwayatstok"] + 1;
                        }

                        $query1 = "INSERT INTO produk VALUES ('$id_produk', '$nama_produk', '$jenis_produk', '$jumlah_produk', '$harga_produk', '$tanggal_masuk', '', '$satuan', '1')";
                        $query2 = "INSERT INTO riwayatstok VALUES ('$id_riwayatstok', '$tanggal_masuk', '$jumlah_produk', '$id_produk', '1')";

                        mysqli_query($c, $query1);
                        mysqli_query($c, $query2);
                        mysqli_affected_rows($c);

                        if (mysqli_affected_rows($c) > 0) {
                            echo "<b>Produk berhasil ditambahkan ke gudang</b>";
                        } else {
                            echo "<b style='color: red;'>Error.</b>";
                            echo "<br>";
                            echo mysqli_error($c);
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

