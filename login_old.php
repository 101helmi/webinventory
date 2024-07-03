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

    if (isset($_SESSION["nama"])) {
        header("location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Jaya Perkasa - Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        Username : <input type="text" name="username" placeholder="username"><br><br>
        Password : <input type="password" name="password" placeholder="password"><br><br>
        <button type="submit" name="login">Masuk</button><br><br>
    </form>
</body>
</html>
<?php
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM admin WHERE username = '$username'";

        $result = mysqli_query($c, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                echo "Login berhasil <br>";
                // echo "Selamat Datang, " . $row["nama"];
                $_SESSION["nama"] = $row["nama"];
                header("location: index.php");
                exit;
            } else {
                echo "Password salah";
                echo "<br>";
                echo mysqli_error($c);
            }
        } else {
            echo "username / password salah";
            echo mysqli_error($c);
        }
    }
?>