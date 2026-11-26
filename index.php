<?php
$koneksi = mysqli_connect("localhost","root","","web1_pertemuan09");

// TAMBAH PRODUK - FIX FOREIGN KEY
if(isset($_POST['tambah_produk'])){
  $nama = $_POST['nama'];
  $kat = (int)$_POST['kat'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  mysqli_query($koneksi,"INSERT INTO produk (nama_produk, id_kategori, harga, stok) VALUES ('$nama', $kat, '$harga', '$stok')");
  header("Location:index.php"); exit;
}

// HAPUS PRODUK
if(isset($_GET['hapus_produk'])){
  mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk='$_GET[hapus_produk]'");
  header("Location:index.php"); exit;
}

// EDIT PRODUK
if(isset($_POST['edit_produk'])){
  mysqli_query($koneksi,"UPDATE produk SET nama_produk='$_POST[nama]', id_kategori='$_POST[kat]', harga='$_POST[harga]', stok='$_POST[stok]' WHERE id_produk='$_POST[id]'");
  header("Location:index.php"); exit;
}

// TAMBAH PELANGGAN - FIX JUGA
if(isset($_POST['tambah_plg'])){
  mysqli_query($koneksi,"INSERT INTO pelanggan (nama_pelanggan, id_jenis, alamat, no_handphone) VALUES ('$_POST[nama]','$_POST[jenis]','$_POST[alamat]','$_POST[hp]')");
  header("Location:index.php"); exit;
}

if(isset($_GET['hapus_plg'])){
  mysqli_query($koneksi,"DELETE FROM pelanggan WHERE id_pelanggan='$_GET[hapus_plg]'");
  header("Location:index.php"); exit;
}
?>

<h2>Data Produk</h2>
<form method="POST">
<input name="nama" placeholder="Nama Produk" required>
<select name="kat" required>
<?php $k=mysqli_query($koneksi,"SELECT * FROM kategori"); while($r=mysqli_fetch_assoc($k)){ echo "<option value='$r[id_kategori]'>$r[nama_kategori]</option>"; } ?>
</select>
<input name="harga" placeholder="Harga" type="number" required>
<input name="stok" placeholder="Stok" type="number" required>
<button name="tambah_produk">simpan</button>
</form>

<table border="1" cellpadding="5">
<tr><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
<?php $q=mysqli_query($koneksi,"SELECT * FROM produk p JOIN kategori k ON p.id_kategori=k.id_kategori");
while($d=mysqli_fetch_assoc($q)){
if(isset($_GET['edit_produk']) && $_GET['edit_produk']==$d['id_produk']){
echo "<tr><form method='POST'><td><input name='nama' value='$d[nama_produk]'><input type='hidden' name='id' value='$d[id_produk]'></td>
<td><select name='kat'>"; $kk=mysqli_query($koneksi,"SELECT * FROM kategori"); while($r=mysqli_fetch_assoc($kk)){ $s=$r['id_kategori']==$d['id_kategori']?'selected':''; echo "<option $s value='$r[id_kategori]'>$r[nama_kategori]</option>"; } echo "</select></td>
<td><input name='harga' value='$d[harga]'></td><td><input name='stok' value='$d[stok]'></td>
<td><button name='edit_produk'>Simpan</button></td></form></tr>";
}else{
echo "<tr><td>$d[nama_produk]</td><td>$d[nama_kategori]</td><td>$d[harga]</td><td>$d[stok]</td>
<td><a href='?edit_produk=$d[id_produk]'>Edit</a> | <a href='?hapus_produk=$d[id_produk]'>Hapus</a></td></tr>";
}} ?>
</table>

<hr><h3>Data Pelanggan</h3>
<form method="POST">
<input name="nama" placeholder="Nama" required>
<select name="jenis"><?php $k=mysqli_query($koneksi,"SELECT * FROM jenis_pelanggan"); while($r=mysqli_fetch_assoc($k)){ echo "<option value='$r[id_jenis]'>$r[jenis]</option>"; } ?></select>
<input name="alamat" placeholder="Alamat" required>
<input name="hp" placeholder="No HP" required>
<button name="tambah_plg">simpan</button>
</form>

<table border="1" cellpadding="5">
<tr><th>Nama</th><th>Jenis</th><th>Alamat</th><th>No HP</th><th>Aksi</th></tr>
<?php $q2=mysqli_query($koneksi,"SELECT * FROM pelanggan p JOIN jenis_pelanggan j ON p.id_jenis=j.id_jenis");
while($d=mysqli_fetch_assoc($q2)){ echo "<tr><td>$d[nama_pelanggan]</td><td>$d[jenis]</td><td>$d[alamat]</td><td>$d[no_handphone]</td>
<td><a href='?hapus_plg=$d[id_pelanggan]'>Hapus</a></td></tr>"; } ?>
</table>