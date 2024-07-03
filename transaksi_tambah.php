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

<h1>Maaf hanya admin yang bisa menambah data transaksi</h1>

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah Transaksi</h1>
    <form action="" method="post">        
        Jenis transaksi : 
        <select name="jenis_transaksi">
            <option value="pembelian">Semen</option>
            <option value="penjualan">Batu</option>
            <option value="pengeluaran">Kayu</option>
        </select><br><br>
        Nama produk : <input type="text" name="nama_produk" required><br><br>
        Jenis produk : 
        <select name="jenis_produk">
            <option value="semen">Semen</option>
            <option value="batu">Batu</option>
            <option value="kayu">Kayu</option>
            <option value="cat">Cat</option>
            <option value="keramik">Keramik</option>
        </select><br><br>
        Jumlah : <input type="text" name="jumlah_produk" required><br><br>
        Harga Satuan : <input type="text" name="harga_produk" required><br><br>
        <button type="submit" name="tambahtransaksi">Tambah</button>       
    </form><br>
    <a href="gudang.php"><button>Kembali</button></a><br><br>
</body>
</html>
<?php
    endif;

    if (isset($_POST["tambahtransaksi"])) {
        $nama_produk = $_POST["nama_produk"];
        $jenis_produk = $_POST["jenis_produk"];
        $jumlah_produk = $_POST["jumlah_produk"];
        $harga_produk = $_POST["harga_produk"];
        $tanggal_masuk = $_POST["tanggal_masuk"];
        $satuan = $_POST["satuan"];

        $query = "INSERT INTO produk VALUES ('', '$nama_produk', '$jenis_produk', '$jumlah_produk', '$harga_produk', '$tanggal_masuk', '$satuan')";

        mysqli_query($c, $query);
        mysqli_affected_rows($c);

        if (mysqli_affected_rows($c) > 0) {
            echo "Produk berhasil ditambahkan";
        } else {
            echo "Error.";
            echo "<br>";
            mysqli_error($c);
        }

        if ($_POST["jenis_transaksi"] == "pembelian") {
            // echo "Transaksi pembelian";
            
        }
        if ($_POST["jenis_transaksi"] == "penjualan") {
            // echo "Transaksi penjualan";
            
        }
        if ($_POST["jenis_transaksi"] == "pengeluaran") {
            // echo "Transaksi pengeluaran";
            $nama_produk = $_POST["nama_produk"];
            $jenis_produk = $_POST["jenis_produk"];
            $jumlah_produk = $_POST["jumlah_produk"];
            $harga_produk = $_POST["harga_produk"];
            $tanggal_masuk = $_POST["tanggal_masuk"];
            $satuan = $_POST["satuan"];

            $query = "INSERT INTO produk VALUES ('', '$nama_produk', '$jenis_produk', '$jumlah_produk', '$harga_produk', '$tanggal_masuk', '$satuan')";

            mysqli_query($c, $query);
            mysqli_affected_rows($c);

            if (mysqli_affected_rows($c) > 0) {
                echo "Produk berhasil ditambahkan";
            } else {
                echo "Error.";
                echo "<br>";
                mysqli_error($c);
            }
        }
    }
?>
