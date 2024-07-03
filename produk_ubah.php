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

    $id_produk = $_GET["id_produk"];

    $query = "SELECT * FROM produk WHERE id_produk = $id_produk";
    $result = mysqli_query($c, $query);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function tanggalMasuk() {
            document.getElementsById("tanggal_masuk").disabled = true;
        }

        function tanggalKeluar() {
            document.getElementsByName("tanggal_keluar").disabled = true;
        }
    </script>
</head>
<body>
    <h1>Ubah Produk</h1>
    <form action="" method="post">
        Nama produk : <input type="text" name="nama_produk" value="<?= $row["nama_produk"]; ?>" required><br><br>
        Jenis produk : 
        <select name="jenis_produk">
            <option value="semen">Semen</option>
            <option value="batu">Batu</option>
            <option value="kayu">Kayu</option>
            <option value="cat">Cat</option>
            <option value="keramik">Keramik</option>
        </select><br><br>
        Jumlah : <input type="text" name="jumlah_produk" value="<?= $row["jumlah_produk"]; ?>" required><br><br>
        Harga : <input type="text" name="harga_produk" value="<?= $row["harga_produk"]; ?>" required><br><br>
        Tanggal Masuk : <input type="datetime-local" name="tanggal_masuk" id="tanggal_masuk" value="<?= $row["tanggal_masuk"]; ?>"><br><br>
        Tanggal Keluar : <input type="datetime-local" name="tanggal_keluar" value="<?= $row["tanggal_keluar"]; ?>"><br><br>
        Satuan : <input type="text" name="satuan" value="<?= $row["satuan"]; ?>" required><br><br>
        <button type="submit" name="ubahproduk">Ubah</button>       
    </form><br>
    <a href="gudang.php"><button>Kembali</button></a><br><br>
</body>
</html>
<script type="text/javascript">
    document.getElementsById("tanggal_masuk").disabled = true;
</script>
<?php
    if (isset($_POST["ubahproduk"])) {
        $nama_produk = $_POST["nama_produk"];
        $jenis_produk = $_POST["jenis_produk"];
        $jumlah_produk = $_POST["jumlah_produk"];
        $harga_produk = $_POST["harga_produk"];
        $tanggal_masuk = $_POST["tanggal_masuk"];
        $tanggal_keluar = $_POST["tanggal_keluar"];
        $satuan = $_POST["satuan"];

        $query = "UPDATE produk SET nama_produk = '$nama_produk',
                                    jenis_produk = '$jenis_produk',
                                    jumlah_produk = '$jumlah_produk',
                                    harga_produk = '$harga_produk',
                                    tanggal_masuk = '$tanggal_masuk',
                                    tanggal_keluar = '$tanggal_keluar',
                                    satuan = '$satuan'
                                WHERE id_produk = $id_produk";

        mysqli_query($c, $query);
        mysqli_affected_rows($c);

        if (mysqli_affected_rows($c) > 0) {
            echo "Produk berhasil diubah";
        } else {
            echo "Error.";
            echo "<br>";
            echo mysqli_error($c);
        }
    }
?>
