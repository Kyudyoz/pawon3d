# Dokumentasi Use Case Diagram

## Pendahuluan

Use case diagram Sistem Manajemen Toko Kue Pawon3D menggambarkan interaksi antara aktor-aktor dengan sistem. Diagram ini menunjukkan fungsionalitas sistem dari perspektif pengguna dan dikategorikan berdasarkan pembagian increment.

---

## Aktor Sistem

Sistem Pawon3D melibatkan beberapa aktor dengan hak akses berbeda:

| Aktor               | Deskripsi                                                                        |
| ------------------- | -------------------------------------------------------------------------------- |
| **Staff Inventori** | Pengguna yang mengelola data master, bahan baku, supplier, produk, dan belanja   |
| **Staff Produksi**  | Pengguna yang mengelola proses produksi                                          |
| **Kasir**           | Pengguna yang menangani transaksi penjualan                                      |
| **Admin**           | Pengguna dengan hak akses untuk mengelola pengguna, peran, dan pengaturan sistem |
| **Staff Baru**      | Pengguna yang baru diundang dan melakukan aktivasi akun                          |
| **Pengunjung**      | Pengguna umum yang mengakses landing page tanpa harus login                      |

---

## Use Case Increment 1: Modul Inti Operasional

### Staff Inventori

| ID UC | Kelompok Fitur  | Use Case Fungsional       | Deskripsi Singkat                                            |
| ----- | --------------- | ------------------------- | ------------------------------------------------------------ |
| UC-01 | **Autentikasi** | Login & Logout            | Masuk dan keluar dari sistem menggunakan email dan password  |
| UC-02 | **Data Master** | Kelola Kategori Produk    | Mengatur pengelompokan produk berdasarkan jenis              |
| UC-03 |                 | Kelola Satuan & Konversi  | Mengatur satuan ukuran bahan dan faktor konversinya          |
| UC-04 |                 | Kelola Supplier           | Mengelola data pemasok bahan baku                            |
| UC-05 | **Inventori**   | Kelola Bahan Baku         | Mengelola stok dan data teknis bahan dasar produksi          |
| UC-06 |                 | Kelola Belanja            | Merencanakan dan mencatat pembelian bahan baku dari supplier |
| UC-07 | **Produk**      | Kelola Produk & Komposisi | Mengatur produk jadi beserta resep/komposisi bahan bakunya   |

---

### Staff Produksi

| ID UC | Kelompok Fitur  | Use Case Fungsional | Deskripsi Singkat                                                         |
| ----- | --------------- | ------------------- | ------------------------------------------------------------------------- |
| UC-01 | **Autentikasi** | Login & Logout      | Autentikasi untuk mengakses modul produksi                                |
| UC-08 | **Produksi**    | Kelola Produksi     | Mengelola antrian, eksekusi produksi, dan mencatat riwayat hasil produksi |

---

### Kasir

| ID UC | Kelompok Fitur  | Use Case Fungsional          | Deskripsi Singkat                                                     |
| ----- | --------------- | ---------------------------- | --------------------------------------------------------------------- |
| UC-01 | **Autentikasi** | Login & Logout               | Autentikasi untuk mengakses modul kasir/POS                           |
| UC-09 | **Transaksi**   | Membuat Pesanan & Pembayaran | Memproses penjualan produk (Kotak, Reguler, Siap Beli) dan pembayaran |
| UC-10 | **Shift**       | Buka/Tutup Shift Kasir       | Membuka dan menutup shift kasir harian                                |

---

## Use Case Increment 2: Modul Pendukung Operasional

### Admin

| ID UC | Kelompok Fitur     | Use Case Fungsional     | Deskripsi Singkat                                      |
| ----- | ------------------ | ----------------------- | ------------------------------------------------------ |
| UC-11 | **Manajemen User** | Kelola Pengguna         | Mengundang pekerja baru dan mengelola status akun      |
| UC-12 |                    | Kelola Peran            | Mengatur hak akses pengguna berdasarkan tugasnya       |
| UC-13 | **Pengaturan**     | Profil & Pembayaran     | Mengatur identitas toko dan metode pembayaran          |
| UC-14 | **CRM**            | Kelola Pelanggan & Poin | Mengelola database pelanggan dan sistem loyalitas poin |
| UC-15 | **Laporan**        | Akses & Ekspor Laporan  | Melihat dan mengunduh laporan (PDF & Excel)            |

---

### Staff Baru

| ID UC | Kelompok Fitur | Use Case Fungsional | Deskripsi Singkat                                    |
| ----- | -------------- | ------------------- | ---------------------------------------------------- |
| UC-16 | **Aktivasi**   | Aktivasi Akun       | Mengatur password awal melalui tautan undangan email |

---

### Staff Inventori (Increment 2)

| ID UC | Kelompok Fitur   | Use Case Fungsional    | Deskripsi Singkat                                 |
| ----- | ---------------- | ---------------------- | ------------------------------------------------- |
| UC-17 | **Stock Opname** | Kelola Stock Opname    | Melakukan penghitungan stok fisik secara periodik |
| UC-18 |                  | Kelola Alur Persediaan | Memantau log perubahan stok secara rinci          |

---

### Kasir (Increment 2)

| ID UC | Kelompok Fitur | Use Case Fungsional | Deskripsi Singkat                                       |
| ----- | -------------- | ------------------- | ------------------------------------------------------- |
| UC-19 | **Loyalty**    | Penggunaan Poin     | Menggunakan saldo poin pelanggan sebagai potongan harga |
| UC-20 | **Refund**     | Proses Refund       | Membatalkan transaksi dan mengembalikan dana            |

---

### Pengunjung (Increment 2)

| ID UC | Kelompok Fitur   | Use Case Fungsional     | Deskripsi Singkat                         |
| ----- | ---------------- | ----------------------- | ----------------------------------------- |
| UC-21 | **Landing Page** | Mengakses Halaman Utama | Melihat informasi umum tentang Pawon3D    |
| UC-22 |                  | Melihat Katalog Produk  | Menelusuri daftar produk yang tersedia    |
| UC-23 |                  | Melihat Detail Produk   | Melihat informasi lengkap produk tertentu |
| UC-24 |                  | Mengakses FAQ           | Melihat pertanyaan yang sering diajukan   |

