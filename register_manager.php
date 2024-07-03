<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kp_jayaperkasa";

    $c = new mysqli($servername, $username, $password, $dbname);
    if ($c->connect_errno) {
        echo $c->connect_errno;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Registrasi (Manager)</title>
</head>
<body>
    <h1>Registrasi Manager</h1>
    <form action="" method="post">
        Nama : <input type="text" name="nama" placeholder="nama"><br><br>
        Email : <input type="text" name="email" placeholder="email"><br><br>
        Username : <input type="text" name="username" placeholder="nama pengguna"><br><br>
        Password : <input type="password" name="password" placeholder="password"><br><br>
        No hp : <input type="text" name="no_hp" placeholder="no hp" maxlength="14"><br><br>
        <button type="submit" name="submit">Daftar</button>
    </form>
    <p>Punya akun? <a href="login.php">Login</a></p>
</body>
</html>
<?php
    // $sql = "INSERT INTO admin VALUES();";
    if (isset($_POST["submit"])) {
        // echo "Test";
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $no_hp = $_POST["no_hp"];

        $query = "INSERT INTO manager VALUES ('', '$nama', '$email', '$username', '$password_hash', '$no_hp', '1', '1')";
        mysqli_query($c, $query);
        mysqli_affected_rows($c);
        
        if (mysqli_affected_rows($c) > 0) {
            echo "Registrasi akun berhasil";
        } else {
            echo "Registrasi akun gagal";
            echo "<br>";
            echo mysqli_error($c);
        }
    }
?>