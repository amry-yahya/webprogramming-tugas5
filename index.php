<?php
include 'conndb.php';
error_reporting(0);
session_start();

if (isset($_COOKIE['cookie_username'])) {
    $_SESSION['username']=$_COOKIE['cookie_username'];
}

if (isset($_SESSION['username'])) {
    echo "<script>alert('Login Berhasil!')</script>";
    echo "<script>setTimeout(\"location.href = 'socialapp.php';\",0);</script>";
}

if (isset($_POST['submit'])) {
    $cookiesign = $_POST['cookiesign'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM tabelakun WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        echo "<script>alert('Login Berhasil!')</script>";
        echo "<script>setTimeout(\"location.href = 'socialapp.php';\",0);</script>";
        if ($cookiesign == 1) {
            $cookie_name = "cookie_username";
            $cookie_value = $username;
            $cookie_time = time() + (3600 * 24 * 30);
            setcookie($cookie_name, $cookie_value, $cookie_time, "/");

            $cookie_name = "cookie_password";
            $cookie_value = md5($password);
            $cookie_time = time() + (3600 * 24 * 30);
            setcookie($cookie_name, $cookie_value, $cookie_time, "/");
        }
    } else {
        echo "<script>alert('Username atau Password Anda salah. Silahkan coba lagi!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">
    <div class="container konten card btn">
        <h1 class="text-center card bg-success text-white atas">FriendsApp</h1>
        <div class="row">
            <div class="col">
                <div class="card bg-light">
                    <div class="card-header bg-primary text-white">
                        Halaman Login
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div>
                                <input id="username" type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <br>
                            <div>
                                <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div>
                                <br>
                                <label>
                                    <input id="login-remember" type="checkbox" name="cookiesign" value="1"> Ingat saya
                                </label>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success tombol" name="submit">Login</button>
                            </div>
                            <br>
                            <p>Belum punya akun? <a href="registrasi.php">Registrasi</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>