---

### Semua Pengguna Terdaftar (Increment 2)

| ID UC | Kelompok Fitur     | Use Case Fungsional   | Deskripsi Singkat                                           |
| ----- | ------------------ | --------------------- | ----------------------------------------------------------- |
| UC-25 | **Profil Pribadi** | Kelola Profil Pribadi | Melihat dan mengubah data profil pengguna yang sedang login |
| UC-26 | **Notifikasi**     | Kelola Notifikasi     | Melihat dan menandai notifikasi sistem sebagai sudah dibaca |

---

## Berkas Diagram Use Case

Diagram use case lengkap tersedia dalam format PlantUML pada berkas berikut:

-   **Combined Version**: [use-case-combined.puml](puml/use-case-combined.puml)
-   **Increment 1**: [use-case-increment-1.puml](puml/use-case-increment-1.puml)
-   **Increment 2**: [use-case-increment-2.puml](puml/use-case-increment-2.puml)

---

## Spesifikasi Use Case

### 1. Modul Increment 1 (Inti Operasional)

#### UC-01: Login ke Sistem

| Elemen                  | Deskripsi                                                                |
| ----------------------- | ------------------------------------------------------------------------ | --------------------------- |
| **Nama Use Case**       | Login ke Sistem                                                          |
| **ID Use Case**         | UC-01                                                                    |
| **Aktor**               | Semua Pengguna                                                           |
| **Deskripsi**           | Masuk ke sistem dengan email dan password                                |
| **Kondisi Awal**        | Pengguna berada di halaman login                                         |
| **Skenario Utama**      | **Aksi Aktor**                                                           | **Respon Sistem**           |
|                         | 1. Memasukkan email dan password                                         | 2. Memvalidasi kredensial   |
|                         | 3. Menekan tombol Login                                                  | 4. Membuat sesi user        |
|                         |                                                                          | 5. Mengarahkan ke Dashboard |
| **Skenario Alternatif** | Alt. 1: Login gagal karena email/password salah. Sistem tampilkan error. |
| **Kesimpulan**          | Pengguna berhasil masuk ke dashboard                                     |
| **Kondisi Akhir**       | Sesi pengguna aktif di sistem                                            |

#### UC-02: Kelola Kategori Produk

| Elemen                  | Deskripsi                                               |
| ----------------------- | ------------------------------------------------------- | ------------------------------ |
| **Nama Use Case**       | Kelola Kategori Produk                                  |
| **ID Use Case**         | UC-02                                                   |
| **Aktor**               | Staff Inventori                                         |
| **Deskripsi**           | Mengelola pengelompokan produk                          |
| **Kondisi Awal**        | Aktor berada di halaman Kategori Produk                 |
| **Skenario Utama**      | **Aksi Aktor**                                          | **Respon Sistem**              |
|                         | 1. Menambah/mengedit nama kategori                      | 2. Memvalidasi input           |
|                         | 3. Menyimpan data                                       | 4. Memperbarui daftar kategori |
| **Skenario Alternatif** | Alt. 1: Nama kategori duplikat. Sistem tampilkan error. |
| **Kesimpulan**          | Daftar kategori produk diperbarui                       |
| **Kondisi Akhir**       | Kategori baru siap digunakan pada produk                |

#### UC-03: Kelola Satuan & Konversi

| Elemen                  | Deskripsi                                                |
| ----------------------- | -------------------------------------------------------- | ----------------------------- |
| **Nama Use Case**       | Kelola Satuan & Konversi                                 |
| **ID Use Case**         | UC-03                                                    |
| **Aktor**               | Staff Inventori                                          |
| **Deskripsi**           | Mengelola unit ukuran dan faktor konversinya             |
| **Kondisi Awal**        | Aktor berada di halaman Satuan                           |
| **Skenario Utama**      | **Aksi Aktor**                                           | **Respon Sistem**             |
|                         | 1. Menentukan satuan dasar (base unit)                   | 2. Menyimpan satuan dasar     |
|                         | 3. Menambahkan satuan turunan & nilai konversi           | 4. Memvalidasi rasio konversi |
| **Skenario Alternatif** | Alt. 1: Rasio konversi nol atau negatif. Sistem menolak. |
| **Kesimpulan**          | Sistem memiliki standar konversi satuan                  |
| **Kondisi Akhir**       | Satuan siap digunakan untuk bahan baku                   |

#### UC-04: Kelola Supplier

| Elemen                  | Deskripsi                                                                  |
| ----------------------- | -------------------------------------------------------------------------- | --------------------------------- |
| **Nama Use Case**       | Kelola Supplier                                                            |
| **ID Use Case**         | UC-04                                                                      |
| **Aktor**               | Staff Inventori                                                            |
| **Deskripsi**           | Mengelola data mitra/pemasok bahan baku                                    |
| **Kondisi Awal**        | Aktor berada di halaman Supplier                                           |
| **Skenario Utama**      | **Aksi Aktor**                                                             | **Respon Sistem**                 |
|                         | 1. Memasukkan identitas supplier                                           | 2. Validasi format telepon/kontak |
|                         | 3. Menyimpan data                                                          | 4. Memperbarui daftar supplier    |
| **Skenario Alternatif** | Alt. 1: Supplier masih memiliki transaksi aktif. Sistem cegah penghapusan. |
| **Kesimpulan**          | Data master supplier diperbarui                                            |
| **Kondisi Akhir**       | Supplier siap dihubungkan dengan transaksi belanja                         |

#### UC-05: Kelola Bahan Baku

