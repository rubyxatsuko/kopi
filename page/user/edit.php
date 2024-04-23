<?php

session_start();
                            
include '../../db.php';


$id = $_GET['id'];


$query = mysqli_query($conn,"SELECT * FROM users WHERE id_user = '$id'");

if(mysqli_num_rows($query) > 0) {
   $row       = mysqli_fetch_assoc($query);

}
                            if (isset($_POST['edit'])) {
                                $name         = htmlspecialchars($_POST['name']);
                                $user       = htmlspecialchars($_POST['username']);
                                $pass        = htmlspecialchars($_POST['password']);

                                
                                if ($name == '' || $user == '' || $pass == '' ) {
                            ?>

                                    <div class="alert alert-primary" role="alert">
                                        username dan password wajib di isi dengan benar!
                                    </div>
                                    <meta http-equiv="refresh" content="2;url=edit.php" />

                                    <?php
                                } else {
                                    $query = mysqli_query($conn, "UPDATE users SET name = '$name', username = '$user', password = '$pass' WHERE id_user = '$id'");
                                    
                                }
                                if ($query) {
                                    ?>

                                        <div class="alert alert-success mt-5" role="alert">
                                            Produk kopi berhasil di update!
                                        </div>
                                        <meta http-equiv="refresh" content="2;url=index.php" />

                <?php
                                    } else {
                                        // Tampilkan eror jika ada kesalahan di database
                                        echo mysqli_error($conn);
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
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-4">
                    <h4>Edit Users</h4>
                </div>
                    <div class="card">
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">

                                <div class="col-md-12 mb-4 mt-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?= $row['name']; ?>">
                                </div>
                                <div class="col-md-12 mb-4 mt-4">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" value="<?= $row['username']; ?>">
                                </div>

                                <div class="col-md-12 mb-4 mt-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" name="password" class="form-control" id="password" value="<?= $row['password']; ?>">
                                </div>

                                <button type="submit" class="btn btn-primary" name="edit">Simpan Produk</button>
                            </form>
                            
                        </div>
                    </div>
            </div>
            <div class="back">
            <a href="index.php" class="btn btn-primary mt-5">kembali</a>
            </div>
        </div>
    </div>
    
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>