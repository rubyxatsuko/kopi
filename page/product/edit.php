<?php

session_start();
                            // Menghubungkan ke database
include '../../db.php';

// mengambil id
$id = $_GET['id'];

// Menampilkan product di database
$query = mysqli_query($conn,"SELECT * FROM products WHERE id_product = '$id'");

if(mysqli_num_rows($query) > 0) {
   $row       = mysqli_fetch_assoc($query);

}

// Membuat random string
// agar nama file foto tidak sama
function generateRandomString($length = 10)
{
   $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charactersLength = strlen($characters);
   $randomString = '';
   for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
   }
   return $randomString;
}

                            // Membuat update product
                            if (isset($_POST['edit'])) {
                                $name         = htmlspecialchars($_POST['name']);
                                $price        = htmlspecialchars($_POST['price']);
                                $stok         = htmlspecialchars($_POST['stock']);

                                // Membuat upload file foto
                                $target_dir    = "../../assets/img/fotoProduk/";
                                $nama_file     = basename($_FILES["image"]["name"]);
                                $target_file   = $target_dir . $nama_file;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $image_size    = $_FILES['image']['size'];
                                $random_name   = generateRandomString(20);
                                $new_name      = $random_name . "." . $imageFileType;

                                // cek apakah nama dan harga kosong atau tidak
                                // Kalau kosong tidak bisa diupload
                                if ($name == '' || $price == '' || $stok == '' ) {
                            ?>

                                    <div class="alert alert-primary" role="alert">
                                        Nama dan harga produk kopi wajib di isi!
                                    </div>
                                    <meta http-equiv="refresh" content="2;url=index.php" />

                                    <?php
                                } else {
                                    $query = mysqli_query($conn, "UPDATE products SET name = '$name', price = '$price', stock = '$stok', image = '$nama_file' WHERE id_product = '$id'");
                                    if ($nama_file != '') {
                                        if ($image_size > 50000000) { 
                                    ?>

                                            <div class="alert alert-primary mt-5" role="alert">
                                                Ukuran gambar tidak boleh lebih dari 2 MB
                                            </div>
                                            <meta http-equiv="refresh" content="2;url=index.php" />

                                            <?php
                                        } else {
                                            // Jika foto tidak sesuai dengan ekstensi dibawah ini
                                            // Maka akan muncul pesan peringatan melaui alert
                                            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                                            ?>

                                                <div class="alert alert-primary mt-5" role="alert">
                                                    Hanya file jpg, jpeg dan png yang diperbolehkan
                                                </div>
                                                <meta http-equiv="refresh" content="2;url=index.php" />

                                                <?php
                                            } else {
                                                // upload file foto
                                                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $nama_file);

                                                $query = mysqli_query($conn, "UPDATE products SET image ='$nama_file' WHERE id_product = '$id'");

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
                                        }
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
                <a class="nav-link" href="user/index.php">Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Product</a>
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
                    <h4>Edit Product</h4>
                </div>
                    <div class="card">
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">

                                <div class="col-md-12 mb-4 mt-3">
                                    <label for="name" class="form-label">Nama Produk</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?= $row['name']; ?>">
                                </div>
                                <div class="col-md-12 mb-4 mt-4">
                                    <label for="price" class="form-label">Harga Produk</label>
                                    <input type="text" name="price" class="form-control" id="price" value="<?= $row['price']; ?>">
                                </div>

                                <div class="col-md-12 mb-4 mt-4">
                                    <label for="image" class="form-label">Gambar produk saat ini</label>
                                    <img class="mt-3 d-flex" src="../../assets/img/fotoProduk/<?= $row['image'] ?>" width="150">
                                </div>

                                <div class="col-md-12 mb-4 mt-4">
                                    <label for="image" class="form-label">Ganti Gambar</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <small class="text-danger"><strong>* upload gambar yang berekstensi png, jpg atau jpeg</strong></small>
                                </div>

                                <div class="col-md-12 mb-4 mt-4">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="text" name="stock" class="form-control" id="stok" value="<?= $row['stock']; ?>">
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