| Elemen                  | Deskripsi                                                               |
| ----------------------- | ----------------------------------------------------------------------- | ----------------------------------- |
| **Nama Use Case**       | Kelola Bahan Baku                                                       |
| **ID Use Case**         | UC-05                                                                   |
| **Aktor**               | Staff Inventori                                                         |
| **Deskripsi**           | Mengelola data teknis dan stok bahan baku dasar                         |
| **Kondisi Awal**        | Aktor berada di halaman Manajemen Bahan Baku                            |
| **Skenario Utama**      | **Aksi Aktor**                                                          | **Respon Sistem**                   |
|                         | 1. Memasukkan data bahan baku baru                                      | 2. Memvalidasi keunikan nama bahan  |
|                         | 3. Menentukan stok minimum                                              | 4. Menyimpan data ke database       |
|                         |                                                                         | 5. Menampilkan daftar bahan terbaru |
| **Skenario Alternatif** | Alt. 1: Stok bahan di bawah minimum. Sistem tampilkan status "Menipis". |
| **Kesimpulan**          | Database bahan baku diperbarui                                          |
| **Kondisi Akhir**       | Data bahan siap digunakan untuk produksi dan belanja                    |

#### UC-06: Kelola Belanja

| Elemen                  | Deskripsi                                                                   |
| ----------------------- | --------------------------------------------------------------------------- | ------------------------------------- |
| **Nama Use Case**       | Kelola Belanja                                                              |
| **ID Use Case**         | UC-06                                                                       |
| **Aktor**               | Staff Inventori                                                             |
| **Deskripsi**           | Merencanakan dan mencatat pembelian bahan baku                              |
| **Kondisi Awal**        | Aktor berada di halaman Belanja                                             |
| **Skenario Utama**      | **Aksi Aktor**                                                              | **Respon Sistem**                     |
|                         | 1. Membuat rencana belanja                                                  | 2. Generate nomor belanja otomatis    |
|                         | 3. Memasukkan item belanja                                                  | 4. Menghitung estimasi total biaya    |
|                         | 5. Input realisasi belanja fisik                                            | 6. Update stok batch dan total aktual |
| **Skenario Alternatif** | Alt. 1: Harga aktual berbeda dengan rencana. Sistem mencatat selisih biaya. |
| **Kesimpulan**          | Stok bahan fisik bertambah                                                  |
| **Kondisi Akhir**       | Transaksi belanja selesai dan stok batch tercipta                           |

#### UC-07: Kelola Produk & Komposisi

| Elemen                  | Deskripsi                                                               |
| ----------------------- | ----------------------------------------------------------------------- | ----------------------- |
| **Nama Use Case**       | Kelola Produk & Komposisi                                               |
| **ID Use Case**         | UC-07                                                                   |
| **Aktor**               | Staff Inventori                                                         |
| **Deskripsi**           | Mengatur produk jadi dan resep bahan bakunya                            |
| **Kondisi Awal**        | Aktor berada di halaman Produk                                          |
| **Skenario Utama**      | **Aksi Aktor**                                                          | **Respon Sistem**       |
|                         | 1. Memasukkan data produk & harga jual                                  | 2. Validasi input       |
|                         | 3. Menentukan komposisi bahan baku (resep)                              | 4. Menyimpan data resep |
| **Skenario Alternatif** | Alt. 1: Bahan baku yang dipilih tidak tersedia. Sistem beri peringatan. |
| **Kesimpulan**          | Produk memiliki data harga dan resep yang valid                         |
| **Kondisi Akhir**       | Produk siap diproduksi dan dijual                                       |

#### UC-08: Kelola Produksi

| Elemen                  | Deskripsi                                                                             |
| ----------------------- | ------------------------------------------------------------------------------------- | ----------------------------------------- |
| **Nama Use Case**       | Kelola Produksi                                                                       |
| **ID Use Case**         | UC-08                                                                                 |
| **Aktor**               | Staff Produksi                                                                        |
| **Deskripsi**           | Mengelola antrian pesanan, melaksanakan proses produksi, dan melihat riwayat produksi |
| **Kondisi Awal**        | Aktor berada di halaman Produksi                                                      |
| **Skenario Utama**      | **Aksi Aktor**                                                                        | **Respon Sistem**                         |
|                         | 1. Memilih pesanan yang akan diproduksi                                               | 2. Menampilkan komposisi resep bahan      |
|                         | 3. Menekan tombol "Mulai Produksi"                                                    | 4. Memotong stok bahan (FIFO)             |
|                         |                                                                                       | 5. Mengubah status menjadi "Dalam Proses" |
|                         | 6. Menekan tombol "Selesaikan Produksi"                                               | 7. Menambah stok produk jadi              |
|                         |                                                                                       | 8. Mencatat log produksi                  |
| **Skenario Alternatif** | Alt. 1: Stok bahan tidak mencukupi untuk resep. Sistem batalkan proses.               |
| **Kesimpulan**          | Stok produk jadi bertambah dalam sistem                                               |
| **Kondisi Akhir**       | Status produksi menjadi "Selesai"                                                     |

#### UC-09: Membuat Pesanan & Pembayaran (POS)

