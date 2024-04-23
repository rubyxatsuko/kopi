<?php 

require ("../../db.php");

session_start();
if (!isset($_SESSION['users'])) {
    echo "<script>alert('Mohon login terlebih dahulu')
  location.replace('../../login.php')</script>";
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
        <div class="row">
        <div class="container mb-5">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h1 class="h5 mb-0 text-gray-800">Page Product - Produk</h1>
                            </div>
                            <table class="table table-responsive text-center mt-4" style="border: none;">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Stok</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $number = 1;

                                    $product = $conn->query("SELECT * FROM products");

                                    while ($row = $product->fetch_assoc()) :
                                    ?>
                                        <th scope="row"><?= $number; ?></th>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>Rp&nbsp;<?= number_format($row['price']); ?> </td>
                                        <td><img width="80" src="../../assets/img/fotoproduk/<?= $row['image']; ?>"></td>
                                        <td><?php echo $row['stock']; ?></td>
                                        <td>
                                            <button class="btn btn-primary">
                                            <a class="" href="delete.php?id=<?= $row['id_product']; ?>" onclick="return confirm('Anda mau hapus produk ini?')"><i class="bi bi-trash" style="color: white;">Hapus</i></a>
                                            </button>
                                            <button class="btn btn-primary">
                                            <a href="edit.php?id=<?= $row['id_product']; ?>"><i class="bi bi-pencil-square" style="color: white;"> Edit </i></a>
                                            </button>
                                        </td>
                                        
                                </tbody>
                                <?php $number++; ?>
                            <?php endwhile; ?>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <div class="card mt-5">
                                <ul class="list-group list-group-flush">
                                    
                                    <li class="list-group-item">
                                        <a href="tambah.php" style="text-decoration: none;"><i class="fa fa-plus-square"></i>&nbsp;Tambah Produk</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>
    
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>