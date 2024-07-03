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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="css/login.css"> -->
</head>
<body>
    <div class="container-fluid" style="background-color: #8B4513; padding-top: 1px; padding-bottom: 205px;">
        <div class="card" style="width: 18rem; margin-left: 520px; margin-top: 120px;">
            <div class="card-body">
            <h1 style="text-align: center;">Login</h1>
            <form action="" method="post" style="margin-left: 30px; margin-top: 25px;">
                Username : <input type="text" name="username" placeholder="username" required><br><br>
                Password : <input type="password" name="password" placeholder="password" required><br><br>
                <button type="submit" name="login">Masuk</button><br><br>
            </form>
            <?php
                if (isset($_POST["login"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    if ($username == "kepalagudang") {
                        $query = "SELECT * FROM kepala_gudang WHERE username = '$username'";

                        $result = mysqli_query($c, $query);
                
                        if (mysqli_num_rows($result) === 1) {
                            $row = mysqli_fetch_assoc($result);
                            if (password_verify($password, $row["password"])) {
                                echo "Login berhasil <br>";
                                $_SESSION["nama"] = $row["nama"];
                                header("location: index.php");
                                exit;
                            } else {
                                echo "<b style='color: red;'>Password salah.</b>";
                                echo "<br>";
                                echo mysqli_error($c);
                            }
                        } else {
                            echo "<b style='color: red;'>username / password salah</b>";
                            echo mysqli_error($c);
                        }
                    }

                    else if ($username == "manager") {
                        $query = "SELECT * FROM manager WHERE username = '$username'";

                        $result = mysqli_query($c, $query);
                
                        if (mysqli_num_rows($result) === 1) {
                            $row = mysqli_fetch_assoc($result);
                            if (password_verify($password, $row["password"])) {
                                echo "Login berhasil <br>";
                                $_SESSION["nama"] = $row["nama"];
                                header("location: index.php");
                                exit;
                            } else {
                                echo "<b style='color: red;'>Password salah.</b>";
                                echo "<br>";
                                echo mysqli_error($c);
                            }
                        } else {
                            echo "<b style='color: red;'>username / password salah</b>";
                            echo mysqli_error($c);
                        }
                    }

                    else if ($username == "admin") {
                        $query = "SELECT * FROM admin WHERE username = '$username'";

                        $result = mysqli_query($c, $query);
                
                        if (mysqli_num_rows($result) === 1) {
                            $row = mysqli_fetch_assoc($result);
                            if (password_verify($password, $row["password"])) {
                                echo "Login berhasil <br>";
                                $_SESSION["nama"] = $row["nama"];
                                header("location: index.php");
                                exit;
                            } else {
                                echo "<b style='color: red;'>Password salah.</b>";
                                echo "<br>";
                                echo mysqli_error($c);
                            }
                        } else {
                            echo "<b style='color: red;'>username / password salah</b>";
                            echo mysqli_error($c);
                        }
                    } else {
                        echo "<b style='color: red;'>Username salah.</b>";
                        echo "<br>";
                        echo mysqli_error($c);
                    }
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>