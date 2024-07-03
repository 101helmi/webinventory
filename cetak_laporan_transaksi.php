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

    $pilih_transaksi = $_GET["jenis_transaksi"];
    // $penjualan = $_GET["penjualan"];
    // $pembelian = $_GET["pembelian"];
    // $pengeluaran = $_GET["pengeluaran"];
    // $pembayaran = $_GET["pembayaran"];

    $tanggal_awal = $_GET["tanggal_awal"];
    $tanggal_akhir = $_GET["tanggal_akhir"];

    if ($pilih_transaksi == "Penjualan") {
        if ($tanggal_awal == $_GET["tanggal_awal"] && $tanggal_akhir == $_GET["tanggal_akhir"]) {
            $query = "SELECT tanggal_penjualan as tanggal, jumlah, harga 
                      FROM detil_penjualan d
                      JOIN penjualan j ON d.penjualan_id = j.id_penjualan
                      JOIN produk p ON d.produk_id = p.id_produk
                      WHERE tanggal_penjualan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $result = mysqli_query($c, $query);
        } else {
            $query = "SELECT tanggal_penjualan as tanggal, jumlah, harga 
                      FROM detil_penjualan d
                      JOIN penjualan j ON d.penjualan_id = j.id_penjualan
                      JOIN produk p ON d.produk_id = p.id_produk";
            $result = mysqli_query($c, $query);
        }
    }
    if ($pilih_transaksi == "Pembelian") {
        if ($tanggal_awal == $_GET["tanggal_awal"] && $tanggal_akhir == $_GET["tanggal_akhir"]) {
            $query = "SELECT tanggal_pembelian as tanggal, jumlah, harga 
                      FROM detil_pembelian d
                      JOIN pembelian j ON d.pembelian_id = j.id_pembelian
                      JOIN produk p ON d.produk_id = p.id_produk
                      WHERE tanggal_pembelian BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $result = mysqli_query($c, $query);
        } else {
            $query = "SELECT tanggal_pembelian as tanggal, jumlah, harga 
                      FROM detil_pembelian d
                      JOIN pembelian j ON d.pembelian_id = j.id_pembelian
                      JOIN produk p ON d.produk_id = p.id_produk";
            $result = mysqli_query($c, $query);
        }
    }
    if ($pilih_transaksi == "Pengeluaran") {
        if ($tanggal_awal == $_GET["tanggal_awal"] && $tanggal_akhir == $_GET["tanggal_akhir"]) {
            $query = "SELECT tanggal_pengeluaran as tanggal, jumlah, harga
                      FROM pengeluaran 
                      WHERE tanggal_pengeluaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $result = mysqli_query($c, $query);
        } else {
            $query = "SELECT tanggal_pengeluaran as tanggal, jumlah, harga 
                      FROM pengeluaran";
            $result = mysqli_query($c, $query);
        }
    }
    if ($pilih_transaksi == "Pembayaran") {
        if ($tanggal_awal == $_GET["tanggal_awal"] && $tanggal_akhir == $_GET["tanggal_akhir"]) {
            $query = "SELECT tanggal_pembayaran as tanggal, jumlah, harga 
                      FROM detil_pembayaran
                      INNER JOIN pembayaran
                      ON detil_pembayaran.pembayaran_id = pembayaran.id_pembayaran
                      WHERE tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
            $result = mysqli_query($c, $query);
        } else {
            $query = "SELECT tanggal_pembayaran as tanggal, jumlah, harga 
                      FROM detil_pembayaran
                      INNER JOIN pembayaran
                      ON detil_pembayaran.pembayaran_id = pembayaran.id_pembayaran";
            $result = mysqli_query($c, $query);
        }
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
    <title>Toko Jaya Perkasa - Laporan Transaksi</title>
</head>
<body>
<?php
    header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Cetak Laporan Transaksi.xls");
?>
<h2>Laporan Transaksi <?= $pilih_transaksi; ?></h2>
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
</body>
</html>
<?php endif; ?>