Nama: Tria Puspita
NIM: 25012049
Kelas: 25M11 - Manajemen Informatika
Mata Kuliah: Pemrograman Web I - Pertemuan 9

Tugas CRUD Produk + Kategori & Pelanggan + Jenis Pelanggan (Tambah, Tampil, Hapus). Fix Undefined array key "id_produk" dan "id_pelanggan".

FILE UTAMA: index.php
<?php
$koneksi = mysqli_connect("localhost","root","","web1_pertemuan09");

// 1. FITUR HAPUS PRODUK
if(isset($_GET['hapus'])){
  mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk='$_GET[hapus]'");
  echo "<script>location='index.php'</script>"; exit;
}
// FITUR HAPUS PELANGGAN
if(isset($_GET['hapus_pelanggan'])){
  mysqli_query($koneksi,"DELETE FROM pelanggan WHERE id_pelanggan='$_GET[hapus_pelanggan]'");
  echo "<script>location='index.php'</script>"; exit;
}

// 2. FITUR SIMPAN PRODUK
if(isset($_POST['simpan'])){
  $id_kategori = $_POST['id_kategori'];
  $nama_produk = $_POST['nama_produk'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  mysqli_query($koneksi,"INSERT INTO produk (id_kategori,nama_produk,harga,stok) VALUES ('$id_kategori','$nama_produk','$harga','$stok')");
  echo "<script>location='index.php'</script>"; exit;
}
// FITUR SIMPAN PELANGGAN
if(isset($_POST['simpan_pelanggan'])){
  $id_jenis = $_POST['id_jenis'];
  $nama_pelanggan = $_POST['nama_pelanggan'];
  $alamat = $_POST['alamat'];
  $no_handphone = $_POST['no_handphone'];
  mysqli_query($koneksi,"INSERT INTO pelanggan (id_jenis,nama_pelanggan,alamat,no_handphone) VALUES ('$id_jenis','$nama_pelanggan','$alamat','$no_handphone')");
  echo "<script>location='index.php'</script>"; exit;
}

// 3. QUERY TAMPIL PRODUK + KATEGORI - FIX id_produk
$query = "SELECT p.id_produk, p.nama_produk, k.nama_kategori, p.harga, p.stok FROM produk p JOIN kategori k ON p.id_kategori=k.id_kategori";
$hasil = mysqli_query($koneksi,$query);

// QUERY TAMPIL PELANGGAN + JENIS - FIX id_pelanggan
$query_plg = "SELECT p.id_pelanggan, p.nama_pelanggan, j.jenis, p.alamat, p.no_handphone FROM pelanggan p JOIN jenis_pelanggan j ON p.id_jenis=j.id_jenis";
$hasil_plg = mysqli_query($koneksi,$query_plg);

// 4. QUERY UNTUK DROPDOWN
$query_kat = "SELECT * FROM kategori";
$hasil_kat = mysqli_query($koneksi,$query_kat);
$query_jenis = "SELECT * FROM jenis_pelanggan";
$hasil_jenis = mysqli_query($koneksi,$query_jenis);
?>

<h3>Produk</h3>
<form method="POST">
  <input name="nama_produk" placeholder="Nama Produk" required>
  <select name="id_kategori" required>
    <?php while($k=mysqli_fetch_assoc($hasil_kat)){ ?>
      <option value="<?=$k['id_kategori']?>"><?=$k['nama_kategori']?></option>
    <?php } ?>
  </select>
  <input name="harga" type="number" placeholder="Harga" required>
  <input name="stok" type="number" placeholder="Stok" required>
  <button name="simpan">Tambah</button>
</form>

<table border="1" cellpadding="8">
<tr><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
<?php while($row=mysqli_fetch_assoc($hasil)){ ?>
<tr>
  <td><?=$row['nama_produk']?></td>
  <td><?=$row['nama_kategori']?></td>
  <td><?=$row['harga']?></td>
  <td><?=$row['stok']?></td>
  <td><a href="?hapus=<?=$row['id_produk']?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td>
</tr>
<?php } ?>
</table>

<h3>Pelanggan</h3>
<form method="POST">
  <input name="nama_pelanggan" placeholder="Nama Pelanggan" required>
  <select name="id_jenis" required>
    <?php while($j=mysqli_fetch_assoc($hasil_jenis)){ ?>
      <option value="<?=$j['id_jenis']?>"><?=$j['jenis']?></option>
    <?php } ?>
  </select>
  <input name="alamat" placeholder="Alamat" required>
  <input name="no_handphone" placeholder="No HP" required>
  <button name="simpan_pelanggan">Tambah Pelanggan</button>
</form>

<table border="1" cellpadding="8">
<tr><th>Nama Pelanggan</th><th>Jenis</th><th>Alamat</th><th>No HP</th><th>Aksi</th></tr>
<?php while($row2=mysqli_fetch_assoc($hasil_plg)){ ?>
<tr>
  <td><?=$row2['nama_pelanggan']?></td>
  <td><?=$row2['jenis']?></td>
  <td><?=$row2['alamat']?></td>
  <td><?=$row2['no_handphone']?></td>
  <td><a href="?hapus_pelanggan=<?=$row2['id_pelanggan']?>" onclick="return confirm('Yakin hapus?')">Hapus</a></td>
</tr>
<?php } ?>
</table>