# Dokumentasi Sistem Manajemen Bisnis Pawon3D

> Analisis sistem berdasarkan kode sumber Laravel + Livewire  
> Metode pengembangan: Incremental Development (2 Increment)

---

## Tahap 1 — Ringkasan Sistem

### Nama Sistem

**Sistem Manajemen Bisnis Pawon3D** — aplikasi manajemen toko kue/bakeri yang mencakup modul inventori, produksi, transaksi, dan administrasi.

---

## Tahap 2 — Fitur Berdasarkan Increment

### Increment 1 — Modul Inti Operasional

_(TC-001 s.d. TC-082)_

| Aktor           | Fitur                                                         |
| --------------- | ------------------------------------------------------------- |
| Staff Inventori | Autentikasi (Login/Logout)                                    |
| Staff Inventori | Manajemen Kategori Produk                                     |
| Staff Inventori | Manajemen Satuan Ukur                                         |
| Staff Inventori | Manajemen Supplier                                            |
| Staff Inventori | Manajemen Bahan Baku                                          |
| Staff Inventori | Manajemen Belanja Bahan Baku                                  |
| Staff Inventori | Manajemen Produk dan Komposisi                                |
| Staff Produksi  | Autentikasi (Login/Logout)                                    |
| Staff Produksi  | Melihat Antrian Produksi                                      |
| Staff Produksi  | Memulai dan Menyelesaikan Produksi Pesanan                    |
| Staff Produksi  | Membuat Produksi Siap Beli                                    |
| Kasir           | Autentikasi (Login/Logout)                                    |
| Kasir           | Membuka dan Menutup Shift Penjualan                           |
| Kasir           | Membuat Transaksi (Pesanan Reguler, Pesanan Kotak, Siap Beli) |
| Kasir           | Memproses Pembayaran                                          |
| Kasir           | Mencetak Struk                                                |
| Kasir           | Melihat Riwayat Transaksi                                     |

### Increment 2 — Modul Pendukung Operasional

_(TC-083 s.d. TC-135)_

| Aktor          | Fitur                                         |
| -------------- | --------------------------------------------- |
| Admin          | Autentikasi (Login/Logout)                    |
| Admin          | Manajemen Pekerja (Tambah, Ubah, Nonaktifkan) |
| Admin          | Manajemen Peran dan Hak Akses                 |
| Admin          | Pengaturan Profil Usaha                       |
| Admin          | Manajemen Metode Pembayaran                   |
| Admin          | Manajemen Data Pelanggan                      |
| Semua Pengguna | Mengubah Profil Sendiri                       |
| Semua Pengguna | Melihat dan Mengelola Notifikasi              |
| Semua Pengguna | Melihat dan Mengekspor Laporan                |
| Staff Baru     | Aktivasi Akun melalui Link Undangan           |

---

## Tahap 3 — Komponen Sistem

### Aktor Sistem

| Aktor           | Deskripsi                                           |
| --------------- | --------------------------------------------------- |
| Staff Inventori | Pengelola bahan baku, produk, supplier, dan belanja |
| Staff Produksi  | Pengelola proses produksi                           |
| Kasir           | Pengelola transaksi penjualan dan shift             |
| Admin           | Pengelola sistem, pengguna, peran, dan pengaturan   |
| Staff Baru      | Pekerja baru yang belum mengaktifkan akun           |

---

### Livewire Components

