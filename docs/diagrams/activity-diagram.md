# Dokumentasi Activity Diagram

## Pendahuluan

Activity diagram menggambarkan alur kerja (workflow) dari proses-proses utama dalam Sistem Manajemen Toko Kue Pawon3D. Diagram ini menunjukkan urutan aktivitas, keputusan, dan percabangan yang terjadi dalam setiap proses bisnis. Dokumentasi disusun berdasarkan pembagian increment dan aktor yang terlibat.

---

## Activity Diagram Increment 1: Modul Inti Operasional

### AD-001: Login Pengguna

**Aktor**: Semua pengguna terdaftar  
**Deskripsi**: Proses autentikasi pengguna untuk mengakses sistem. Validasi kredensial (email & password) dan pembuatan session. Pemeriksaan status akun aktif diimplementasikan di Increment 2 (AD-017).

### AD-002: Mengelola Kategori (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses pengelolaan data kategori produk.

### AD-003: Mengelola Bahan Baku (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses pengelolaan data bahan baku.

### AD-004: Mengelola Produk & Komposisi (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses pengelolaan produk dengan input komposisi bahan baku dan penetapan harga jual. Alur mencakup: input data produk → tentukan jumlah PCS → tambah komposisi bahan baku (material + satuan + jumlah) → opsional biaya lain → sistem hitung modal (total komposisi + biaya lain) → input harga jual → pilih metode penjualan (Pesanan Reguler/Kotak/Siap Saji).

### AD-005: Mengelola Supplier (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses pengelolaan data pemasok bahan baku.

### AD-006: Mengelola Satuan & Konversi (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses pengelolaan satuan produk/bahan dan faktor konversinya.

### AD-007: Proses Belanja (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses perencanaan dan pelaksanaan belanja bahan baku.

### AD-008: Proses Produksi (Produksi)

**Aktor**: Staff Produksi  
**Deskripsi**: Proses eksekusi produksi berdasarkan pesanan atau stok siap beli.

### AD-009: Membuat Pesanan / POS (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Proses pembuatan pesanan penjualan produk (Kotak, Reguler, Siap Beli).  
**Precondition**: Shift kasir harus sudah dibuka (status active).

### AD-010: Proses Pembayaran & Riwayat (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Proses pencatatan pembayaran transaksi dan melihat riwayat transaksi.  
**Precondition**: Shift kasir harus sudah dibuka (status active).

### AD-011: Shift Kasir (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Proses pembukaan dan penutupan shift kasir harian.

---

## Activity Diagram Increment 2: Modul Pendukung Operasional

### AD-012: Pengelolaan Pengguna (Admin)

**Aktor**: Admin  
**Deskripsi**: Proses pengelolaan data pengguna sistem.

### AD-013: Pengelolaan Peran & Hak Akses (Admin)

**Aktor**: Admin  
**Deskripsi**: Proses pengelolaan peran dan permission hak akses.

### AD-014: Pengaturan Profil & Metode Pembayaran (Admin)

**Aktor**: Admin  
**Deskripsi**: Proses pengaturan identitas toko dan konfigurasi metode pembayaran.

### AD-015: Pengelolaan Pelanggan & Poin Loyalitas (Admin)

**Aktor**: Admin  
**Deskripsi**: Proses pengelolaan database pelanggan dan sistem poin loyalitas.

### AD-016: Akses Laporan & Ekspor (Semua)

**Aktor**: Semua pengguna terautentikasi  
**Deskripsi**: Proses melihat dan mengekspor laporan ke format PDF/Excel.

### AD-017: Aktivasi Akun (Staff Baru)

**Aktor**: Staff Baru  
**Deskripsi**: Proses aktivasi akun oleh Staff Baru melalui email.

### AD-018: Stock Opname (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses penghitungan dan penyesuaian stok fisik.

### AD-019: Kelola Alur Persediaan (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Proses pemantauan log mutasi dan riwayat pergerakan stok.

### AD-020: Penggunaan Poin Loyalitas (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Proses penukaran poin loyalitas pelanggan menjadi potongan harga.

### AD-021: Refund / Pengembalian Dana (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Proses pembatalan transaksi dan pengembalian dana per produk.

### AD-022: Mengakses Halaman Utama (Pengunjung)

**Aktor**: Pengunjung  
**Deskripsi**: Proses akses halaman landing page untuk melihat informasi toko dan produk unggulan.

### AD-023: Melihat Katalog Produk (Pengunjung)

**Aktor**: Pengunjung  
**Deskripsi**: Proses penelusuran katalog produk dengan fitur pencarian dan filter.

### AD-024: Melihat Detail Produk (Pengunjung)

**Aktor**: Pengunjung  
**Deskripsi**: Proses melihat informasi lengkap produk beserta produk terkait.

### AD-025: Mengakses FAQ (Pengunjung)

**Aktor**: Pengunjung  
**Deskripsi**: Proses akses halaman FAQ untuk melihat pertanyaan yang sering diajukan.

### AD-026: Kelola Profil Pribadi (Semua Pengguna)

**Aktor**: Semua pengguna terdaftar  
**Deskripsi**: Proses melihat dan mengubah data profil pribadi pengguna.

### AD-026: Kelola Notifikasi (Semua Pengguna)

**Aktor**: Semua pengguna terdaftar  
**Deskripsi**: Proses melihat dan menandai notifikasi sistem sebagai sudah dibaca.

