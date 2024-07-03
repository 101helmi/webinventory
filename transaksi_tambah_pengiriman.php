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

    if ($_SESSION["nama"] != "Admin") :
?>

<h1>Maaf hanya admin yang bisa menambah data produk</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Tambah Transaksi Pengeluaran</title>
</head>
<body>
    <h1>Tambah Transaksi Pembayaran</h1>
    <form action="" method="post">
        Daftar produk : <input type="text" name="jumlah" required><br><br>
        Nama pembayaran : <input type="text" name="jumlah" required><br><br>
        Tanggal Pengeluaran : <input type="datetime-local" name="tanggal_pembayaran" required><br><br>
        Nota pembayaran : <input type="text" name="harga" required><br><br>
        
        <button type="submit" name="tambahtransaksi">Tambah</button>       
    </form><br>
    <a href="transaksi_pembayaran.php"><button>Kembali</button></a><br><br>
</body>
</html>
<?php
    endif;

    if (isset($_POST["tambahtransaksi"])) {
        $tanggal_pengeluaran = $_POST["tanggal_pengeluaran"];
        $detail_pengeluaran = $_POST["detail_pengeluaran"];
        $jumlah = $_POST["jumlah"];
        $harga = $_POST["harga"];

        $query = "INSERT INTO pengeluaran VALUES ('', '$tanggal_pengeluaran', '$detail_pengeluaran', '$jumlah', '$harga', '1')";

        mysqli_query($c, $query);
        mysqli_affected_rows($c);

        if (mysqli_affected_rows($c) > 0) {
            echo "Transaksi pengeluaran berhasil ditambahkan";
        } else {
            echo "Error.";
            echo "<br>";
            echo mysqli_error($c);
        }
    }
?>