#### UC-09: Membuat Pesanan & Pembayaran (POS)

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| ----------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Membuat Pesanan & Pembayaran                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| **ID Use Case**         | UC-09                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| **Aktor**               | Kasir                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| **Deskripsi**           | Proses pencatatan transaksi penjualan produk dan pembayaran dalam satu alur terintegrasi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **Kondisi Awal**        | Shift kasir sudah dibuka (status active) dan aktor berada di halaman Transaksi (POS)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| **Skenario Utama**      | 1. Kasir memilih metode pesanan (Reguler/Kotak/Siap Beli)<br>2. Kasir memilih produk yang dipesan<br>3. Sistem menghitung total harga otomatis<br>4. Kasir klik checkout<br>5. Sistem membuat transaksi dengan status 'temp' dan redirect ke halaman buat pesanan<br>6. Kasir memasukkan data pelanggan (nama, nomor HP, alamat)<br>7. Kasir memilih: Simpan Draft atau Proses Pembayaran<br>8a. Jika Simpan Draft: Sistem simpan status 'Draft' dan selesai<br>8b. Jika Proses Pembayaran: Kasir memilih metode pembayaran (Tunai/Transfer/E-Wallet/QRIS)<br>9. Kasir memasukkan jumlah pembayaran dan upload bukti<br>10. Sistem validasi pembayaran (Siap Beli=100%, Reguler/Kotak=min 50%)<br>11. Sistem simpan data pembayaran<br>12. Sistem kurangi stok produk (khusus untuk Siap Beli)<br>13. Sistem update status transaksi (Belum Diproses atau Selesai)<br>14. Sistem kirim notifikasi dan generate struk |
| **Skenario Alternatif** | Alt. 1: Shift belum dibuka. Sistem tampilkan pesan "Silakan buka shift terlebih dahulu" dan arahkan ke menu shift.<br>Alt. 2: Stok produk tidak cukup (Siap Beli). Sistem beri peringatan.<br>Alt. 3: Pembayaran kurang dari minimum. Sistem tampilkan error sesuai aturan metode.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| **Kesimpulan**          | Transaksi berhasil dibuat dan dibayar (atau disimpan sebagai draft)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
| **Kondisi Akhir**       | Status transaksi menjadi 'Draft' (jika simpan) atau 'Belum Diproses'/'Selesai' (jika bayar)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |

#### UC-10: Buka/Tutup Shift Kasir

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| ----------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Buka/Tutup Shift Kasir                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| **ID Use Case**         | UC-10                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
| **Aktor**               | Kasir                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
| **Deskripsi**           | Membuka dan menutup shift kasir harian untuk mencatat aktivitas transaksi dan kas per shift                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| **Kondisi Awal**        | Kasir sudah login ke sistem                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| **Skenario Utama**      | 1. Kasir memulai hari kerja dan mengakses menu shift 2. Sistem cek apakah ada shift aktif yang sedang berjalan 3. Kasir klik tombol "Buka Shift" 4. Sistem generate nomor shift otomatis (increment dari shift terakhir) 5. Sistem catat waktu pembukaan shift (opened_at) dan kasir yang membuka (opened_by) 6. Sistem set status shift menjadi "active" 7. Kasir melakukan transaksi penjualan selama shift berlangsung 8. Kasir selesai bekerja dan klik tombol "Tutup Shift" 9. Sistem hitung total transaksi selama shift (jumlah transaksi, total penjualan) 10. Sistem catat waktu penutupan shift (closed_at) dan kasir yang menutup (closed_by) 11. Sistem set status shift menjadi "closed" 12. Sistem tampilkan ringkasan shift (nomor shift, durasi, total transaksi, total penjualan) 13. Kasir dapat melihat riwayat shift di halaman history |
| **Skenario Alternatif** | Alt. 1: Shift sudah aktif. Sistem tampilkan pesan "Shift sedang berjalan" dan tidak bisa buka shift baru. Alt. 2: Tidak ada shift aktif saat tutup shift. Sistem tampilkan pesan error "Tidak ada shift aktif untuk ditutup". Alt. 3: Lihat riwayat shift. Kasir dapat filter riwayat berdasarkan tanggal atau kasir tertentu.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| **Kondisi Akhir**       | Shift berhasil dibuka/ditutup dan data shift tercatat di database untuk keperluan laporan                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |

### 2. Modul Increment 2 (Pendukung Operasional)

#### UC-11: Kelola Pengguna & Undangan

| Elemen                  | Deskripsi                                                    |
| ----------------------- | ------------------------------------------------------------ | ---------------------------------------- |
| **Nama Use Case**       | Kelola Pengguna & Undangan                                   |
| **ID Use Case**         | UC-11                                                        |
| **Aktor**               | Admin                                                        |
| **Deskripsi**           | Mengelola akses pekerja melalui sistem undangan email        |
| **Kondisi Awal**        | Aktor berada di halaman Manajemen Pekerja                    |
| **Skenario Utama**      | **Aksi Aktor**                                               | **Respon Sistem**                        |
|                         | 1. Menambah email Staff Baru                                 | 2. Membuat token aktivasi unik           |
|                         | 3. Memilih peran (Role)                                      | 4. Mengirim undangan via email           |
|                         |                                                              | 5. Mencatat user dengan status "Pending" |
| **Skenario Alternatif** | Alt. 1: Email sudah terdaftar. Sistem tampilkan pesan error. |
| **Kesimpulan**          | Pekerja baru menerima akses ke sistem                        |
| **Kondisi Akhir**       | Undangan terkirim dan menunggu aktivasi                      |

#### UC-12: Kelola Peran & Hak Akses

| Elemen                  | Deskripsi                                                                                                                                |
| ----------------------- | ---------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------- |
| **Nama Use Case**       | Kelola Peran & Hak Akses                                                                                                                 |
| **ID Use Case**         | UC-12                                                                                                                                    |
| **Aktor**               | Admin                                                                                                                                    |
| **Deskripsi**           | Mengelola peran pengguna, konfigurasi hak akses (permission) per peran, dan batasan jumlah pekerja per peran                             |
| **Kondisi Awal**        | Admin login dan memiliki akses manajemen peran                                                                                           |
| **Skenario Utama**      | **Aksi Aktor**                                                                                                                           | **Respon Sistem**                                                   |
|                         | 1. Masuk ke halaman Kelola Peran                                                                                                         | 2. Menampilkan daftar peran dengan jumlah pekerja dan permissionnya |
|                         | 3. Klik "Tambah Peran Baru" atau memilih peran yang ada                                                                                  | 4. Menampilkan form peran (nama, batas pekerja, kategori akses)     |
|                         | 5. Memasukkan nama peran dan batas maksimal pekerja                                                                                      | 6. Validasi keunikan nama peran                                     |
|                         | 7. Membuka kategori akses (Kasir/Produksi/Inventori/Manajemen)                                                                           | 8. Menampilkan daftar permission dalam kategori tersebut            |
|                         | 9. Mengaktifkan toggle kategori atau memilih permission individu                                                                         | 10. Menyimpan pilihan permission secara otomatis                    |
|                         | 11. Menekan tombol Simpan                                                                                                                | 12. Sinkronisasi permission ke database (syncPermissions)           |
|                         |                                                                                                                                          | 13. Update hak akses secara realtime untuk user dengan peran ini    |
|                         |                                                                                                                                          | 14. Tampilkan notifikasi sukses                                     |
| **Skenario Alternatif** | Alt. 1: Nama peran sudah ada. Sistem tampilkan error "Nama peran sudah digunakan"                                                        |
|                         | Alt. 2: Batas pekerja kurang dari 1 atau bukan angka. Sistem tampilkan error validasi                                                    |
|                         | Alt. 3 (Hapus Peran): Admin klik hapus pada peran yang masih memiliki pekerja aktif. Sistem blokir penghapusan dan tampilkan pesan error |
|                         | Alt. 4: Admin menekan toggle kategori. Sistem otomatis pilih/hapus semua permission dalam kategori tersebut                              |
|                         | Alt. 5: Admin buka peran untuk edit. Sistem tampilkan data peran, permission terpilih, dan daftar pekerja yang menggunakan peran ini     |
| **Kesimpulan**          | Peran berhasil dibuat/diperbarui dengan konfigurasi hak akses yang sesuai                                                                |
| **Kondisi Akhir**       | Data peran tersimpan, permission tersinkron, dan perubahan berlaku langsung untuk semua pengguna dengan peran tersebut                   |