---

## Daftar Berkas Diagram Activity

Berikut adalah daftar berkas PlantUML untuk setiap diagram activity:

### Increment 1: Modul Inti Operasional

| ID     | Nama Proses                  | Berkas (PUML)                                                         |
| ------ | ---------------------------- | --------------------------------------------------------------------- |
| AD-001 | Login Pengguna               | [activity-inc-1-login.puml](puml/activity-inc-1-login.puml)           |
| AD-002 | Mengelola Kategori           | [activity-inc-1-kategori.puml](puml/activity-inc-1-kategori.puml)     |
| AD-003 | Mengelola Bahan Baku         | [activity-inc-1-bahan-baku.puml](puml/activity-inc-1-bahan-baku.puml) |
| AD-004 | Mengelola Produk & Komposisi | [activity-inc-1-produk.puml](puml/activity-inc-1-produk.puml)         |
| AD-005 | Mengelola Supplier           | [activity-inc-1-supplier.puml](puml/activity-inc-1-supplier.puml)     |
| AD-006 | Mengelola Satuan             | [activity-inc-1-satuan.puml](puml/activity-inc-1-satuan.puml)         |
| AD-007 | Proses Belanja               | [activity-inc-1-belanja.puml](puml/activity-inc-1-belanja.puml)       |
| AD-008 | Proses Produksi              | [activity-inc-1-produksi.puml](puml/activity-inc-1-produksi.puml)     |
| AD-009 | Membuat Pesanan (POS)        | [activity-inc-1-pesanan.puml](puml/activity-inc-1-pesanan.puml)       |
| AD-010 | Proses Pembayaran & Riwayat  | [activity-inc-1-pembayaran.puml](puml/activity-inc-1-pembayaran.puml) |
| AD-011 | Shift Kasir                  | [activity-inc-1-shift.puml](puml/activity-inc-1-shift.puml)           |

### Increment 2: Modul Pendukung Operasional

| ID     | Nama Proses                           | Berkas (PUML)                                                                       |
| ------ | ------------------------------------- | ----------------------------------------------------------------------------------- |
| AD-012 | Pengelolaan Pengguna                  | [activity-inc-2-pengguna.puml](puml/activity-inc-2-pengguna.puml)                   |
| AD-013 | Pengelolaan Peran & Hak Akses         | [activity-inc-2-peran.puml](puml/activity-inc-2-peran.puml)                         |
| AD-014 | Pengaturan Profil & Metode Pembayaran | [activity-inc-2-profil-pembayaran.puml](puml/activity-inc-2-profil-pembayaran.puml) |
| AD-015 | Pengelolaan Pelanggan & Poin          | [activity-inc-2-pelanggan-poin.puml](puml/activity-inc-2-pelanggan-poin.puml)       |
| AD-016 | Akses Laporan & Ekspor                | [activity-inc-2-laporan.puml](puml/activity-inc-2-laporan.puml)                     |
| AD-017 | Aktivasi Akun                         | [activity-inc-2-aktivasi.puml](puml/activity-inc-2-aktivasi.puml)                   |
| AD-018 | Stock Opname                          | [activity-inc-2-stock-opname.puml](puml/activity-inc-2-stock-opname.puml)           |
| AD-019 | Kelola Alur Persediaan                | [activity-inc-2-alur-persediaan.puml](puml/activity-inc-2-alur-persediaan.puml)     |
| AD-020 | Penggunaan Poin Loyalitas             | [activity-inc-2-penggunaan-poin.puml](puml/activity-inc-2-penggunaan-poin.puml)     |
| AD-021 | Refund / Pengembalian Dana            | [activity-inc-2-refund.puml](puml/activity-inc-2-refund.puml)                       |
| AD-022 | Mengakses Halaman Utama               | [activity-inc-2-landing-page.puml](puml/activity-inc-2-landing-page.puml)           |
| AD-023 | Melihat Katalog Produk                | [activity-inc-2-katalog-produk.puml](puml/activity-inc-2-katalog-produk.puml)       |
| AD-024 | Melihat Detail Produk                 | [activity-inc-2-detail-produk.puml](puml/activity-inc-2-detail-produk.puml)         |
| AD-025 | Mengakses FAQ                         | [activity-inc-2-faq.puml](puml/activity-inc-2-faq.puml)                             |
| AD-026 | Kelola Profil Pribadi                 | [activity-inc-2-profil-pribadi.puml](puml/activity-inc-2-profil-pribadi.puml)       |
| AD-027 | Kelola Notifikasi                     | [activity-inc-2-notifikasi.puml](puml/activity-inc-2-notifikasi.puml)               |

---

## Kesimpulan

Activity diagram Sistem Pawon3D mencakup 27 proses bisnis utama yang menggambarkan alur kerja operasional secara mendetail, meliputi:

-   **11 Activity Diagram Increment 1**: Modul inti operasional (login, manajemen master data, produksi, pesanan, pembayaran, shift)
-   **16 Activity Diagram Increment 2**: Modul pendukung operasional (manajemen pengguna, laporan, aktivasi, stock opname, refund, landing page, profil, notifikasi)

Dokumentasi ini memberikan gambaran menyeluruh tentang fungsi sistem dari berbagai perspektif aktor, termasuk fitur untuk pengguna internal (Admin, Inventori, Produksi, Kasir) dan pengguna eksternal (Pengunjung).
