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

    $id_pembelian = $_GET["id_pembelian"];
    $no_nota_pembelian = $_GET["no_nota_pembelian"];
    $jumlah = $_GET["jumlah"];
    $nama_produk = $_GET["nama_produk"];

    $query1 = "DELETE FROM detil_pembelian WHERE no_nota_pembelian = $no_nota_pembelian";
    $query2 = "DELETE FROM pembelian WHERE id_pembelian = $id_pembelian";
    $query3 = "UPDATE produk SET jumlah_produk = jumlah_produk - $jumlah WHERE nama_produk = '$nama_produk' AND tanggal_masuk";
    
    mysqli_query($c, $query1);
    mysqli_query($c, $query2);
    mysqli_query($c, $query3);
    mysqli_affected_rows($c);

    if (mysqli_affected_rows($c) > 0) {
        echo "
            <script>
                document.location.href = 'transaksi_pembelian.php';
                alert('Data berhasil dihapus');              
            </script>
        ";
    } else {
        echo "Error.";
        echo "<br>";
        echo mysqli_error($c);
    }
?>