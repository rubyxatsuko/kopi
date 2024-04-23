<?php

include '../db.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pos App Rubyz</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row py-5" >
            <ul class="nav justify-content-center bg-warning border-bottom border-body">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/index.php">Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product/index.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rders/index.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
            </ul>
        </div>
        <div class="row">
                    <!-- START: Text Menu Kopi -->
            <div class="text-center mb-3">
                <h2 class="text-warning">Pilih Product</h2>
                <hr>
            </div>
            <!-- END: Text Menu Kopi -->

            <?php
            // Mengambil data dari table product
            $product = mysqli_query($conn, "SELECT * FROM products");
            // M<enampilkan data dari table product
            if (mysqli_num_rows($product) > 0) :
                while ($row = mysqli_fetch_assoc($product)) :
            ?>

                <div class="col-12 col-md-6 col-lg-3 mb-3">
                    <div class="card shadow">
                    <div class="card-body">
                        <form action="" method="POST">
                        <img src="../assets/img/fotoProduk/<?= $row['image']; ?>" class="card-img-top" style="height: 270px; width: 270px; ">
                        <h5 class="mt-2"><?= $row['name']; ?></h5>
                        <p class="card-text">Rp&nbsp;<?= number_format($row['price']); ?></p>

                        <input type="hidden" name="name" value=" <?= $row['name']; ?>">
                        <input type="hidden" name="price" value="<?= $row['price']; ?>">
                        <input type="hidden" name="image" value="<?= $row['image']; ?>">

                        <?php

                        if (isset($_SESSION['user'])) {
                        ?>
                            <a href="orders/cart.php?id_product=<?= $row['id_product'] ?>" class="btn btn-danger">Beli Sekarang</a>
                        <?php
                        } else {
                        ?>
                        <?php
                        }
                        ?>
                        <!-- END: Add Product -->
                    </div>
                    </div>
                    </form>
                </div>
            <?php
                endwhile;
            endif;
            ?>
            </div>
        </div>
        
        
    </div>
    
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>