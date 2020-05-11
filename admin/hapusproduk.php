<?php

$ambil = $koneksi->query("SELECET * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc;
$fotoproduk = $pecah['foto_produk'];
if (file_exists("../admin/foto_produk/$fotoproduk")) 
{
	unlink("../admin/foto_produk/$fotoproduk");
}


$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>alert('produk telah dihapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";

?>