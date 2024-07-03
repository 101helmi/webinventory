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

    $query = "SELECT * FROM produk WHERE tanggal_keluar";

    $result = mysqli_query($c, $query);

    // var_dump(mysqli_fetch_assoc($result));

    if ($_SESSION["nama"] != "Admin") :
?>

<h1>Maaf hanya admin yang bisa menambah data produk</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Tambah Transaksi Penjualan</title>
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
                <a href="index.php" style="color: black;">Home</a> -> <a href="transaksi_penjualan.php" style="color: black;">Transaksi Penjualan</a> -> Tambah Transaksi Penjualan
                <br><br>
                <p style="font-size: 35px; font-family: Arial, Helvetica, sans-serif;">Tambah Transaksi Penjualan</p>
                <form action="" method="post">
                    <div class="penjualan_barang" style="margin-bottom: -160px;">
                        Pilih produk : 
                        <select name="nama_produk">
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <option value="<?= $row["nama_produk"]; ?>"><?= $row["nama_produk"]; ?></option>
                            <?php endwhile; ?>
                        </select><br><br>
                        Jumlah : <input type="text" name="jumlah"><br><br>
                        Tanggal penjualan : <input type="datetime-local" name="tanggal_penjualan"><br><br>                       
                    </div>
                    
                    <div class="pengiriman_barang" style="margin-left: 360px;">                       
                        Nama pengirim : <input type="text" name="nama_pengirim" id="nama_pengirim" disabled><br><br>
                        Tanggal pengiriman : <input type="datetime-local" name="waktu_pengiriman" id="waktu_pengiriman" disabled><br><br>
                        Catatan pengiriman : <input type="text" name="catatan_pengiriman" id="catatan_pengiriman" disabled><br><br> 
                    </div>
                    <input type="checkbox" name="pengiriman" id="pengiriman">Kirim barang<br><br>   
                    <button type="submit" name="tambahtransaksi">Tambah</button>       
                </form><br>
                <a href="transaksi_penjualan.php"><button>Kembali</button></a><br><br>
                <?php
                    endif;

                    if (isset($_POST["tambahtransaksi"])) {
                        $query1 = "SELECT * FROM penjualan ORDER BY id_penjualan DESC";
                        $result1 = mysqli_query($c, $query1);
                        $data = mysqli_fetch_assoc($result1);

                        if (!$data) {
                            $id_penjualan = 0 + 1;
                        } else {
                            $id_penjualan = $data["id_penjualan"] + 1;
                        }

                        $nama_produk = $_POST["nama_produk"];
                        $jumlah = $_POST["jumlah"];
                        
                        $tanggal_penjualan = $_POST["tanggal_penjualan"];
                        $tanggal_penjualan_convert = strtotime($tanggal_penjualan);
                        $tanggal_penjualan_final = date("ymd", $tanggal_penjualan_convert);

                        $no_nota_penjualan = "1" . $tanggal_penjualan_final . sprintf("%03d", $id_penjualan);

                        $query_penjualan = "INSERT INTO penjualan VALUES ('$id_penjualan','$tanggal_penjualan','1')";

                        $query_produk = "SELECT id_produk, jumlah_produk, harga_produk FROM produk WHERE nama_produk = '$nama_produk' AND tanggal_keluar";
                        $result_produk = mysqli_query($c, $query_produk);
                        $data_produk = mysqli_fetch_assoc($result_produk);

                        $id_produk = $data_produk["id_produk"];
                        $jumlah_produk = $data_produk["jumlah_produk"];
                        $harga = $data_produk["harga_produk"];  
                        
                        $query_detil_penjualan = "INSERT INTO detil_penjualan VALUES ('$no_nota_penjualan','$jumlah','$harga','$id_penjualan','$id_produk')";

                        if ($jumlah_produk <= 0) {
                            echo "<b style='color: red;'>Stok produk yang dipilih kosong</b>";
                        } else if ($jumlah_produk < $jumlah) {
                            echo "<b style='color: red;'>Jumlah stok yang dimasukkan terlalu banyak</b>";
                        } else {
                            mysqli_query($c, $query_penjualan);
                            mysqli_query($c, $query_detil_penjualan);

                            if (isset($_POST["pengiriman"])) {
                                $query2 = "SELECT MAX(id_penjualan) FROM penjualan";
                                $result2 = mysqli_query($c, $query2);
                                $data2 = mysqli_fetch_assoc($result1);
                                if (!$data) {
                                    $id_pengiriman = 0 + 1;
                                } else {
                                    $id_pengiriman = $data2["id_penjualan"] + 1;
                                }

                                $nama_pengirim = $_POST["nama_pengirim"];
                                $waktu_pengiriman = $_POST["waktu_pengiriman"];
                                $catatan_pengiriman = $_POST["catatan_pengiriman"];

                                $query_pengiriman = "INSERT INTO pengiriman VALUES ('$id_pengiriman', '$nama_produk', '$nama_pengirim', '$waktu_pengiriman', '$catatan_pengiriman', '$id_penjualan')";
                                mysqli_query($c, $query_pengiriman);

                                if (mysqli_affected_rows($c) > 0) {
                                    echo "<b>Pengiriman berhasil ditambahkan</b>";
                                    echo "<br>";
                                } else {
                                    echo "<b style='color: red;'>Error.</b>";
                                    echo "<br>";
                                    echo mysqli_error($c);
                                }
                            }
                    
                            $query_update_stok_keluar = "UPDATE produk SET jumlah_produk = $jumlah_produk - $jumlah WHERE nama_produk = '$nama_produk' AND tanggal_keluar";
                    
                            mysqli_query($c, $query_update_stok_keluar);
                    
                            mysqli_affected_rows($c);
                    
                            if (mysqli_affected_rows($c) > 0) {
                                echo "<b>Transaksi penjualan berhasil ditambahkan</b>";
                                echo "<br>";
                            } else {
                                echo "<b style='color: red;'>Error.</b>";
                                echo "<br>";
                                echo mysqli_error($c);
                            }  
                        }    
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    document.getElementById('pengiriman').onchange = function() {
        document.getElementById('nama_pengirim').disabled = !this.checked;
        document.getElementById('waktu_pengiriman').disabled = !this.checked;
        document.getElementById('catatan_pengiriman').disabled = !this.checked;
    };
</script>

