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

    $id_pembayaran = $_GET["id_pembayaran"];
    $no_nota_pembayaran = $_GET["no_nota_pembayaran"];

    $query1 = "DELETE FROM detil_pembayaran WHERE no_nota_pembayaran = $no_nota_pembayaran";
    $query2 = "DELETE FROM pembayaran WHERE id_pembayaran = $id_pembayaran";
    
    mysqli_query($c, $query1);
    mysqli_query($c, $query2);
    mysqli_affected_rows($c);

    if (mysqli_affected_rows($c) > 0) {
        echo "
            <script>
                document.location.href = 'transaksi_pembayaran.php';
                alert('Data berhasil dihapus');              
            </script>
        ";
    } else {
        echo "Error.";
        echo "<br>";
        echo mysqli_error($c);
    }
?>