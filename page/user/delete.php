<?php

include "../../db.php";

session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = $conn->query("DELETE FROM users WHERE id_user = '$id'");

    if($delete) {
        echo "<script>alert('Produk berhasil dihapus');window.location.href='index.php';</script>";
     
     } else {
        echo "<script>alert('Produk gagal dihapus');window.location.href='index.php';</script>";
     }
}
?>