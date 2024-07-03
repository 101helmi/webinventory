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

    $id_penjualan = $_GET["id_penjualan"];
    $no_nota_penjualan = $_GET["no_nota_penjualan"];
    $jumlah = $_GET["jumlah"];
    $nama_produk = $_GET["nama_produk"];

    $query1 = "DELETE FROM detil_penjualan WHERE no_nota_penjualan = $no_nota_penjualan";
    $query2 = "DELETE FROM penjualan WHERE id_penjualan = $id_penjualan";
    $query3 = "UPDATE produk SET jumlah_produk = jumlah_produk + $jumlah WHERE nama_produk = '$nama_produk' AND tanggal_keluar";
    
    mysqli_query($c, $query1);
    mysqli_query($c, $query2);
    mysqli_query($c, $query3);
    mysqli_affected_rows($c);

    if (mysqli_affected_rows($c) > 0) {
        echo "
            <script>
                document.location.href = 'transaksi_penjualan.php';
                alert('Data berhasil dihapus');              
            </script>
        ";
    } else {
        echo "Error.";
        echo "<br>";
        echo mysqli_error($c);
    }
?>