| Folder        | Komponen                                                                                         | Fungsi                         |
| ------------- | ------------------------------------------------------------------------------------------------ | ------------------------------ |
| —             | `ActivateAccount`                                                                                | Aktivasi akun Staff Baru       |
| Actions/      | `Logout`                                                                                         | Proses logout                  |
| Alur/         | `Index`                                                                                          | Tampilan alur informasi        |
| Category/     | `Index`                                                                                          | Manajemen kategori produk      |
| Customer/     | `Index`, `Show`                                                                                  | Manajemen pelanggan            |
| Dashboard/    | `ExportInventori`, `ExportKasir`, `ExportProduksi`                                               | Ekspor laporan                 |
| Dashboard/    | `LaporanInventori`, `LaporanKasir`, `LaporanProduksi`                                            | Tampilan laporan               |
| Dashboard/    | `NoRole`                                                                                         | Tampilan tanpa peran           |
| Expense/      | `Form`, `Index`, `Mulai`, `Rencana`, `Rincian`, `Riwayat`                                        | Manajemen belanja bahan baku   |
| Hitung/       | `Form`, `Index`, `Mulai`, `Rencana`, `Rincian`, `Riwayat`                                        | Penghitungan stok fisik        |
| Landing/      | `Detail`, `Faq`, `Index`, `Produk`                                                               | Halaman publik                 |
| Material/     | `Form`, `Index`                                                                                  | Manajemen bahan baku           |
| Notification/ | `Index`                                                                                          | Manajemen notifikasi           |
| Peran/        | `Form`, `Index`                                                                                  | Manajemen peran dan permission |
| Product/      | `Form`, `Index`                                                                                  | Manajemen produk               |
| Production/   | `AntrianProduksi`, `Index`, `Mulai`, `MulaiSiapBeli`                                             | Manajemen produksi             |
| Production/   | `Pesanan`, `Rincian`, `RincianPesanan`, `RincianSiapBeli`, `Riwayat`, `TambahSiapBeli`           |                                |
| Setting/      | `Index`, `MyProfile`, `PaymentMethod`, `StoreProfile`                                            | Pengaturan sistem              |
| Supplier/     | `Form`, `Index`                                                                                  | Manajemen supplier             |
| Transaction/  | `BuatPesanan`, `Edit`, `Index`, `Pesanan`, `RincianPesanan`                                      | Manajemen transaksi            |
| Transaction/  | `RincianProduk`, `RincianSesi`, `Riwayat`, `RiwayatSesiPenjualan`, `SiapBeli`, `TanggalSiapBeli` |                                |
| Unit/         | `Index`                                                                                          | Manajemen satuan ukur          |
| User/         | `Form`, `Index`                                                                                  | Manajemen pekerja              |

---

### Model Laravel

| Model                    | Tabel                       | Keterangan                     |
| ------------------------ | --------------------------- | ------------------------------ |
| User                     | users                       | Pengguna sistem                |
| Category                 | categories                  | Kategori produk                |
| Unit                     | units                       | Satuan ukur                    |
| Supplier                 | suppliers                   | Pemasok bahan baku             |
| Material                 | materials                   | Bahan baku                     |
| MaterialDetail           | material_details            | Detail satuan bahan baku       |
| MaterialBatch            | material_batches            | Batch/lot bahan baku           |
| IngredientCategory       | ingredient_categories       | Kategori bahan baku            |
| IngredientCategoryDetail | ingredient_category_details | Relasi bahan baku - kategori   |
| Product                  | products                    | Produk                         |
| ProductCategory          | product_categories          | Relasi produk - kategori       |
| ProductComposition       | product_compositions        | Komposisi/resep produk         |
| TypeCost                 | type_costs                  | Jenis biaya tambahan           |
| OtherCost                | other_costs                 | Biaya tambahan produk          |
| Customer                 | customers                   | Pelanggan                      |
| Shift                    | shifts                      | Sesi penjualan kasir           |
| Transaction              | transactions                | Transaksi penjualan            |
| TransactionDetail        | transaction_details         | Detail item transaksi          |
| Payment                  | payments                    | Pembayaran transaksi           |
| PaymentChannel           | payment_channels            | Metode pembayaran              |
| Production               | productions                 | Proses produksi                |
| ProductionDetail         | production_details          | Detail item produksi           |
| ProductionWorker         | production_workers          | Pekerja yang terlibat produksi |
| Expense                  | expenses                    | Rencana belanja bahan baku     |
| ExpenseDetail            | expense_details             | Detail item belanja            |
| Notification             | notifications               | Notifikasi pengguna            |
| StoreProfile             | store_profiles              | Profil usaha                   |
| StoreDocument            | store_documents             | Dokumen legalitas usaha        |
| PointsHistory            | points_histories            | Riwayat poin pelanggan         |
| Refund                   | refunds                     | Pengembalian dana              |
| InventoryLog             | inventory_logs              | Log pergerakan stok            |
| Hitung                   | hitungs                     | Stok opname/penghitungan fisik |
| HitungDetail             | hitung_details              | Detail penghitungan stok       |
| SpatieRole               | roles                       | Peran pengguna (Spatie)        |

