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

    if ($_SESSION["nama"] != "Admin" && $_SESSION["nama"] != "Manager") :
?>

<h1>Maaf hanya admin dan manager yang dapat melihat data produk</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Laporan Gudang</title>
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
    <!-- <script type="text/javascript">
        function pilihTransaksi() {
            var selectBox = document.getElementById("pilih_transaksi");
            selectedValue = selectBox.options[selectBox.selectedIndex].value;
            alert(selectedValue);
        }
    </script> -->
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
            <a href="index.php" style="color: black;">Home</a> -> Laporan Transaksi
                <br><br>
                <p style="font-size: 35px; font-family: Arial, Helvetica, sans-serif;">Laporan Transaksi</p>
                <?php $selected_value = ""; ?>
                <form action="" method="post">
                    Pilih transaksi : 
                    <select name="pilih_transaksi" id="pilih_transaksi" onchange="this.form.submit();">
                        <option value="">-- Pilih jenis transaksi --</option>
                        <option value="penjualan">Penjualan</option>
                        <option value="pembelian">Pembelian</option>
                        <option value="pengeluaran">Pengeluaran</option>
                        <option value="pembayaran">Pembayaran</option>
                    </select>
                    <input type="submit" name="pilih_jenistransaksi" value="Pilih">
                </form>
                <?php
                    $jenis_tranksaksi = "";
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $pilih_transaksi = $_POST["pilih_transaksi"];
                        if ($pilih_transaksi == "penjualan") {
                            $query = "SELECT tanggal_penjualan as tanggal, jumlah, harga 
                                    FROM detil_penjualan d
                                    JOIN penjualan j ON d.penjualan_id = j.id_penjualan
                                    JOIN produk p ON d.produk_id = p.id_produk";
                            $result = mysqli_query($c, $query);

                            $jenis_tranksaksi = "penjualan";
                            echo "Jenis transaksi : <b>" . $jenis_tranksaksi . "</b>";
                        }
                        if ($pilih_transaksi == "pembelian") {
                            $query = "SELECT tanggal_pembelian as tanggal, jumlah, harga 
                                    FROM detil_pembelian d
                                    JOIN pembelian j ON d.pembelian_id = j.id_pembelian
                                    JOIN produk p ON d.produk_id = p.id_produk";
                            $result = mysqli_query($c, $query);

                            $jenis_tranksaksi = "pembelian";
                            echo "Jenis transaksi : <b>" . $jenis_tranksaksi . "</b>";
                        }
                        if ($pilih_transaksi == "pengeluaran") {
                            $query = "SELECT tanggal_pengeluaran as tanggal, jumlah, harga 
                                    FROM pengeluaran";
                            $result = mysqli_query($c, $query);

                            $jenis_tranksaksi = "pengeluaran";
                            echo "Jenis transaksi : <b>" . $jenis_tranksaksi . "</b>";
                        }
                        if ($pilih_transaksi == "pembayaran") {
                            $query = "SELECT tanggal_pembayaran as tanggal, jumlah, harga 
                                    FROM detil_pembayaran
                                    INNER JOIN pembayaran
                                    ON detil_pembayaran.pembayaran_id = pembayaran.id_pembayaran";
                            $result = mysqli_query($c, $query);

                            $jenis_tranksaksi = "pembayaran";
                            echo "Jenis transaksi : <b>" . $jenis_tranksaksi . "</b>";
                        }
                    } else {
                        echo "Jenis transaksi :";
                    }
                ?>
                <br><br>
                <form action="" method="post">
                    Pilih tanggal : <input type="date" name="tanggal_awal">
                    - <input type="date" name="tanggal_akhir">
                    <input type="submit" name="pilih_periode" value="Pilih">
                </form><br>
                <b>
                    <?php
                        $url_cetak = "cetak_laporan_transaksi.php"; 
                        if (isset($_POST["pilih_periode"])){
                            echo $_POST["tanggal_awal"] . " - " . $_POST["tanggal_akhir"];

                            $tanggal_awal = $_POST["tanggal_awal"];
                            $tanggal_akhir = $_POST["tanggal_akhir"];

                            if ($jenis_tranksaksi == "pengeluaran") {
                                $query = "SELECT tanggal_pengeluaran as tanggal, jumlah, harga 
                                          FROM pengeluaran
                                          WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
                                
                                $result = mysqli_query($c, $query);
                            }
                            
                            $url_cetak = "cetak_laporan_transaksi.php?tanggal_awal=".$tanggal_awal."&tanggal_akhir=".$tanggal_akhir;
                        }
                    ?>
                </b>
                <?php if ($jenis_tranksaksi != "") : ?>
                <table border="1" cellpadding="10" cellspacing="0" style="background-color: white;">
                    <tr style="background-color: #C6C5C5;">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["tanggal"]; ?></td>
                        <td><?= $row["jumlah"]; ?></td>
                        <td><?= "Rp " . number_format($row["harga"], 2, ",", "."); ?></td>
                        <td><?= "Rp " . number_format($row["harga"] * $row["jumlah"], 2, ",", "."); ?></td>
                    </tr>
                    <?php $i++ ?>
                    <?php endwhile; ?>
                </table>
                <?php else : ?>
                <table border="1" cellpadding="10" cellspacing="0" style="background-color: white;">
                <tr style="background-color: #C6C5C5;">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                </tr>
                </table>
                <?php endif; ?>
                <br>
                <a href="<?= $url_cetak; ?>"><button>Cetak Laporan</button></a><br><br>
            </div>
        </div>
    </div>
</body>
</html>
<?php endif; ?>