#### UC-13: Profil & Pembayaran

| Elemen                  | Deskripsi                                                    |
| ----------------------- | ------------------------------------------------------------ | ------------------------------- |
| **Nama Use Case**       | Profil & Pembayaran                                          |
| **ID Use Case**         | UC-13                                                        |
| **Aktor**               | Admin                                                        |
| **Deskripsi**           | Mengatur identitas toko dan channel pembayaran yang tersedia |
| **Kondisi Awal**        | Aktor berada di halaman Pengaturan                           |
| **Skenario Utama**      | **Aksi Aktor**                                               | **Respon Sistem**               |
|                         | 1. Update logo & nama toko                                   | 2. Update metadata toko         |
|                         | 3. Aktifkan/Matikan channel pembayaran                       | 4. Simpan pengaturan pembayaran |
| **Skenario Alternatif** | Alt. 1: Format logo tidak didukung. Sistem tolak upload.     |
| **Kesimpulan**          | Identitas toko dan metode bayar terupdate                    |
| **Kondisi Akhir**       | Perubahan muncul di struk dan halaman POS                    |

#### UC-14: Kelola Pelanggan & Poin

| Elemen                  | Deskripsi                                                          |
| ----------------------- | ------------------------------------------------------------------ | ------------------------------------- |
| **Nama Use Case**       | Kelola Pelanggan & Poin                                            |
| **ID Use Case**         | UC-14                                                              |
| **Aktor**               | Admin                                                              |
| **Deskripsi**           | Mengelola database pelanggan dan histori perolehan poin            |
| **Kondisi Awal**        | Aktor berada di halaman Manajemen Pelanggan                        |
| **Skenario Utama**      | **Aksi Aktor**                                                     | **Respon Sistem**                     |
|                         | 1. Memilih data pelanggan                                          | 2. Menampilkan riwayat poin & belanja |
|                         | 3. Melakukan koreksi poin manual                                   | 4. Mencatat log riwayat poin          |
|                         |                                                                    | 5. Menampilkan notifikasi sukses      |
| **Skenario Alternatif** | Alt. 1: Pelanggan belanja tanpa akun. Sistem sarankan pendaftaran. |
| **Kesimpulan**          | Data loyalitas pelanggan tersimpan                                 |
| **Kondisi Akhir**       | Saldo poin pelanggan diperbarui                                    |

#### UC-15: Akses & Ekspor Laporan

| Elemen                  | Deskripsi                                                                |
| ----------------------- | ------------------------------------------------------------------------ | -------------------------------------- |
| **Nama Use Case**       | Akses & Ekspor Laporan                                                   |
| **ID Use Case**         | UC-15                                                                    |
| **Aktor**               | Semua Pengguna Berizin                                                   |
| **Deskripsi**           | Melihat dan mengunduh data operasional dalam format fisik                |
| **Kondisi Awal**        | Aktor berada di halaman Laporan                                          |
| **Skenario Utama**      | **Aksi Aktor**                                                           | **Respon Sistem**                      |
|                         | 1. Memilih periode (range tanggal)                                       | 2. Melakukan query data ke database    |
|                         | 3. Melihat pratinjau data                                                | 4. Melakukan kalkulasi total/rata-rata |
|                         | 5. Memilih format (PDF/Excel)                                            | 6. Generate file dokumen otomatis      |
|                         |                                                                          | 7. Mengirim file ke browser (download) |
| **Skenario Alternatif** | Alt. 1: Data kosong pada periode terpilih. Sistem tampilkan pesan nihil. |
| **Kesimpulan**          | Laporan fisik berhasil dihasilkan                                        |
| **Kondisi Akhir**       | File laporan tersimpan di perangkat aktor                                |

#### UC-16: Aktivasi Akun

| Elemen                  | Deskripsi                                                       |
| ----------------------- | --------------------------------------------------------------- | ----------------------------------------- |
| **Nama Use Case**       | Aktivasi Akun                                                   |
| **ID Use Case**         | UC-16                                                           |
| **Aktor**               | Staff Baru                                                      |
| **Deskripsi**           | Proses aktivasi akun bagi Staff Baru melalui email              |
| **Kondisi Awal**        | Pengguna membuka tautan aktivasi dari email                     |
| **Skenario Utama**      | **Aksi Aktor**                                                  | **Respon Sistem**                         |
|                         | 1. Mengisi password baru                                        | 2. Memvalidasi kekuatan password          |
|                         | 3. Verifikasi password                                          | 4. Mengubah status user menjadi "Active"  |
|                         |                                                                 | 5. Login otomatis & redirect ke Dashboard |
| **Skenario Alternatif** | Alt. 1: Token aktivasi kedaluwarsa. Sistem minta request ulang. |
| **Kesimpulan**          | Pengguna memiliki akun aktif                                    |
| **Kondisi Akhir**       | Pengguna dapat menggunakan sistem sesuai perannya               |

