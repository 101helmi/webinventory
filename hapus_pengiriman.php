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

    $id_pengiriman = $_GET["id_pengiriman"];

    $query = "DELETE FROM pengiriman WHERE id_pengiriman = $id_pengiriman";

    mysqli_query($c, $query);
    mysqli_affected_rows($c);

    if (mysqli_affected_rows($c) > 0) {
        echo "
            <script>
                document.location.href = 'pengiriman.php';
                alert('Data berhasil dihapus');              
            </script>
        ";
    } else {
        echo "Error.";
        echo "<br>";
        echo mysqli_error($c);
    }
?>