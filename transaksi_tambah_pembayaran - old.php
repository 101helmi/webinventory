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
    <title>Toko Jaya Perkasa - Tambah Transaksi Pembayaran</title>
</head>
<body>
    <h1>Tambah Transaksi Pembayaran</h1>
    <form action="" method="post">
        Nama pembayaran : <input type="text" name="nama_pembayaran"><br><br>
        Tanggal Pembayaran : <input type="datetime-local" name="tanggal_pembayaran"><br><br>
        Jumlah : <input type="text" name="jumlah"><br><br>
        Harga Satuan : <input type="text" name="harga"><br><br>
        <button type="submit" name="tambahtransaksi">Tambah</button>       
    </form><br>
    <a href="transaksi_pembayaran.php"><button>Kembali</button></a><br><br>
</body>
</html>
<?php
    endif;

    $query = "SELECT * FROM detil_pembayaran ORDER BY id_detilpembayaran DESC";
    $result = mysqli_query($c, $query);
    $row = mysqli_fetch_assoc($result);

    // var_dump($row);

    if (isset($_POST["tambahtransaksi"])) {
        if (!$row) { // jika tabel kosong
            // echo "data tidak ada";
            $idpembayaran = 0 + 1;
            $nama_pembayaran = $_POST["nama_pembayaran"];
            $tanggal_pembayaran = $_POST["tanggal_pembayaran"];
            $jumlah = $_POST["jumlah"];
            $harga = $_POST["harga"];

            $query1 = "INSERT INTO pembayaran VALUES ('','$nama_pembayaran','$tanggal_pembayaran','test');";
                    
            $query2 = "INSERT INTO detil_pembayaran VALUES ('','$jumlah','$harga','$idpembayaran')";

            mysqli_query($c, $query1);
            mysqli_query($c, $query2);
            mysqli_affected_rows($c);

            if (mysqli_affected_rows($c) > 0) {
                // echo "<br>";
                echo "Transaksi pembayaran berhasil ditambahkan";
            } else {
                echo "Error.";
                echo "<br>";
                echo mysqli_error($c);
            }
        } else {
            $idpembayaran = $row["pembayaran_idpembayaran"] + 1;
            $nama_pembayaran = $_POST["nama_pembayaran"];
            $tanggal_pembayaran = $_POST["tanggal_pembayaran"];
            $jumlah = $_POST["jumlah"];
            $harga = $_POST["harga"];

            $query1 = "INSERT INTO pembayaran VALUES ('','$nama_pembayaran','$tanggal_pembayaran','test');";
                    
            $query2 = "INSERT INTO detil_pembayaran VALUES ('','$jumlah','$harga','$idpembayaran')";

            mysqli_query($c, $query1);
            mysqli_query($c, $query2);
            mysqli_affected_rows($c);

            if (mysqli_affected_rows($c) > 0) {
                echo "Transaksi pembayaran berhasil ditambahkan";
            } else {
                echo "Error.";
                echo "<br>";
                echo mysqli_error($c);
            }
        }

        // $idpembayaran = $row["pembayaran_idpembayaran"] + 1;
        // $nama_pembayaran = $_POST["nama_pembayaran"];
        // $tanggal_pembayaran = $_POST["tanggal_pembayaran"];
        // $jumlah = $_POST["jumlah"];
        // $harga = $_POST["harga"];

        // $query1 = "INSERT INTO pembayaran VALUES ('','$nama_pembayaran','$tanggal_pembayaran','test');";
                
        // $query2 = "INSERT INTO detil_pembayaran VALUES ('','$jumlah','$harga','$idpembayaran')";

        // mysqli_query($c, $query1);
        // mysqli_query($c, $query2);
        // mysqli_affected_rows($c);

        // if (mysqli_affected_rows($c) > 0) {
        //     echo "Transaksi pembayaran berhasil ditambahkan";
        // } else {
        //     echo "Error.";
        //     echo "<br>";
        //     echo mysqli_error($c);
        // }

        // if (isset($row["id_detilpembayaran"])) {
        //     $i = 0;
        //     echo $i;
        // } else {
        //     echo $row["id_detilpembayaran"];
        // }

        // echo $i;

        // if (mysqli_fetch_assoc($result) == "NULL") {
        //     echo "data kosong";
        // } else {
        //     echo "ada isinya";
        //     // echo $row["id_detilpembayaran"];
        // }

        

        // $i = 0;
        // $i++;
        // $nama_pembayaran = $_POST["nama_pembayaran"];
        // $tanggal_pembayaran = $_POST["tanggal_pembayaran"];
        // $jumlah = $_POST["jumlah"];
        // $harga = $_POST["harga"];

        // // $query = "INSERT INTO pembayaran VALUES ('','$nama_pembayaran','$tanggal_pembayaran','test');
                  
        // //           INSERT INTO detil_pembayaran VALUES ('','$jumlah','$harga','$i')";

        // $query1 = "INSERT INTO pembayaran VALUES ('','$nama_pembayaran','$tanggal_pembayaran','test');";
                  
        // $query2 = "INSERT INTO detil_pembayaran VALUES ('','$jumlah','$harga','1')";

        // // var_dump($query);

        // mysqli_query($c, $query1);
        // mysqli_query($c, $query2);
        // mysqli_affected_rows($c);

        // if (mysqli_affected_rows($c) > 0) {
        //     echo "Transaksi pembayaran berhasil ditambahkan";
        // } else {
        //     echo "Error.";
        //     echo "<br>";
        //     echo mysqli_error($c);
        // }
    }
?>
