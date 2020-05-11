<h2>Data Produk</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>

<tbody>
    <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
    <?php while($pecah = $ambil->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $pecah['id_produk']; ?></td>
        <td><?php echo $pecah['nama_produk']; ?></td>
        <td><?php echo $pecah['harga_produk']; ?></td>
        <td>
            <img src="../admin/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100">
		</td>
        <td>
            <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger">hapus</a>
            <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning">ubah</a>
    </td>
    </tr>
    <?php } ?>
    
</tbody>
</table>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Produk</a>