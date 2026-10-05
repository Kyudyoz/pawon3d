# Dokumentasi Sequence Diagram

## Pendahuluan

Sequence diagram menggambarkan interaksi antar objek dalam sistem berdasarkan urutan waktu. Diagram ini menunjukkan bagaimana pesan dikirim antara aktor, controller, dan model untuk menyelesaikan suatu proses. Dokumentasi disusun berdasarkan pembagian increment dan aktor yang terlibat.

---

## Sequence Diagram Increment 1: Modul Inti Operasional

### SD-001: Login Pengguna

**Aktor**: Semua pengguna terdaftar  
**Deskripsi**: Interaksi sistem saat pengguna melakukan autentikasi untuk masuk ke dashboard.

### SD-002: Mengelola Produk & Komposisi (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Interaksi sistem saat mengelola data produk beserta resep/komposisinya.

### SD-003: Mengelola Supplier (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Interaksi sistem saat mengelola data pemasok bahan baku.

### SD-004: Proses Belanja (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Interaksi sistem saat melaksanakan pengadaan bahan baku dari supplier.

### SD-005: Proses Produksi (Produksi)

**Aktor**: Staff Produksi  
**Deskripsi**: Interaksi sistem saat melaksanakan produksi pesanan atau stok siap beli.

### SD-006: Transaksi Penjualan (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Interaksi sistem saat memproses transaksi penjualan hingga pencetakan struk.

### SD-007: Shift Kasir (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Interaksi sistem saat pembukaan dan penutupan shift kasir harian.

---

## Sequence Diagram Increment 2: Modul Pendukung Operasional

### SD-008: Pengelolaan Pengguna (Admin)

**Aktor**: Admin  
**Deskripsi**: Interaksi sistem saat mengelola akun pekerja dan pengiriman undangan email.

### SD-009: Aktivasi Akun (Staff Baru)

**Aktor**: Staff Baru  
**Deskripsi**: Interaksi sistem saat Staff Baru mengaktifkan akun dan mengatur password.

### SD-010: Stock Opname (Inventori)

**Aktor**: Staff Inventori  
**Deskripsi**: Interaksi sistem saat melakukan penghitungan stok fisik dan penyesuaian data.

### SD-011: Refund / Pengembalian Dana (Kasir)

**Aktor**: Kasir  
**Deskripsi**: Interaksi sistem saat membatalkan transaksi dan memproses pengembalian dana.

### SD-012: Ekspor Laporan (Semua)

**Aktor**: Semua pengguna terautentikasi  
**Deskripsi**: Interaksi sistem saat menghasilkan dan mengunduh laporan format PDF/Excel.

### SD-013: Pengaturan Profil Usaha (Admin)

**Aktor**: Admin  
**Deskripsi**: Interaksi sistem saat mengubah konfigurasi profil dan identitas usaha.

---

## Daftar Berkas Diagram Sequence

Berikut adalah daftar berkas PlantUML untuk setiap diagram sequence:

| ID     | Nama Proses          | Berkas (PUML)                                                             |
| ------ | -------------------- | ------------------------------------------------------------------------- |
| SD-001 | Login Pengguna       | [sequence-inc-1-login.puml](puml/sequence-inc-1-login.puml)               |
| SD-002 | Mengelola Produk     | [sequence-inc-1-produk.puml](puml/sequence-inc-1-produk.puml)             |
| SD-003 | Mengelola Supplier   | [sequence-inc-1-supplier.puml](puml/sequence-inc-1-supplier.puml)         |
| SD-004 | Proses Belanja       | [sequence-inc-1-belanja.puml](puml/sequence-inc-1-belanja.puml)           |
| SD-005 | Proses Produksi      | [sequence-inc-1-produksi.puml](puml/sequence-inc-1-produksi.puml)         |
| SD-006 | Transaksi Penjualan  | [sequence-inc-1-transaksi.puml](puml/sequence-inc-1-transaksi.puml)       |
| SD-007 | Shift Kasir          | [sequence-inc-1-shift.puml](puml/sequence-inc-1-shift.puml)               |
| SD-008 | Pengelolaan Pengguna | [sequence-inc-2-pengguna.puml](puml/sequence-inc-2-pengguna.puml)         |
| SD-009 | Aktivasi Akun        | [sequence-inc-2-aktivasi.puml](puml/sequence-inc-2-aktivasi.puml)         |
| SD-010 | Stock Opname         | [sequence-inc-2-stock-opname.puml](puml/sequence-inc-2-stock-opname.puml) |
| SD-011 | Refund               | [sequence-inc-2-refund.puml](puml/sequence-inc-2-refund.puml)             |
| SD-012 | Ekspor Laporan       | [sequence-inc-2-laporan.puml](puml/sequence-inc-2-laporan.puml)           |
| SD-013 | Pengaturan Profil    | [sequence-inc-2-profil.puml](puml/sequence-inc-2-profil.puml)             |

---

## Kesimpulan

Sequence diagram Sistem Pawon3D mencakup 13 interaksi utama yang menggambarkan alur pesan antar objek secara detail. Dokumentasi ini memastikan pemahaman teknis mengenai bagaimana sistem merespons input aktor dan berinteraksi dengan basis data.
