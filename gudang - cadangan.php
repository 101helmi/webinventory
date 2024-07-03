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

    $query_produkmasuk = "SELECT SUM(jumlah_produk) FROM produk WHERE tanggal_masuk";
    $result_produkmasuk = mysqli_query($c, $query_produkmasuk);
    $masuk = mysqli_fetch_assoc($result_produkmasuk);

    $query_produkkeluar = "SELECT SUM(jumlah_produk) FROM produk WHERE tanggal_keluar";
    $result_produkkeluar = mysqli_query($c, $query_produkkeluar);
    $keluar = mysqli_fetch_assoc($result_produkkeluar);

    $query_produkkeluar2 = "SELECT SUM(jumlah_produk) FROM produk WHERE tanggal_keluar";
    $result_produkkeluar2 = mysqli_query($c, $query_produkkeluar);
    $keluar2 = mysqli_fetch_assoc($result_produkkeluar);

    $barang_gudang = $masuk["SUM(jumlah_produk)"] - $keluar["SUM(jumlah_produk)"];



    if ($_SESSION["nama"] != "Kepala Gudang" && $_SESSION["nama"] != "Manager") :
?>

<h1>Maaf hanya kepala gudang dan manager yang dapat melihat data produk</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Gudang</title>
</head>
<body>
    <h4>User = <?= $_SESSION["nama"] ?></h4>
    <a href="logout.php">Logout</a>
    <h1>Ini adalah halaman gudang</h1><br><br>
    <?php if ($_SESSION["nama"] == "Kepala Gudang") : ?>
    <a href="stok_barang.php"><button>Stok Barang</button></a>
    <a href="produk_masuk.php"><button>Produk Masuk</button></a>
    <a href="produk_keluar.php"><button>Produk Keluar</button></a>
    <a href="supplier.php"><button>Supplier</button></a>
    <a href="riwayatstok.php"><button>Riwayat Stok</button></a>
    <a href="laporan_gudang.php"><button>Laporan</button></a><br><br>
    <?php endif; ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jenis Produk</th>
            <th>Qty</th>
            <th>Sisa Qty</th>
            <th>Harga Satuan</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Satuan</th>
            <th>Actions</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama_produk"]; ?></td>
            <td><?= $row["jenis_produk"]; ?></td>
            <td><?= $row["jumlah_produk"]; ?></td>
            <td><?= $barang_gudang; ?></td>
            <td><?= "Rp " . number_format($row["harga_produk"]); ?></td>
            <td><?= $row["tanggal_masuk"]; ?></td>
            <td><?= $row["tanggal_keluar"]; ?></td>
            <td><?= $row["satuan"]; ?></td>
            <td>
                <?php
                    if ($row["tanggal_masuk"] != "0000-00-00 00:00:00") {
                ?>
                        <a href="produk_ubah_masuk.php?id_produk=<?= $row["id_produk"]; ?>"><button>Ubah</button></a>
                <?php
                    } else {
                ?>
                        <a href="produk_ubah_keluar.php?id_produk=<?= $row["id_produk"]; ?>"><button>Ubah</button></a>
                <?php
                    }
                ?>
                <a href="produk_hapus.php?id_produk=<?= $row["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini?')"><button>Hapus</button></a>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php endif; ?>
<?php
    
    // echo $keluar;

    echo "Total barang di gudang = " . $barang_gudang . "<br>";
    echo "Total barang yang siap dijual = " . $keluar["SUM(jumlah_produk)"];
?>