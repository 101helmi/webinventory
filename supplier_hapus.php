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

    $id_supplier = $_GET["id_supplier"];

    $query = "DELETE FROM supplier WHERE id_supplier = $id_supplier";
    mysqli_query($c, $query);
    mysqli_affected_rows($c);

    if (mysqli_affected_rows($c) > 0) {
        echo "
            <script>
                document.location.href = 'supplier.php';
                alert('Data berhasil dihapus');              
            </script>
        ";
    } else {
        echo "Error.";
        echo "<br>";
        echo mysqli_error($c);
    }
?>