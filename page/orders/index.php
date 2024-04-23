<?php

include "../../db.php";

session_start();


$orders = $conn->query("SELECT * FROM orders");
if(isset($_POST['simpan'])) {
    $kasir = $_POST['kasir'];
    $product = $_POST['product'];
    $customer_name = $_POST['customer_name'];
    $order_type = $_POST['order_type'];
    $total = $_POST['total'];
    $total_payment = $_POST['total_payment'];
    $change = $_POST['total_payment'] - $_POST['total'];
    $order_date = $_POST['order_date'];

    $simpan = $conn->query("INSERT INTO orders VALUES (NULL, '$kasir', '$product', '$customer_name', '$order_type','$total','$total_payment','$change','$order_date')");
    if ($simpan) {
        echo '<script>alert("Data Berhasil Ditambahkan"); location.replace("index.php");</script>';
    } else {
        echo '<script>alert("Data Gagal Ditambah"); location.replace("index.php");</script>';
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete = $conn->query("DELETE FROM orders WHERE id_order = '$id'");
    if ($delete) {
      echo '<script>alert("Data Telah Dihapus");
      location.replace("index.php");</script>';
    }
  }

$view_users = $conn->query("SELECT * FROM users");
$view_products = $conn->query("SELECT * FROM products");
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
                <a class="nav-link" href="../product/index.php">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">Logout</a>
            </li>
            </ul>
        </div>

  <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow mb-3">
                    <div class="card-header bg-dark">
                        <h3 class="mb-0 text-white">Data Transaksi </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-grup mb-3">
                                        <label for="">Kasir</label>
                                        <select class="form-select" name="kasir" id="user">
                                            <?php
                                            foreach ($view_users as $show) { ?>
                                                <option value="<?= $show['id_user'] ?>"><?= $show['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label for="">Product</label>
                                        <select class="form-select" name="product" id="product">
                                            <?php
                                            foreach ($view_products as $show) { ?>
                                                <option value="<?= $show['id_product'] ?>"><?= $show['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Nama Customer</label>
                                        <input type="text" required name="customer_name" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label for="">Order Type</label>
                                        <select class="form-select" name="order_type" id="order_type">
                                                <option value="<?= $show['order_type'] ?>"></option>
                                        </select>
                                    </div>
                                    

                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Tanggal</label>
                                        <input type="date" required name="order_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                <div class="form-grup mb-3">
                                        <label class="form-label" for="">Total</label>
                                        <input type="number" required name="total" class="form-control">
                                    </div>
                                    <div class="form-grup mb-3">
                                        <label class="form-label" for="">Payment</label>
                                        <input type="number" required name="total_payment" class="form-control">
                                    </div>
                            
                                </div>
                                <div class="form-group text-end">
                                    <button type="submit" name="simpan" class="btn btn-success btn-lg w-100 mt-4"><i class="bi bi-plus"></i> Tambah</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-body">
                    <table class=" table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kasir</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Change</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($orders as $order) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $order['id_user'] ?></td>
                                    <td><?= $order['id_product'] ?></td>
                                    <td><?= $order['customer_name'] ?></td>
                                    <td><?= $order['tanggal'] ?></td>
                                    <td><?= $order['total'] ?></td>
                                    <td><?= $order['total_payment'] ?></td>
                                    <td><?= $order['change'] ?></td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $trnx['id_order'] ?>" class="btn btn-warning text-white btn-sm">Edit <i class="bi bi-pencil-fill"></i></a>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $trnx['id_order'] ?>">
                                            <button type="submit" name="delete" class="btn btn-danger text-white btn-sm">Delete <i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>