#### UC-17: Stock Opname (Hitung Stok)

| Elemen                  | Deskripsi                                                       |
| ----------------------- | --------------------------------------------------------------- | ------------------------------------------- |
| **Nama Use Case**       | Stock Opname (Hitung Stok)                                      |
| **ID Use Case**         | UC-17                                                           |
| **Aktor**               | Staff Inventori                                                 |
| **Deskripsi**           | Melakukan penyesuaian stok sistem dengan stok fisik             |
| **Kondisi Awal**        | Aktor berada di halaman Hitung Stok                             |
| **Skenario Utama**      | **Aksi Aktor**                                                  | **Respon Sistem**                           |
|                         | 1. Membuat rencana hitung baru                                  | 2. Menampilkan kuantitas sistem saat ini    |
|                         | 3. Memasukkan kuantitas fisik                                   | 4. Menghitung selisih kuantitas & nilai     |
|                         | 5. Menekan "Selesaikan Hitung"                                  | 6. Melakukan koreksi stok otomatis          |
|                         |                                                                 | 7. Mencatat log penyesuaian (Inventory Log) |
| **Skenario Alternatif** | Alt. 1: Selisih terlalu besar. Sistem meminta verifikasi ulang. |
| **Kesimpulan**          | Stok sistem kembali akurat                                      |
| **Kondisi Akhir**       | Status stock opname menjadi "Selesai"                           |

#### UC-18: Kelola Alur Persediaan

| Elemen                  | Deskripsi                                                       |
| ----------------------- | --------------------------------------------------------------- | ------------------------------- |
| **Nama Use Case**       | Kelola Alur Persediaan                                          |
| **ID Use Case**         | UC-18                                                           |
| **Aktor**               | Staff Inventori                                                 |
| **Deskripsi**           | Memantau mutasi dan riwayat pergerakan stok secara detail       |
| **Kondisi Awal**        | Aktor berada di halaman Log Persediaan                          |
| **Skenario Utama**      | **Aksi Aktor**                                                  | **Respon Sistem**               |
|                         | 1. Filter data per bahan/produk                                 | 2. Menampilkan log masuk/keluar |
|                         | 3. Melihat detail referensi (ID Belanja/Produksi)               | 4. Menampilkan saldo berjalan   |
| **Skenario Alternatif** | Alt. 1: Filter tidak ditemukan. Sistem tampilkan daftar kosong. |
| **Kesimpulan**          | Transparansi mutasi barang terjamin                             |
| **Kondisi Akhir**       | Aktor memahami penyebab perubahan angka stok                    |

#### UC-19: Penggunaan Poin

| Elemen                  | Deskripsi                                                 |
| ----------------------- | --------------------------------------------------------- | ---------------------------------- |
| **Nama Use Case**       | Penggunaan Poin                                           |
| **ID Use Case**         | UC-19                                                     |
| **Aktor**               | Kasir                                                     |
| **Deskripsi**           | Penukaran poin loyalitas pelanggan menjadi diskon belanja |
| **Kondisi Awal**        | Aktor memproses transaksi pelanggan yang punya poin       |
| **Skenario Utama**      | **Aksi Aktor**                                            | **Respon Sistem**                  |
|                         | 1. Masukkan jumlah poin yang ditukar                      | 2. Konversi poin ke nominal Rupiah |
|                         | 3. Apply diskon ke total belanja                          | 4. Kurangi saldo poin pelanggan    |
| **Skenario Alternatif** | Alt. 1: Poin melebihi saldo. Sistem menolak.              |
| **Kesimpulan**          | Pelanggan mendapatkan reward potongan harga               |
| **Kondisi Akhir**       | Total bayar transaksi berkurang                           |

#### UC-20: Refund (Pengembalian Dana)

| Elemen                  | Deskripsi                                                    |
| ----------------------- | ------------------------------------------------------------ | ----------------------------------------- |
| **Nama Use Case**       | Refund (Pengembalian Dana)                                   |
| **ID Use Case**         | UC-20                                                        |
| **Aktor**               | Kasir                                                        |
| **Deskripsi**           | Membatalkan transaksi lunas dan mengembalikan dana pelanggan |
| **Kondisi Awal**        | Aktor berada di riwayat transaksi lunas                      |
| **Skenario Utama**      | **Aksi Aktor**                                               | **Respon Sistem**                         |
|                         | 1. Memilih transaksi lunas                                   | 2. Menampilkan tombol "Refund"            |
|                         | 3. Memasukkan alasan & bukti                                 | 4. Melakukan validasi total refund        |
|                         | 5. Memilih metode pengembalian                               | 6. Update status "Refunded/Canceled"      |
|                         |                                                              | 7. Mengatur stok produk kembali (restock) |
| **Skenario Alternatif** | Alt. 1: Refund melebihi total bayar. Sistem mencegah aksi.   |
| **Kesimpulan**          | Dana dikembalikan dan transaksi dibatalkan                   |
| **Kondisi Akhir**       | Data keuangan dan stok produk disesuaikan kembali            |

