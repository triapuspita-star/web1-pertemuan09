
<?php
include 'koneksi.php';

// Tambah data
if (isset($_POST['tambah'])) {
    $jenis = $_POST['jenis'];

    mysqli_query($koneksi, "INSERT INTO jenis_pelanggan (jenis)
    VALUES ('$jenis')");

    header("Location: jenis_pelanggan.php");
    exit;
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM jenis_pelanggan
    WHERE id_jenis = '$id'");

    header("Location: jenis_pelanggan.php");
    exit;
}

// Edit data
if (isset($_POST['edit'])) {
    $id = $_POST['id_jenis'];
    $jenis = $_POST['jenis'];

    mysqli_query($koneksi, "UPDATE jenis_pelanggan
    SET jenis = '$jenis'
    WHERE id_jenis = '$id'");

    header("Location: jenis_pelanggan.php");
    exit;
}
?>

<h2>Data Jenis Pelanggan</h2>

<form method="POST">
    <input type="text" name="jenis"
    placeholder="Masukkan jenis pelanggan" required>
    <button type="submit" name="tambah">Tambah</button>
</form>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Jenis Pelanggan</th>
        <th>Aksi</th>
    </tr>

    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM jenis_pelanggan");

    while ($row = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
        <td><?= $row['id_jenis']; ?></td>
        <td><?= htmlspecialchars($row['jenis']); ?></td>
        <td>
            <a href="jenis_pelanggan.php?hapus=<?= $row['id_jenis']; ?>"
            onclick="return confirm('Hapus data ini?')">Hapus</a>

            <form method="POST" style="display:inline;">
                <input type="hidden" name="id_jenis"
                value="<?= $row['id_jenis']; ?>">

                <input type="text" name="jenis"
                value="<?= htmlspecialchars($row['jenis']); ?>" required>

                <button type="submit" name="edit">Edit</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="index.php">Kembali ke Halaman Utama</a>
