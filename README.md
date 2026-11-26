# web1-pertemuan09

**Nama: Tria Puspita**  
**Mata Kuliah: Pemrograman Web I - Pertemuan 9**

### Tugas CRUD Produk + Kategori & Pelanggan + Jenis Pelanggan (Tambah, Tampil, Hapus)

**Fix yang sudah dilakukan:**
- Fix `Undefined array key "id_produk"` dan `"id_pelanggan"` - sekarang sudah ada id di tabel
- Fix `jenis_pelanggan` yang double menjadi 2 data (Member, Biasa)
- Fix `id_pelanggan` dan `id_produk` yang hilang di JOIN query

**FILE UTAMA: index.php**

#### Struktur Database `web1_pertemuan09`:
- `kategori` (id_kategori, nama_kategori)
- `produk` (id_produk, id_kategori, nama_produk, harga, stok)
- `jenis_pelanggan` (id_jenis, jenis)
- `pelanggan` (id_pelanggan, id_jenis, nama_pelanggan, alamat, no_handphone)

#### Fitur:
1. Tampil Produk JOIN Kategori
2. Tampil Pelanggan JOIN Jenis Pelanggan
3. Tambah Produk & Pelanggan
4. Hapus Produk & Pelanggan
5. Dropdown Kategori & Jenis

#### Cara Jalan:
1. Import DB ke phpMyAdmin
2. Taruh di `htdocs/web1-pertemuan09`
3. Buka `http://localhost/web1-pertemuan09/index.php`

#### Dokumentasi ada di folder `/Dokumentasi`