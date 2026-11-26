<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Data Kategori</title>
</head>
<body class="bg-light">
<div class="container mt-4">
  <h4 class="fw-bold">📂 Data Kategori - UKM Komputer</h4>
  <table class="table table-bordered table-striped shadow">
    <thead class="table-dark">
      <tr><th>ID</th><th>Nama Kategori</th><th>Jumlah Produk</th></tr>
    </thead>
    <tbody>
    <?php
    $q = mysqli_query($koneksi, "
      SELECT k.id_kategori, k.nama_kategori, COUNT(p.id_produk) as jml
      FROM kategori k
      LEFT JOIN produk p ON p.id_kategori = k.id_kategori
      GROUP BY k.id_kategori
    ");
    while($d = mysqli_fetch_assoc($q)){
      echo "<tr>
        <td>{$d['id_kategori']}</td>
        <td><b>{$d['nama_kategori']}</b></td>
        <td><span class='badge bg-primary'>{$d['jml']} Produk</span></td>
      </tr>";
    }
    ?>
    </tbody>
  </table>
</div>
</body>
</html>