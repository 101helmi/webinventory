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

    $tanggal_awal = $_GET["tanggal_awal"];
    $tanggal_akhir = $_GET["tanggal_akhir"];

    if ($tanggal_awal == $_GET["tanggal_awal"] && $tanggal_akhir == $_GET["tanggal_akhir"]) {
        // $tanggal_awal = $_GET["tanggal_awal"];
        // $tanggal_akhir = $_GET["tanggal_akhir"];

        $query = "SELECT * FROM produk 
                  WHERE tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                  OR tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";

        $result = mysqli_query($c, $query);
    } else {
        $query = "SELECT * FROM produk";

        $result = mysqli_query($c, $query);
    }

    if ($_SESSION["nama"] != "Kepala Gudang" && $_SESSION["nama"] != "Manager") :
?>

<h1>Maaf hanya kepala gudang dan manager yang dapat melihat data produk</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Laporan Gudang</title>
</head>
<body>
<?php
    header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Cetak Laporan Gudang.xls");
?>
<h2>Laporan Transaksi Gudang</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="background-color: white;">
        <tr  style="background-color: #C6C5C5;">
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jenis Produk</th>
            <th>Qty</th>
            <th>Harga Satuan</th>
            <th>Masuk Produk</th>
            <th>Keluar Produk</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $i; ?></td>
            
            <td><?= $row["nama_produk"]; ?></td>
            <td><?= $row["jenis_produk"]; ?></td>
            <td><?= $row["jumlah_produk"]; ?></td>
            <td><?= "Rp " . number_format($row["harga_produk"], 2, ",", "."); ?></td>
            <td><?= $row["tanggal_masuk"]; ?></td>
            <td><?= $row["tanggal_keluar"]; ?></td>
        </tr>
        <?php $i++ ?>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php endif; ?>