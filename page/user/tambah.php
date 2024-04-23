<?php 

include "../../db.php";

session_start();

if (!isset($_SESSION['users'])) {
    echo "<script>alert('Mohon login terlebih dahulu !')
    location.replace('../../login.php')</script>";
}

$sesi = $_SESSION['users'];
$id = $sesi['id_user'];
$select = $conn->query("SELECT * FROM users WHERE id_user = '$id'")->fetch_assoc();

if (isset($_POST['simpan_adm'])) {
    $name = $_POST['name'];
    $user = $_POST['username'];
    $pass = $_POST['password'];



    if ($name == NULL and $user == NULL and $pass == NULL) {
        echo "<script>alert('Mohon isi data dengan lengkap'),
        location.replace('tambah.php')";
    } else {
        $save = $conn->query("INSERT INTO users VALUES (NULL,'$name','$user','$pass')");

        if ($save) {
            echo "<script>
            alert('Data berhasil disimpan'),
            location.replace('index.php')
            </script>";
        } else {
            echo "error data or code";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pos App Rubyz</title>
    <link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row py-5" >
            <ul class="nav justify-content-center bg-warning border-bottom border-body">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../product/index.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../orders/index.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">Logout</a>
            </li>
            </ul>
        </div>
        <div class="container-fluid">
                    <div class="row mb-3 justify-content-center">
                        <div class="col-lg-8">
                            <div class="card border-0 shadow rounded-2">
                                <div class="card-header">
                                    <h3 class="text-center pt-2">Tambah Data Admin</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">

                                        <label class="form-label" for="name">Nama</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="name...."><br>
                                        <label class="form-label" for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" placeholder="username..."><br>
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control" type="pasword" name="password" id="password" placeholder="password..."><br>
                                        
                                        <button class="btn btn-primary mx-auto d-block" name="simpan_adm" type="submit">Simpan Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="back">
                    <a href="index.php" class="btn btn-primary mt-5">kembali</a>
                </div>
            </div>
        </div>
    </div>
    
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>