<?php

session_start();

include('../db.php');

$user_id = $_SESSION['users']['id_user'];
$product_id = $_GET['product_id'];
$qty = $_GET['qty'];

$check_existing_cart = mysqli_query($conn, "SELECT * FROM carts WHERE id_user='$user_id' AND id_product='$product_id'");

if ($check_existing_cart->num_rows > 0) {
    $id = mysqli_fetch_assoc($check_existing_cart)['id_cart'];
    mysqli_query($conn, "UPDATE carts SET qty=qty + 1 WHERE id_cart='$id'");
} else {
    mysqli_query($conn, "INSERT INTO carts (id_cart, id_user, id_product, qty) VALUES('1','$user_id', '$product_id', '$qty')");
}

header("Location: orders/cart.php");
