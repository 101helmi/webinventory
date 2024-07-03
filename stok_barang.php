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

    // $query_masuk = "SELECT jumlah_produk FROM produk WHERE tanggal_masuk AND nama_produk = 'Gresik'";
    // $res_masuk = mysqli_query($c, $query_masuk);
    // $row_masuk = mysqli_fetch_assoc($res_masuk);

    // $query_keluar = "SELECT jumlah_produk FROM produk WHERE tanggal_keluar AND nama_produk = 'Gresik'";
    // $res_keluar = mysqli_query($c, $query_keluar);
    // $row_keluar = mysqli_fetch_assoc($res_keluar);

    // $total = $row_masuk["jumlah_produk"] - $row_keluar["jumlah_produk"];
    // echo $total;
    // echo "<br>";

    // var_dump($row_keluar["jumlah_produk"]);

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
    <h1>Ini adalah halaman gudang</h1><br>
    <?php if ($_SESSION["nama"] == "Kepala Gudang") : ?>
    <a href="gudang.php"><button>Kembali</button></a><br><br>
    <?php endif; ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Jenis Produk</th>
            <th>Qty</th>
            <th>Qty Sisa</th>
        </tr>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <?php
            $id_produk = $_SESSION["id_produk"];
            var_dump($id_produk);

            $query_keluar = "SELECT jumlah_produk FROM produk WHERE tanggal_keluar AND id_produk = $id_produk";
            $res_keluar = mysqli_query($c, $query_keluar);
            $row_keluar = mysqli_fetch_assoc($res_keluar);
        ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["id_produk"]; ?></td>
            <td><?= $row["nama_produk"]; ?></td>
            <td><?= $row["jenis_produk"]; ?></td>
            <td><?= $row["jumlah_produk"]; ?></td>
            <td><?= $row["jumlah_produk"] - $row_keluar["jumlah_produk"]; ?></td>
        </tr>
        <?php $i++ ?>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php endif; ?>