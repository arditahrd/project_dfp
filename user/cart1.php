<?php
session_start();
//mendapatkan id_produk dari url
$id_produk=$_GET['id'];

//jika sudah ada produk itu dikeranjang, maka produk itu jumlahnya di +1
if(isset($_SESSION['cart'][$id_produk]))
{
    $_SESSION['cart'][$id_produk]+=1;
}
//jika produk belum ada di keranjang, maka produk dianggap dibeli 1
else
{
    $_SESSION['cart'][$id_produk]=1;
}

//alihkan ke halaman cart.php
echo"<script>alert('Product Added To Cart');</script>";
echo"<script>location='cart.php';</script>";
?>