---

### Relasi Antar Model

```
User            1 ----< Shift              (opened_by, closed_by)
User            1 ----< Transaction        (user_id)
User            1 ----< ProductionWorker   (user_id)
User            1 ----< Notification       (user_id)
User            1 ----< Hitung             (user_id)
User            1 ----< InventoryLog       (user_id)

Category        >----< Product             (melalui product_categories)
Unit            1 ----< MaterialDetail     (unit_id)
Unit            1 ----< MaterialBatch      (unit_id)
Unit            1 ----< ExpenseDetail      (unit_id)
Unit            1 ----< ProductComposition (unit_id)
Unit            1 ----< Unit               (base_unit_id - self reference)

Supplier        1 ----< Expense            (supplier_id)
Material        1 ----< MaterialDetail     (material_id)
Material        1 ----< MaterialBatch      (material_id)
Material        1 ----< ExpenseDetail      (material_id)
Material        1 ----< ProductComposition (material_id)
Material        1 ----< IngredientCategoryDetail (material_id)
Material        1 ----< HitungDetail       (material_id)
Material        1 ----< InventoryLog       (material_id)
MaterialBatch   1 ----< HitungDetail       (material_batch_id)
MaterialBatch   1 ----< InventoryLog       (material_batch_id)
IngredientCategory 1 ----< IngredientCategoryDetail (ingredient_category_id)

Product         1 ----< ProductComposition (product_id)
Product         1 ----< OtherCost          (product_id)
Product         1 ----< TransactionDetail  (product_id)
Product         1 ----< ProductionDetail   (product_id)
TypeCost        1 ----< OtherCost          (type_cost_id)

Customer        1 ----< Transaction        (customer_id)
Customer        1 ----< PointsHistory      (phone)

Shift           1 ----< Transaction        (created_by_shift, refund_by_shift, cancelled_by_shift)
Shift           1 ----< Refund             (refund_by_shift)

Transaction     1 ----< TransactionDetail  (transaction_id)
Transaction     1 ----< Payment            (transaction_id)
Transaction     1 ----< Production         (transaction_id)
Transaction     1 ----< PointsHistory      (transaction_id)
Transaction     1 ----< Refund             (transaction_id)

Expense         1 ----< ExpenseDetail      (expense_id)
Production      1 ----< ProductionDetail   (production_id)
Production      1 ----< ProductionWorker   (production_id)

PaymentChannel  1 ----< Payment            (payment_channel_id)
PaymentChannel  1 ----< Refund             (payment_channel_id)
Hitung          1 ----< HitungDetail       (hitung_id)
```

---

## Struktur Folder Dokumentasi

```
docs-new/
├── README.md                          (file ini)
├── increment-1/
│   ├── 01-use-case.puml               Use Case Diagram Increment 1
│   ├── 02-activity-diagram.puml       Activity Diagram Increment 1
│   ├── 03-sequence-diagram.puml       Sequence Diagram Increment 1
│   ├── 04-class-diagram.puml          Class Diagram Increment 1
│   └── 05-erd.puml                    ERD Increment 1
└── increment-2/
    ├── 01-use-case.puml               Use Case Diagram Increment 2
    ├── 02-activity-diagram.puml       Activity Diagram Increment 2
    ├── 03-sequence-diagram.puml       Sequence Diagram Increment 2
    ├── 04-class-diagram.puml          Class Diagram Increment 2
    └── 05-erd.puml                    ERD Increment 2
```
