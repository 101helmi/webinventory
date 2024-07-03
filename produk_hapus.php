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
    $id_riwayatstok = $_GET["id_riwayatstok"];

    $query1 = "DELETE FROM produk WHERE id_produk = $id_produk";
    mysqli_query($c, $query1);

    if ($id_riwayatstok != "") {
        $query2 = "DELETE FROM riwayatstok WHERE id_riwayatstok = $id_riwayatstok";
        mysqli_query($c, $query2);
    }
    
    mysqli_affected_rows($c);

    if (mysqli_affected_rows($c) > 0) {
        echo "
            <script>
                document.location.href = 'gudang.php';
                alert('Data berhasil dihapus');              
            </script>
        ";
    } else {
        echo "Error.";
        echo "<br>";
        echo mysqli_error($c);
    }
?>