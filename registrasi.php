<?php

include 'conndb.php';
error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: registrasi.php");
}

function passwordstrength(string $password): bool
{
    $number    = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $panjang = strlen($password);
    if ($panjang < 8) {
        echo "<script>alert('Password Anda Kurang Panjang!')</script>";
        return false;
    } else if (!$number) {
        echo "<script>alert('Password Anda Tidak Mengandung Angka!')</script>";
        return false;
    } else if (!$uppercase) {
        echo "<script>alert('Password Anda Tidak Mengandung Huruf Kapital!')</script>";
        return false;
    } else if (!$lowercase) {
        echo "<script>alert('Password Anda Tidak Mengandung Huruf Kecil!')</script>";
        return false;
    } else if (!$specialChars) {
        echo "<script>alert('Password Anda Tidak Mengandung Spesial Karakter!')</script>";
        return false;
    } else return true;
}

function usernamevalid(string $username)
{
    if (!preg_match('/[^A-Za-z0-9_.]/', $username) && strlen($username) > 5) return true;
    else echo "<script>alert('Username yang Anda Masukkan Tidak Valid!')</script>";
}

$username = $_POST['username'];
$password = md5($_POST['password']);

if (isset($_POST['submit'])) {
    $konfirmasi = md5($_POST['konfirmasi']);
    if ($password == $konfirmasi) {
        $sql = "SELECT * FROM tabelakun WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            if (usernamevalid($username) && passwordstrength($_POST['password'])) {
                $sql = "INSERT INTO tabelakun (username, password)
                    VALUES ('$username', '$password')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $username = "";
                    $username = "";
                    $_POST['password'] = "";
                    $_POST['konfirmasi'] = "";
                    echo "<script>alert('Akun Telah Berhasil Dibuat!')</script>";
                    echo "<script>setTimeout(\"location.href = 'index.php';\",0);</script>";
                } else {
                    echo "<script>alert('Terjadi Kesalahan!')</script>";
                }
            }
        } else {
            echo "<script>alert('Username Telah Dipakai!')</script>";
        }
    } else {
        echo "<script>alert('Konfirmasi Password Anda Tidak Sesuai!')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
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
                        Halaman Registrasi
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <input id="username" type="text" name="username" value="<?= @$username ?>" placeholder="Username" class="form-control" required>
                                <p style="font-size: x-small; text-align:left;">panjang username tidak boleh kurang dari 6 karakter <br>
                                    username hanya boleh mengandung huruf kapital, huruf kecil, angka, underscore ( _ ) dan titik ( . )
                                </p>
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
                                <p style="font-size: x-small; text-align:left;">panjang password tidak boleh kurang dari 8 karakter <br>
                                    password harus mengandung setidaknya 1 angka, 1 huruf kapital, 1 huruf kecil, dan 1 karakter spesial (!,@,#,$, dsb)
                                </p>
                            </div>
                            <div class="form-group">
                                <input id="konfirmasi" type="password" name="konfirmasi" placeholder="Konfirmasi Password" class="form-control" required>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success tombol" name="submit">Register</button>
                            </div>
                            <br>
                            <p>Sudah punya akun? <a href="index.php">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>