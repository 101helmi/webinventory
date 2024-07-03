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

    $query = "SELECT * FROM produk";

    $result = mysqli_query($c, $query);
    if ($_SESSION["nama"] != "Admin" && $_SESSION["nama"] != "Manager") :
?>

<h1>Maaf hanya admin dan manager yang dapat melihat data transaksi</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Transaksi</title>
</head>
<body>
    <h4>User = <?= $_SESSION["nama"] ?></h4>
    <a href="logout.php">Logout</a>
    <h1>Ini adalah halaman transaksi</h1><br><br>
    <?php if ($_SESSION["nama"] == "Admin" || $_SESSION["nama"] == "Manager") : ?>
    <!-- <a href="transaksi_tambah.php"><button>Tambah Transaksi</button></a> -->
    <a href="transaksi_pengeluaran.php"><button>Pengeluaran</button></a>
    <a href="transaksi_pembayaran.php"><button>Pembayaran</button></a>
    <a href="pengiriman.php"><button>Pengiriman</button></a>
    <a href="transaksi_penjualan.php"><button>Penjualan</button></a>
    <a href="transaksi_pembelian.php"><button>Pembelian</button></a><br><br>
    <?php endif; ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Produk</th>
            <th>Jenis Produk</th>
            <th>Qty</th>
            <th>Jenis transaksi</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th>Actions</th>
        </tr>
        <?php $i = 1; ?>
    </table>
</body>
</html>
<?php endif; ?>