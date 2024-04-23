<?php

include '../../db.php';

session_start();

$user_id = $_SESSION['users']['id_user'];
$product_id = $_GET['id_product'];

$check_existing_cart = mysqli_query($conn, "SELECT * FROM carts WHERE id_user='$user_id' AND id_product='$product_id'");

if ($check_existing_cart->num_rows > 0) {
    $id = mysqli_fetch_assoc($check_existing_cart)['id_cart'];
    mysqli_query($conn, "UPDATE carts SET qty=qty + 1 WHERE id_cart='$id'");
} else {
    mysqli_query($conn, "INSERT INTO carts (id_cart, id_user, id_product, qty) VALUES('$id', '$user_id', '$product_id', '1')");
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
                <a class="nav-link" href="../user/index.php">Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../product/index.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../rders/index.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">Logout</a>
            </li>
            </ul>
        </div>
        <div class="row">
        <div class="container-fuild">
            <div style="margin-top: 3rem;">
                <h2 class="text-center">Keranjang Kamu</h2>
                <p class="mt-4" name="date">Tanggal&nbsp;&nbsp;<strong><?php echo date("m/d/Y"); ?></strong></p>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-11">
                <table class="table table-responsive-lg table-responsive-md table-responsive-sm text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $user_id = $_SESSION['users']['id_user'];
                        $grand_total = 0;
                        $cart_select = mysqli_query($conn, "SELECT * FROM carts JOIN products ON carts.id_product=products.id_product WHERE id_user = '$user_id'");

                        if (mysqli_num_rows($cart_select) > 0) {
                            while ($row_cart = mysqli_fetch_assoc($cart_select)) {


                        ?>
                                <!-- START: Pesanan 1 -->
                                <tr>
                                    <td><?= $row_cart['name']; ?></td>
                                    <td>
                                        Rp <?= number_format($row_cart['price']); ?>
                                    </td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_update_quantity" value="<?= $row_cart['id_cart']; ?>">
                                            <input type="number" min="1" name="update_quantity" value="<?= $row_cart['qty']; ?>">
                                            <input type="submit" value="update" class="btn btn-dark btn-sm text-white" name="update_btn_cart">
                                        </form>
                                    </td>
                                    <td>
                                        Rp <?php echo $sub_total = $row_cart['price'] * $row_cart['qty']; ?>/-
                                    </td>
                                    <td>
                                        <a href="cart.php?remove=<?= $row_cart['cart_id']; ?>" onclick="return confirm('Mau hapus kopi ini?');" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- END: Pesanan 1 -->
                        <?php
                                //error_reporting(0);
                                $grand_total += $sub_total;
                            }
                        }
                        ?>

                        <tr>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-sm-12 mt-4 col-sm-10">
                <div class="d-flex justify-content-between">
                    <div class="btn btn-success btn-sm"><a href="index.php" style="text-decoration: none; color: #fff;">Kembali</a></div>
                </div>
            </div>

            <div class="col-md-10 col-sm-12 col-sm-10">
                <div class="d-flex justify-content-between align-content-center" style="margin-top: 4rem;">
                    <p style="font-size: 18px;">Total Belanja :</p>
                    <input type="hidden" name="" id="" value="<?php $grand_total_real = $grand_total ?>">
                    <p style="font-size: 18px;" class="float-end">Rp <?= number_format($grand_total); ?> /-</p>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-10 col-sm-12 col-sm-10 mx-auto mt-3 mb-5">
                <div class="d-flex justify-content-center align-content-center">
                    <div class="btn btn-secondary btn-sm <?= ($grand_total > 1) ? '' : 'disabled' ?>">
                        <a class="text-white" style="text-decoration:none;" href="checkout.php" onclick="return confirmCheckout()">Checkout Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function confirmCheckout() { // Ambil nilai dari database
                alert("Apakah Anda sudah yakin ingin checkout produk tersebut?");
                // Tidak perlu return false di sini
            }
        </script>






        </div>
    </div>
    
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>