#### UC-21: Mengakses Halaman Utama

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| ----------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Mengakses Halaman Utama                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **ID Use Case**         | UC-21                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Aktor**               | Pengunjung                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |
| **Deskripsi**           | Pengunjung mengakses halaman utama (landing page) untuk melihat informasi toko, produk unggulan, dan informasi umum lainnya                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| **Kondisi Awal**        | Pengunjung membuka website landing page Pawon3D                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| **Skenario Utama**      | 1. Pengunjung mengakses URL landing page Pawon3D 2. Sistem menampilkan bagian Hero dengan banner toko, nama toko, tagline, dan tombol kontak WhatsApp 3. Sistem menampilkan bagian Produk Unggulan berisi 4 produk terlaris (is_recommended=true, diurutkan berdasarkan jumlah transaksi) 4. Sistem menampilkan bagian Informasi Poin Loyalitas dengan penjelasan cara mendapatkan dan menukar poin 5. Sistem menampilkan bagian Daftar Menu dengan filter metode pemesanan (Pesanan Reguler/Pesanan Kotak/Siap Saji) 6. Sistem menampilkan maksimal 10 produk dengan kolom pencarian dan tombol filter 7. Sistem menampilkan bagian Lokasi Toko berisi alamat, foto gedung, wilayah pemesanan, jam operasional, dan metode pengambilan pesanan 8. Sistem menampilkan bagian Cara Pesan dengan panduan pemesanan 9. Pengunjung dapat klik tombol WhatsApp untuk menghubungi toko 10. Pengunjung dapat klik produk untuk melihat detail produk 11. Pengunjung dapat menggunakan kolom pencarian untuk mencari produk 12. Pengunjung dapat memilih filter metode pemesanan 13. Sistem memperbarui tampilan produk sesuai filter yang dipilih 14. Pengunjung dapat klik tombol "Selengkapnya" 15. Sistem mengarahkan ke halaman katalog produk lengkap |
| **Skenario Alternatif** | Alt. 1: Tidak ada produk unggulan. Sistem tampilkan pesan "Tidak ada produk unggulan saat ini". Alt. 2: Hasil pencarian atau filter kosong. Sistem tampilkan pesan "Tidak ada produk tersedia". Alt. 3: Gambar produk tidak tersedia. Sistem tampilkan gambar default. Alt. 4: Banner atau foto gedung tidak tersedia. Sistem tampilkan gambar default. Alt. 5: Data kontak/alamat toko belum diatur. Sistem tampilkan nilai default.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Kondisi Akhir**       | Halaman utama ditampilkan lengkap dengan semua informasi toko dan pengunjung dapat berinteraksi dengan elemen-elemen di halaman                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |

#### UC-22: Melihat Katalog Produk

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| ----------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Melihat Katalog Produk                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| **ID Use Case**         | UC-23                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| **Aktor**               | Pengunjung                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| **Deskripsi**           | Pengunjung menelusuri katalog produk lengkap dengan fitur pencarian, filter metode, dan filter kategori                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
| **Kondisi Awal**        | Pengunjung berada di halaman katalog produk (/landing-produk)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| **Skenario Utama**      | 1. Pengunjung mengakses halaman katalog produk 2. Sistem menampilkan filter metode pemesanan (Pesanan Reguler/Pesanan Kotak/Siap Saji) dengan default "Pesanan Reguler" 3. Sistem menampilkan filter kategori produk dengan pilihan "Semua" dan kategori yang tersedia 4. Sistem menampilkan kolom pencarian produk 5. Sistem menampilkan 5 produk pertama dalam grid layout 6. Sistem menampilkan informasi total produk yang tersedia 7. Pengunjung dapat memilih filter metode pemesanan 8. Sistem memperbarui tampilan produk sesuai metode yang dipilih dan reset ke 5 produk pertama 9. Pengunjung dapat memilih filter kategori 10. Sistem memperbarui tampilan produk sesuai kategori yang dipilih dan reset ke 5 produk pertama 11. Pengunjung dapat mengetik di kolom pencarian 12. Sistem mencari produk berdasarkan nama secara real-time dan reset ke 5 produk pertama 13. Pengunjung dapat klik tombol "Muat Lebih Banyak" jika produk masih tersedia 14. Sistem menambah 5 produk berikutnya ke tampilan 15. Pengunjung dapat klik produk untuk melihat detail 16. Sistem mengarahkan ke halaman detail produk |
| **Skenario Alternatif** | Alt. 1: Hasil filter atau pencarian kosong. Sistem tampilkan pesan "Tidak ada produk tersedia". Alt. 2: Semua produk sudah ditampilkan. Sistem sembunyikan tombol "Muat Lebih Banyak". Alt. 3: Gambar produk tidak tersedia. Sistem tampilkan gambar default. Alt. 4: Filter parameter tersimpan di URL (query string). Sistem load halaman dengan filter yang sesuai.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| **Kondisi Akhir**       | Katalog produk ditampilkan sesuai filter dan pencarian yang dipilih, pengunjung dapat melihat dan mengakses detail produk                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |

#### UC-24: Melihat Detail Produk

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Melihat Detail Produk                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **ID Use Case**         | UC-24                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             |
| **Aktor**               | Pengunjung                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| **Deskripsi**           | Pengunjung melihat informasi lengkap produk tertentu beserta produk terkait lainnya                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Kondisi Awal**        | Pengunjung memilih produk dari halaman utama atau katalog                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| **Skenario Utama**      | 1. Pengunjung klik produk dari halaman utama atau katalog 2. Sistem load data produk dengan kategori terkait 3. Sistem menampilkan halaman detail produk dengan meta description untuk SEO 4. Sistem menampilkan tombol "Kembali" untuk kembali ke halaman sebelumnya 5. Sistem menampilkan foto produk di sisi kanan (atau gambar default jika tidak ada) 6. Sistem menampilkan nama produk dan jumlah pcs (jika ada) di sisi kiri 7. Sistem menampilkan harga produk 8. Sistem menampilkan kategori produk (jika ada) 9. Sistem menampilkan deskripsi produk (jika ada) 10. Sistem menampilkan bagian "Produk Terkait" dengan maksimal 10 produk lain secara acak 11. Pengunjung dapat klik tombol "Kembali" 12. Sistem mengarahkan ke halaman sebelumnya menggunakan browser history 13. Pengunjung dapat klik produk terkait 14. Sistem mengarahkan ke halaman detail produk terkait tersebut |
| **Skenario Alternatif** | Alt. 1: Produk tidak ditemukan. Sistem tampilkan halaman error 404. Alt. 2: Gambar produk tidak tersedia. Sistem tampilkan gambar default no-img.jpg. Alt. 3: Produk tidak memiliki kategori. Sistem sembunyikan bagian kategori. Alt. 4: Produk tidak memiliki deskripsi. Sistem sembunyikan bagian deskripsi. Alt. 5: Tidak ada produk terkait (hanya 1 produk di database). Sistem tetap tampilkan bagian kosong atau pesan.                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| **Kondisi Akhir**       | Detail produk lengkap ditampilkan kepada pengunjung beserta rekomendasi produk terkait                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |

