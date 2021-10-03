<?php
include 'conndb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FriendsApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">
    <div class="container konten card btn">
        <h1 class="text-center card bg-success text-white atas">FriendsApp</h1>

        <div class="col">
            <div class="card bg-light">
                <div class="card-header bg-primary text-white">
                    Daftar User FriendsApp
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>No</th>
                            <th>username</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $tampil = mysqli_query($conn, "SELECT * from tabelakun order by id asc");
                            while ($data = mysqli_fetch_array($tampil)) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $data['username'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <div class="card-body">
                        <a href="logout.php" class="tombol btn btn-danger" onclick="return confirm('Anda yakin ingin keluar?')">Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>