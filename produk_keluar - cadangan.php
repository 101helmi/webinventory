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

    $query = "SELECT * FROM produk WHERE tanggal_masuk";

    $result = mysqli_query($c, $query);

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
</head>
<body>
    <h1>Tambah Produk Keluar</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jenis Produk</th>
            <th>Qty</th>
            <th>Jumlah Keluar</th>
        </tr>
        <?php $i = 1; ?>
        <?php $j = 0; ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <?php $_SESSION["nama_produk"] = $row["nama_produk"]; ?>
        <tr>
            <td><?= $i; ?></td>
            
            <td><?= $row["nama_produk"]; ?></td>
            <td><?= $row["jenis_produk"]; ?></td>
            <td><?= $row["jumlah_produk"]; ?></td>
            <td>
                <form action="" method="post">
                    <input type="submit" name="tambah" value="+">
                    <?= $j; ?>
                    <input type="submit" name="kurang" value="-">
                </form>
                <?php
                    if (isset($_POST["tambah"])) {
                        $j++;
                    }
                    if (isset($_POST["kurang"])) {
                        $j--;
                    }
                ?>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endwhile; ?>
    </table>
    <br><br>
    <form action="" method="post">
        Nama produk : <input type="text" name="nama_produk" required><br><br>
        Jenis produk : <input type="text" name="jenis_produk" required><br><br>
        Jumlah : <input type="text" name="jumlah_produk" required><br><br>
        Harga satuan : <input type="text" name="harga_produk" required><br><br>
        Tanggal Keluar Produk : <input type="datetime-local" name="tanggal_keluar" required><br><br>
        Satuan : <input type="text" name="satuan" required><br><br>
        <button type="submit" name="tambahproduk">Tambah</button>       
    </form><br>
    <a href="gudang.php"><button>Kembali</button></a><br><br>
</body>
</html>
<?php
    endif;

    if (isset($_POST["tambahproduk"])) {
        $nama_produk = $_POST["nama_produk"];
        $jenis_produk = $_POST["jenis_produk"];
        $jumlah_produk = $_POST["jumlah_produk"];
        $harga_produk = $_POST["harga_produk"];
        $tanggal_keluar = $_POST["tanggal_keluar"];
        $satuan = $_POST["satuan"];

        $query = "INSERT INTO produk VALUES ('', '$nama_produk', '$jenis_produk', '$jumlah_produk', '$harga_produk', '', '$tanggal_keluar', '$satuan', '1')";

        mysqli_query($c, $query);
        mysqli_affected_rows($c);

        if (mysqli_affected_rows($c) > 0) {
            echo "Produk berhasil dikeluarkan dan siap dijual.";
        } else {
            echo "Error.";
            echo "<br>";
            echo mysqli_error($c);
        }
    }
?>