#### UC-24: Mengakses FAQ

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                |
| ----------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Mengakses FAQ                                                                                                                                                                                                                                                                                                                                                                                                                            |
| **ID Use Case**         | UC-25                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| **Aktor**               | Pengunjung                                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Deskripsi**           | Melihat pertanyaan yang sering diajukan dan jawabannya                                                                                                                                                                                                                                                                                                                                                                                   |
| **Kondisi Awal**        | Pengunjung berada di landing page                                                                                                                                                                                                                                                                                                                                                                                                        |
| **Skenario Utama**      | 1. Mengakses halaman FAQ dari menu navigasi 2. Sistem menampilkan daftar pertanyaan dalam format accordion 3. Sistem menampilkan pertanyaan dalam keadaan collapsed (tertutup) 4. Pengunjung mengklik pertanyaan tertentu 5. Sistem expand/buka accordion dan menampilkan jawaban 6. Pengunjung dapat klik pertanyaan lain untuk melihat jawaban lainnya 7. Sistem collapse pertanyaan sebelumnya dan expand pertanyaan yang baru diklik |
| **Skenario Alternatif** | Alt. 1: Tidak ada FAQ yang tersedia. Sistem tampilkan pesan "Belum ada FAQ yang tersedia".                                                                                                                                                                                                                                                                                                                                               |
| **Kondisi Akhir**       | Pengunjung mendapatkan informasi yang dibutuhkan dari FAQ                                                                                                                                                                                                                                                                                                                                                                                |

#### UC-25: Kelola Profil Pribadi

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
| ----------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Kelola Profil Pribadi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| **ID Use Case**         | UC-25                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| **Aktor**               | Semua Pengguna Terdaftar (Admin, Inventori, Kasir, Produksi)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    |
| **Deskripsi**           | Melihat dan mengubah data profil pengguna yang sedang login                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| **Kondisi Awal**        | Pengguna sudah login ke sistem                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
| **Skenario Utama**      | 1. Mengakses halaman profil pribadi dari menu navigasi 2. Sistem menampilkan data profil pribadi (nama, email, role, foto profil) 3. Pengguna klik tombol Edit Profil 4. Sistem menampilkan form edit profil 5. Pengguna mengubah nama, email, atau upload foto profil baru 6. Sistem validasi format data (email format, foto max 2MB, ekstensi jpg/jpeg/png) 7. Pengguna menekan tombol Simpan 8. Sistem update data profil pengguna 9. Sistem tampilkan notifikasi sukses "Profil berhasil diperbarui" 10. Sistem refresh halaman profil dengan data terbaru |
| **Skenario Alternatif** | Alt. 1: Email sudah digunakan pengguna lain. Sistem tampilkan error "Email sudah terdaftar". Alt. 2 (Ubah Password): Pengguna klik "Ubah Password". Sistem tampilkan form password lama, password baru, konfirmasi password. Sistem validasi password lama cocok dengan database. Sistem validasi password baru minimal 8 karakter dengan kombinasi huruf dan angka. Sistem update password dan tampilkan notifikasi sukses. Alt. 3: Format foto tidak didukung atau melebihi 2MB. Sistem tolak upload dan tampilkan error validasi.                            |
| **Kondisi Akhir**       | Data profil pengguna berhasil diperbarui dan tersimpan di database                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |

#### UC-26: Kelola Notifikasi

| Elemen                  | Deskripsi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Nama Use Case**       | Kelola Notifikasi                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| **ID Use Case**         | UC-26                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| **Aktor**               | Semua Pengguna Terdaftar (Admin, Inventori, Kasir, Produksi)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| **Deskripsi**           | Melihat dan menandai notifikasi sistem sebagai sudah dibaca                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| **Kondisi Awal**        | Pengguna sudah login ke sistem                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| **Skenario Utama**      | 1. Sistem menampilkan badge counter notifikasi yang belum dibaca di navbar 2. Pengguna klik icon notifikasi di navbar 3. Sistem menampilkan dropdown daftar notifikasi (maksimal 5 terbaru) 4. Sistem menampilkan notifikasi dengan informasi judul, pesan, waktu, dan status baca 5. Pengguna mengklik notifikasi tertentu 6. Sistem menandai notifikasi sebagai dibaca (read_at diisi timestamp) 7. Sistem update badge counter notifikasi (kurangi 1) 8. Sistem redirect ke halaman terkait notifikasi (jika ada link) 9. Pengguna dapat klik "Lihat Semua" untuk ke halaman daftar notifikasi lengkap 10. Sistem menampilkan semua notifikasi dengan pagination |
| **Skenario Alternatif** | Alt. 1: Tidak ada notifikasi. Sistem tampilkan pesan "Belum ada notifikasi". Alt. 2 (Mark All as Read): Pengguna klik "Tandai Semua Sudah Dibaca". Sistem update semua notifikasi belum dibaca menjadi dibaca. Sistem reset badge counter menjadi 0. Alt. 3: Notifikasi sudah dibaca sebelumnya. Sistem tetap tampilkan notifikasi dengan visual yang berbeda (opacity lebih rendah atau warna berbeda).                                                                                                                                                                                                                                                            |
| **Kondisi Akhir**       | Status notifikasi diperbarui dan badge counter notifikasi diupdate                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |

---

## Kesimpulan

Use case diagram Sistem Pawon3D dikelompokkan berdasarkan fungsionalitas utama dengan spesifikasi terstruktur untuk memudahkan pemetaan alur kerja sistem secara bertahap (incremental).
