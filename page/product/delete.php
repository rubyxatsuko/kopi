
<?php 

include '../../db.php';

$id = $_GET['id'];

$produk         = mysqli_query($conn, "SELECT * FROM products WHERE id_product = '$id'");


$query = $conn->query("DELETE FROM products WHERE id_product = '$id'");

?>
<?php

if($query) {
   echo "<script>alert('Produk berhasil dihapus');window.location.href='index.php';</script>";

} else {
   echo "<script>alert('Produk gagal dihapus');window.location.href='index.php';</script>";
}

?>