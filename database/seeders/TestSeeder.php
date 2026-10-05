<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseDetail;
use App\Models\Hitung;
use App\Models\HitungDetail;
use App\Models\IngredientCategory;
use App\Models\IngredientCategoryDetail;
use App\Models\InventoryLog;
use App\Models\Material;
use App\Models\MaterialBatch;
use App\Models\MaterialDetail;
use App\Models\Notification;
use App\Models\OtherCost;
use App\Models\PaymentChannel;
use App\Models\PointsHistory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductComposition;
use App\Models\Production;
use App\Models\ProductionDetail;
use App\Models\Shift;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TypeCost;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * TestSeeder — Data pendukung pengujian fungsional Black Box Testing (184 Test Case)
 *
 * Coverage modul:
 *   - Increment 1: Login/Logout, Kategori, Satuan, Supplier, Bahan Baku, Belanja, Produk, Produksi, Kasir
 *   - Increment 2: Admin, Aktivasi Akun, Hitung, Alur Persediaan, Poin, Laporan
 *
 * Aman dijalankan berulang (idempotent via firstOrCreate/updateOrCreate).
 */
class TestSeeder extends Seeder
{
    public function run(): void
    {
        // ─────────────────────────────────────────────────────────────────────
        // 1. PERMISSIONS — pastikan semua permission tersedia
        // ─────────────────────────────────────────────────────────────────────
        $permissionNames = [
            'manajemen.pekerja.kelola',
            'manajemen.peran.kelola',
            'manajemen.pelanggan.kelola',
            'manajemen.profil_usaha.kelola',
            'manajemen.pembayaran.kelola',
            'inventori.produk.kelola',
            'inventori.persediaan.kelola',
            'inventori.belanja.rencana.kelola',
            'inventori.toko.kelola',
            'inventori.belanja.mulai',
            'inventori.hitung.kelola',
            'inventori.alur.lihat',
            'inventori.laporan.kelola',
            'kasir.pesanan.kelola',
            'kasir.laporan.kelola',
            'produksi.rencana.kelola',
            'produksi.mulai',
            'produksi.laporan.kelola',
        ];

        foreach ($permissionNames as $name) {
            Permission::firstOrCreate(['name' => $name, 'guard_name' => 'web']);
        }

        // ─────────────────────────────────────────────────────────────────────
        // 2. ROLES — TC-097..TC-102 (Admin), TC-092 (batas max_users)
        // ─────────────────────────────────────────────────────────────────────
        $allPerms = $permissionNames;

        $roleManajemen = Role::firstOrCreate(['name' => 'Manajemen Sistem']);
        $roleManajemen->syncPermissions($allPerms);

        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleAdmin->syncPermissions($allPerms);

        // TC-092: Kasir sudah dibatasi max 3 pengguna agar bisa diuji batas maksimal
        $roleKasir = Role::firstOrCreate(['name' => 'Kasir']);
        $roleKasir->syncPermissions(['kasir.pesanan.kelola', 'kasir.laporan.kelola']);
        $roleKasir->update(['max_users' => 3]);

        $roleProduksi = Role::firstOrCreate(['name' => 'Produksi']);
        $roleProduksi->syncPermissions(['produksi.rencana.kelola', 'produksi.mulai', 'produksi.laporan.kelola']);

        $roleInventori = Role::firstOrCreate(['name' => 'Inventori']);
        $roleInventori->syncPermissions([
            'inventori.produk.kelola',
            'inventori.persediaan.kelola',
            'inventori.belanja.rencana.kelola',
            'inventori.toko.kelola',
            'inventori.belanja.mulai',
            'inventori.hitung.kelola',
            'inventori.alur.lihat',
            'inventori.laporan.kelola',
        ]);

        // TC-098, TC-100, TC-101, TC-102: Peran Supervisor untuk pengujian peran
        $roleSupervisor = Role::firstOrCreate(['name' => 'Supervisor']);
        $roleSupervisor->syncPermissions(['kasir.pesanan.kelola', 'kasir.laporan.kelola']);
        $roleSupervisor->update(['max_users' => 2]);

        // ─────────────────────────────────────────────────────────────────────
        // 3. USERS
        // ─────────────────────────────────────────────────────────────────────

        // TC-001, TC-003, TC-006, TC-007: Inventori aktif
        $userInventori = User::firstOrCreate(
            ['email' => 'inventori@pawon3d.com'],
            [
                'name' => 'Staff Inventori',
                'phone' => '081100001100',
                'password' => Hash::make('Password1'),
                'gender' => 'Laki-laki',
                'is_active' => true,
                'activated_at' => now(),
            ]
        );
        $userInventori->syncRoles(['Inventori']);

        // TC-052, TC-053: Produksi aktif
        $userProduksi = User::firstOrCreate(
            ['email' => 'produksi@pawon3d.com'],
            [
                'name' => 'Staff Produksi',
                'phone' => '081100002200',
                'password' => Hash::make('Password1'),
                'gender' => 'Perempuan',
                'is_active' => true,
                'activated_at' => now(),
            ]
        );
        $userProduksi->syncRoles(['Produksi']);

        // TC-065, TC-066: Kasir aktif
        $userKasir = User::firstOrCreate(
            ['email' => 'kasir@pawon3d.com'],
            [
                'name' => 'Bagian Kasir',
                'phone' => '081100003300',
                'password' => Hash::make('Password1'),
                'gender' => 'Perempuan',
                'is_active' => true,
                'activated_at' => now(),
            ]
        );
        $userKasir->syncRoles(['Kasir']);

        // TC-083, TC-084, TC-085..TC-130: Admin aktif
        $userAdmin = User::firstOrCreate(
            ['email' => 'pawon3d@gmail.com'],
            [
                'name' => 'Admin Pawon3D',
                'phone' => '081100004400',
                'password' => Hash::make('Password1'),
                'gender' => 'Laki-laki',
                'is_active' => true,
                'activated_at' => now(),
            ]
        );
        $userAdmin->syncRoles(['Admin']);

        // TC-004: Akun belum diaktifkan (activated_at = null, is_active = false)
        // Pre-condition: "akun belum melakukan aktivasi (activated_at = null)"
        $userBelumAktif = User::firstOrCreate(
            ['email' => 'belumaktif@pawon3d.com'],
            [
                'name' => 'User Belum Aktif',
                'phone' => '081100005500',
                'password' => Hash::make('Password1'),
                'gender' => 'Laki-laki',
                'is_active' => false,
                'activated_at' => null,
                'invitation_token' => hash('sha256', 'belumaktif-token-valid-01'),
                'invitation_sent_at' => now()->subHours(12),
            ]
        );
        $userBelumAktif->syncRoles(['Kasir']);

        // TC-005: Akun dinonaktifkan (is_active = false, sudah pernah aktif)
        // Pre-condition: "akun sudah dinonaktifkan oleh admin (is_active = false)"
        $userNonaktif = User::firstOrCreate(
            ['email' => 'nonaktif@pawon3d.com'],
            [
                'name' => 'User Nonaktif',
                'phone' => '081100006600',
                'password' => Hash::make('Password1'),
                'gender' => 'Laki-laki',
                'is_active' => false,
                'activated_at' => now()->subDays(30),
            ]
        );
        $userNonaktif->syncRoles(['Kasir']);

        // TC-086, TC-093, TC-094, TC-095, TC-096: Ahmad Fauzi sudah aktif
        $userFauzi = User::firstOrCreate(
            ['email' => 'fauzi@pawon3d.com'],
            [
                'name' => 'Ahmad Fauzi',
                'phone' => '081234567891',
                'password' => Hash::make('Password1'),
                'gender' => 'Laki-laki',
                'is_active' => true,
                'activated_at' => now()->subDays(5),
            ]
        );
        $userFauzi->syncRoles(['Kasir']);

        // TC-131: Token valid — akun belum aktif dengan invitation_token yang masih berlaku
        $tokenValid = hash('sha256', 'invitation-valid-token-2026');
        $userTokenValid = User::firstOrCreate(
            ['email' => 'pekerja-baru@pawon3d.com'],
            [
                'name' => 'Pekerja Baru',
                'phone' => '089100001111',
                'password' => Hash::make('Password1'),
                'gender' => 'Laki-laki',
                'is_active' => false,
                'activated_at' => null,
                'invitation_token' => $tokenValid,
                'invitation_sent_at' => now()->subHour(),
            ]
        );
        $userTokenValid->syncRoles(['Kasir']);

        // TC-133: Token kedaluwarsa (invitation_sent_at > 72 jam lalu)
        $tokenExpired = hash('sha256', 'invitation-expired-token-2026');
        $userTokenExpired = User::firstOrCreate(
            ['email' => 'pekerja-expired@pawon3d.com'],
            [
                'name' => 'Pekerja Expired',
                'phone' => '089100002222',
                'password' => Hash::make('Password1'),
                'gender' => 'Perempuan',
                'is_active' => false,
                'activated_at' => null,
                'invitation_token' => $tokenExpired,
                'invitation_sent_at' => now()->subDays(5),
            ]
        );
        $userTokenExpired->syncRoles(['Kasir']);

        // TC-134: Token valid tapi akun sudah aktif (re-activation blocked)
        $tokenSudahAktif = hash('sha256', 'invitation-already-active-token-2026');
        $userSudahAktif = User::firstOrCreate(
            ['email' => 'sudah-aktif@pawon3d.com'],
            [
                'name' => 'Sudah Aktif Worker',
                'phone' => '089100003333',
                'password' => Hash::make('Rahasia123'),
                'gender' => 'Laki-laki',
                'is_active' => true,
                'activated_at' => now()->subDays(2),
                'invitation_token' => $tokenSudahAktif,
                'invitation_sent_at' => now()->subDays(3),
            ]
        );
        $userSudahAktif->syncRoles(['Kasir']);

        // ─────────────────────────────────────────────────────────────────────
        // 4. STORE PROFILE — TC-103, TC-104, TC-105, TC-106
        // Update profil yang sudah ada (dari DatabaseSeeder), atau buat baru jika belum ada
        // ─────────────────────────────────────────────────────────────────────
        $storeProfile = \App\Models\StoreProfile::first();
        $storeProfileData = [
            'name' => 'Pawon3D Bakery',
            'tagline' => 'Kue Berkualitas Terbaik',
            'type' => 'Bakery',
            'address' => 'Jl. Merdeka No. 10',
            'contact' => '081234567890',
            'email' => 'info@pawon3d.com',
            'website' => 'https://pawon3d.com',
            'social_instagram' => 'pawon3d',
            'social_facebook' => 'pawon3d',
            'social_whatsapp' => '081234567890',
        ];
        if ($storeProfile) {
            $storeProfile->update($storeProfileData);
        } else {
            \App\Models\StoreProfile::create($storeProfileData);
        }

        // ─────────────────────────────────────────────────────────────────────
        // 5. CATEGORIES — TC-008..TC-015
        // TC-012: "Kue Basah" harus sudah ada saat menguji duplikat nama
        // TC-014: "Kue Kering" harus sudah ada sebagai kategori lain
        // ─────────────────────────────────────────────────────────────────────
        $catKueBasah = Category::firstOrCreate(
            ['name' => 'Kue Basah'],
            ['is_active' => true]
        );

        $catKueKering = Category::firstOrCreate(
            ['name' => 'Kue Kering'],
            ['is_active' => true]
        );

        // Kategori tambahan untuk variasi data laporan
        Category::firstOrCreate(
            ['name' => 'Minuman'],
            ['is_active' => true]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 6. INGREDIENT CATEGORIES
        // ─────────────────────────────────────────────────────────────────────
        $icBahanKering = IngredientCategory::firstOrCreate(
            ['name' => 'Bahan Kering'],
            ['is_active' => true]
        );

        $icBahanHalus = IngredientCategory::firstOrCreate(
            ['name' => 'Bahan Halus'],
            ['is_active' => true]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 7. UNITS — TC-016..TC-023
        // TC-017: Kilogram harus bisa ditambah sebagai satuan dasar
        // TC-019: Kilogram harus sudah ada untuk uji duplikat
        // TC-021: Gram sebagai satuan turunan Kilogram
        // TC-022: satuan dasar tersedia → uji faktor konversi kosong
        // TC-023: Kilogram harus digunakan oleh >= 3 bahan baku (material_details)
        // ─────────────────────────────────────────────────────────────────────
        $unitKg = Unit::firstOrCreate(
            ['name' => 'Kilogram'],
            [
                'alias' => 'kg',
                'group' => 'Massa',
                'base_unit_id' => null,
                'conversion_factor' => 1,
            ]
        );

        $unitGram = Unit::firstOrCreate(
            ['name' => 'Gram'],
            [
                'alias' => 'g',
                'group' => 'Massa',
                'base_unit_id' => $unitKg->id,
                'conversion_factor' => 0.001,
            ]
        );

        $unitLiter = Unit::firstOrCreate(
            ['name' => 'Liter'],
            [
                'alias' => 'L',
                'group' => 'Volume',
                'base_unit_id' => null,
                'conversion_factor' => 1,
            ]
        );

        $unitMl = Unit::firstOrCreate(
            ['name' => 'Mililiter'],
            [
                'alias' => 'ml',
                'group' => 'Volume',
                'base_unit_id' => $unitLiter->id,
                'conversion_factor' => 0.001,
            ]
        );

        $unitPcs = Unit::firstOrCreate(
            ['name' => 'Pcs'],
            [
                'alias' => 'pcs',
                'group' => 'Jumlah',
                'base_unit_id' => null,
                'conversion_factor' => 1,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 8. SUPPLIERS — TC-024..TC-029, TC-036..TC-038
        // ─────────────────────────────────────────────────────────────────────
        $supplier = Supplier::firstOrCreate(
            ['name' => 'Toko Bahan Kue Makmur'],
            [
                'contact_name' => 'Pak Budi',
                'phone' => '081234567890',
                'street' => 'Jl. Pasar Baru No. 5',
                'maps_link' => 'https://maps.google.com/abc',
                'description' => 'Supplier bahan kue terpercaya',
            ]
        );

        $supplier2 = Supplier::firstOrCreate(
            ['name' => 'Toko Bahan Kue Sentosa'],
            [
                'contact_name' => 'Bu Dewi',
                'phone' => '089876543210',
                'street' => 'Jl. Sentosa No. 12',
                'description' => 'Supplier bahan alternatif',
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 9. MATERIALS + MATERIAL DETAILS — TC-030..TC-034
        // Tepung  : stok 10 kg (cukup untuk produksi)
        // Gula    : stok 5 kg
        // Coklat  : batch kecil 0.1 kg (TC-058 bahan tidak cukup) + batch besar 5 kg
        // Mentega : agar Kilogram dipakai >= 3 bahan baku (TC-023)
        // ─────────────────────────────────────────────────────────────────────
        $matTepung = Material::firstOrCreate(
            ['name' => 'Tepung Terigu'],
            [
                'description' => 'Bahan dasar kue',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 5,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matTepung->id, 'is_main' => true],
            [
                'unit_id' => $unitKg->id,
                'quantity' => 1,
                'supply_quantity' => 10,
                'supply_price' => 15000,
            ]
        );

        $matGula = Material::firstOrCreate(
            ['name' => 'Gula Pasir'],
            [
                'description' => 'Pemanis kue',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 3,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matGula->id, 'is_main' => true],
            [
                'unit_id' => $unitKg->id,
                'quantity' => 1,
                'supply_quantity' => 5,
                'supply_price' => 18000,
            ]
        );

        $matCoklat = Material::firstOrCreate(
            ['name' => 'Coklat Bubuk'],
            [
                'description' => 'Coklat bubuk premium',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 1,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matCoklat->id, 'is_main' => true],
            [
                'unit_id' => $unitKg->id,
                'quantity' => 1,
                'supply_quantity' => 5,
                'supply_price' => 35000,
            ]
        );

        // TC-023: Kilogram harus dipakai oleh >= 3 bahan baku
        $matMentega = Material::firstOrCreate(
            ['name' => 'Mentega'],
            [
                'description' => 'Lemak hewani untuk kue',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 1,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matMentega->id, 'is_main' => true],
            [
                'unit_id' => $unitKg->id,
                'quantity' => 1,
                'supply_quantity' => 3,
                'supply_price' => 25000,
            ]
        );

        // Bahan ke-5 untuk pengujian variasi
        $matTelur = Material::firstOrCreate(
            ['name' => 'Telur Ayam'],
            [
                'description' => 'Bahan pengikat',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 12,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matTelur->id, 'is_main' => true],
            [
                'unit_id' => $unitPcs->id,
                'quantity' => 1,
                'supply_quantity' => 30,
                'supply_price' => 2500,
            ]
        );

        $matKeju = Material::firstOrCreate(
            ['name' => 'Keju Cheddar'],
            [
                'description' => 'Keju untuk topping dan adonan',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 1,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matKeju->id, 'is_main' => true],
            [
                'unit_id' => $unitKg->id,
                'quantity' => 1,
                'supply_quantity' => 2,
                'supply_price' => 90000,
            ]
        );

        $matSusu = Material::firstOrCreate(
            ['name' => 'Susu Cair'],
            [
                'description' => 'Susu cair full cream',
                'status' => 'Kosong',
                'is_active' => true,
                'minimum' => 2,
            ]
        );
        MaterialDetail::firstOrCreate(
            ['material_id' => $matSusu->id, 'is_main' => true],
            [
                'unit_id' => $unitLiter->id,
                'quantity' => 1,
                'supply_quantity' => 6,
                'supply_price' => 18000,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 10. INGREDIENT CATEGORY DETAILS
        // ─────────────────────────────────────────────────────────────────────
        IngredientCategoryDetail::firstOrCreate(
            ['ingredient_category_id' => $icBahanKering->id, 'material_id' => $matTepung->id]
        );
        IngredientCategoryDetail::firstOrCreate(
            ['ingredient_category_id' => $icBahanKering->id, 'material_id' => $matGula->id]
        );
        IngredientCategoryDetail::firstOrCreate(
            ['ingredient_category_id' => $icBahanHalus->id, 'material_id' => $matCoklat->id]
        );
        IngredientCategoryDetail::firstOrCreate(
            ['ingredient_category_id' => $icBahanHalus->id, 'material_id' => $matKeju->id]
        );
        IngredientCategoryDetail::firstOrCreate(
            ['ingredient_category_id' => $icBahanHalus->id, 'material_id' => $matSusu->id]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 11. MATERIAL BATCHES — TC-040, TC-057, TC-058, TC-140, TC-145, TC-147
        // batch B-TF-01 : Tepung 10 kg          → cukup untuk produksi
        // batch B-GP-01 : Gula 5 kg             → cukup
        // batch B-CK-01 : Coklat 0.1 kg         → TC-058 tidak cukup (butuh 0.2 kg)
        // batch B-CK-02 : Coklat 5 kg           → normal
        // ─────────────────────────────────────────────────────────────────────
        $batchTepung = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-TF-260101'],
            [
                'material_id' => $matTepung->id,
                'unit_id' => $unitKg->id,
                'date' => now()->subDays(30),
                'batch_quantity' => 10,
            ]
        );

        $batchGula = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-GP-260101'],
            [
                'material_id' => $matGula->id,
                'unit_id' => $unitKg->id,
                'date' => now()->subDays(30),
                'batch_quantity' => 5,
            ]
        );

        // TC-058: Batch coklat kecil (0.1 kg) — tidak cukup untuk resep 0.2 kg
        $batchCoklatKecil = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-CK-260101-KECIL'],
            [
                'material_id' => $matCoklat->id,
                'unit_id' => $unitKg->id,
                'date' => now()->subDays(30),
                'batch_quantity' => 0.10,
            ]
        );

        // Batch coklat besar untuk produksi normal (TC-057, TC-060)
        $batchCoklatBesar = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-CK-260101-BESAR'],
            [
                'material_id' => $matCoklat->id,
                'unit_id' => $unitKg->id,
                'date' => now()->subDays(30),
                'batch_quantity' => 5,
            ]
        );

        $batchMentega = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-MT-260101'],
            [
                'material_id' => $matMentega->id,
                'unit_id' => $unitKg->id,
                'date' => now()->subDays(25),
                'batch_quantity' => 3,
            ]
        );

        $batchKeju = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-KJ-260101'],
            [
                'material_id' => $matKeju->id,
                'unit_id' => $unitKg->id,
                'date' => now()->subDays(20),
                'batch_quantity' => 2,
            ]
        );

        $batchSusu = MaterialBatch::firstOrCreate(
            ['batch_number' => 'B-SS-260101'],
            [
                'material_id' => $matSusu->id,
                'unit_id' => $unitLiter->id,
                'date' => now()->subDays(10),
                'batch_quantity' => 6,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 12. TYPE COSTS — TC-050
        // ─────────────────────────────────────────────────────────────────────
        $typeCostKemasan = TypeCost::firstOrCreate(['name' => 'Kemasan']);
        TypeCost::firstOrCreate(['name' => 'Gas']);
        TypeCost::firstOrCreate(['name' => 'Listrik']);

        // ─────────────────────────────────────────────────────────────────────
        // 13. PRODUCTS + COMPOSITIONS + OTHER COSTS — TC-044..TC-051
        // TC-071: produk siap-beli dengan stok tersedia
        // TC-072: Kue Lapis stok = 0 (siap-beli stok habis)
        // TC-069: pesanan-kotak
        // TC-070: pesanan-reguler
        // ─────────────────────────────────────────────────────────────────────

        // Brownies Coklat — metode: pesanan-reguler + siap-beli, stok ada
        $prodBrownies = Product::firstOrCreate(
            ['name' => 'Brownies Coklat'],
            [
                'description' => 'Brownies coklat lembut premium',
                'price' => 120000,
                'stock' => 5,
                'method' => ['pesanan-reguler', 'siap-beli'],
                'is_active' => true,
                'is_recipe' => true,
                'pcs' => 8,
                'pcs_capital' => 15000,
                'capital' => 120000,
            ]
        );
        ProductCategory::firstOrCreate(
            ['product_id' => $prodBrownies->id, 'category_id' => $catKueBasah->id]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodBrownies->id, 'material_id' => $matTepung->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.50]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodBrownies->id, 'material_id' => $matCoklat->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.20]
        );
        // TC-050: biaya tambahan Kemasan pada Brownies Coklat
        OtherCost::firstOrCreate(
            ['product_id' => $prodBrownies->id, 'type_cost_id' => $typeCostKemasan->id],
            ['price' => 5000]
        );

        // Kue Lapis — metode: pesanan-reguler + pesanan-kotak, STOK = 0 untuk TC-072
        $prodKueLapis = Product::firstOrCreate(
            ['name' => 'Kue Lapis'],
            [
                'description' => 'Kue lapis pelangi tradisional',
                'price' => 50000,
                'stock' => 0,
                'method' => ['pesanan-reguler', 'pesanan-kotak'],
                'is_active' => true,
                'is_recipe' => true,
                'pcs' => 1,
                'pcs_capital' => 45000,
                'capital' => 45000,
            ]
        );
        ProductCategory::firstOrCreate(
            ['product_id' => $prodKueLapis->id, 'category_id' => $catKueBasah->id]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodKueLapis->id, 'material_id' => $matTepung->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.30]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodKueLapis->id, 'material_id' => $matGula->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.20]
        );

        // Donat Gula — siap-beli, stok ada (TC-071)
        $prodDonat = Product::firstOrCreate(
            ['name' => 'Donat Gula'],
            [
                'description' => 'Donat gula empuk',
                'price' => 30000,
                'stock' => 10,
                'method' => ['siap-beli'],
                'is_active' => true,
                'is_recipe' => true,
                'pcs' => 6,
                'pcs_capital' => 22000,
                'capital' => 22000,
            ]
        );
        ProductCategory::firstOrCreate(
            ['product_id' => $prodDonat->id, 'category_id' => $catKueKering->id]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodDonat->id, 'material_id' => $matTepung->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.20]
        );

        // Bolu Keju — metode: pesanan-reguler + siap-beli, stok tersedia
        $prodBoluKeju = Product::firstOrCreate(
            ['name' => 'Bolu Keju'],
            [
                'description' => 'Bolu lembut dengan topping keju cheddar',
                'price' => 95000,
                'stock' => 6,
                'method' => ['pesanan-reguler', 'siap-beli'],
                'is_active' => true,
                'is_recipe' => true,
                'pcs' => 10,
                'pcs_capital' => 9500,
                'capital' => 95000,
            ]
        );
        ProductCategory::firstOrCreate(
            ['product_id' => $prodBoluKeju->id, 'category_id' => $catKueKering->id]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodBoluKeju->id, 'material_id' => $matTepung->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.40]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodBoluKeju->id, 'material_id' => $matGula->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.15]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodBoluKeju->id, 'material_id' => $matTelur->id],
            ['unit_id' => $unitPcs->id, 'material_quantity' => 8]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodBoluKeju->id, 'material_id' => $matKeju->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.25]
        );

        // Puding Susu — metode: siap-beli + pesanan-kotak
        $prodPudingSusu = Product::firstOrCreate(
            ['name' => 'Puding Susu'],
            [
                'description' => 'Puding susu segar dengan tekstur lembut',
                'price' => 25000,
                'stock' => 12,
                'method' => ['siap-beli', 'pesanan-kotak'],
                'is_active' => true,
                'is_recipe' => true,
                'pcs' => 6,
                'pcs_capital' => 4000,
                'capital' => 24000,
            ]
        );
        ProductCategory::firstOrCreate(
            ['product_id' => $prodPudingSusu->id, 'category_id' => $catKueBasah->id]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodPudingSusu->id, 'material_id' => $matSusu->id],
            ['unit_id' => $unitLiter->id, 'material_quantity' => 1]
        );
        ProductComposition::firstOrCreate(
            ['product_id' => $prodPudingSusu->id, 'material_id' => $matGula->id],
            ['unit_id' => $unitKg->id, 'material_quantity' => 0.10]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 14. PAYMENT CHANNELS — TC-107..TC-111
        // ─────────────────────────────────────────────────────────────────────
        PaymentChannel::firstOrCreate(
            ['bank_name' => 'BCA'],
            [
                'type' => 'transfer',
                'account_number' => '1234567890',
                'account_name' => 'Pawon3D BCA',
                'is_active' => true,
            ]
        );
        PaymentChannel::firstOrCreate(
            ['bank_name' => 'QRIS Pawon3D'],
            [
                'type' => 'qris',
                'is_active' => false,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 15. CUSTOMERS — TC-074, TC-112..TC-118, TC-162..TC-164
        // Ibu Sari: poin = 50 (TC-162: gunakan 30 poin, TC-164: coba lebih dari 50 → error)
        // ─────────────────────────────────────────────────────────────────────
        $customer = Customer::firstOrCreate(
            ['phone' => '081234567890'],
            [
                'name' => 'Ibu Sari',
                'points' => 50,
            ]
        );

        Customer::firstOrCreate(
            ['phone' => '089001112222'],
            ['name' => 'Pak Rudi', 'points' => 0]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 16. SHIFTS — TC-067, TC-068, TC-082
        // shift aktif: untuk kasir membuka shift
        // shift tutup: untuk laporan historis
        // ─────────────────────────────────────────────────────────────────────
        $shiftClosed = Shift::firstOrCreate(
            ['shift_number' => 'SHF-260121-0001'],
            [
                'opened_by' => $userKasir->id,
                'closed_by' => $userKasir->id,
                'start_time' => now()->subDays(30)->setHour(8)->setMinute(0)->setSecond(0),
                'end_time' => now()->subDays(30)->setHour(21)->setMinute(0)->setSecond(0),
                'status' => 'closed',
                'initial_cash' => 300000,
                'final_cash' => 1800000,
                'total_sales' => 1500000,
                'total_refunds' => 0,
                'total_discounts' => 0,
            ]
        );

        $shiftAktif = Shift::firstOrCreate(
            ['shift_number' => 'SHF-260224-0001'],
            [
                'opened_by' => $userKasir->id,
                'start_time' => now()->subHours(3),
                'status' => 'open',
                'initial_cash' => 500000,
                'final_cash' => 0,
                'total_sales' => 1500000,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 17. TRANSACTIONS — TC-069..TC-082, TC-080, TC-081
        // OR = pesanan-reguler, OK = pesanan-kotak, OS = siap-beli
        // ─────────────────────────────────────────────────────────────────────

        // Transaksi pesanan-reguler selesai — TC-080 (cetak struk), TC-081 (riwayat)
        $trxSelesai = Transaction::firstOrCreate(
            [
                'customer_id' => $customer->id,
                'method' => 'pesanan-reguler',
                'status' => 'selesai',
                'start_date' => now()->subDays(5)->toDateString(),
            ],
            [
                'user_id' => $userKasir->id,
                'name' => 'Ibu Sari',
                'phone' => '081234567890',
                'date' => now()->subDays(3)->toDateString(),
                'time' => '10:00:00',
                'end_date' => now()->subDays(3)->toDateString(),
                'payment_status' => 'lunas',
                'total_amount' => 240000,
                'created_by_shift' => $shiftClosed->id,
            ]
        );
        TransactionDetail::firstOrCreate(
            ['transaction_id' => $trxSelesai->id, 'product_id' => $prodBrownies->id],
            ['quantity' => 2, 'price' => 120000]
        );

        // Transaksi pesanan-kotak belum-diproses — sumber produksi TC-056..TC-059
        $trxKotak = Transaction::firstOrCreate(
            [
                'method' => 'pesanan-kotak',
                'status' => 'belum-diproses',
                'start_date' => now()->subDays(16)->toDateString(),
            ],
            [
                'user_id' => $userKasir->id,
                'name' => 'Pak Bawono',
                'phone' => '082233445566',
                'date' => now()->subDays(14)->toDateString(),
                'time' => '14:00:00',
                'end_date' => now()->subDays(14)->toDateString(),
                'payment_status' => 'dp',
                'total_amount' => 240000,
                'created_by_shift' => $shiftClosed->id,
            ]
        );
        TransactionDetail::firstOrCreate(
            ['transaction_id' => $trxKotak->id, 'product_id' => $prodBrownies->id],
            ['quantity' => 2, 'price' => 120000]
        );

        // Transaksi siap-beli selesai — TC-071 support
        $trxSiapBeli = Transaction::firstOrCreate(
            [
                'method' => 'siap-beli',
                'status' => 'selesai',
                'date' => now()->subDays(9)->toDateString(),
            ],
            [
                'user_id' => $userKasir->id,
                'customer_id' => $customer->id,
                'name' => 'Ibu Sari',
                'phone' => '081234567890',
                'time' => '09:00:00',
                'payment_status' => 'lunas',
                'total_amount' => 120000,
                'created_by_shift' => $shiftClosed->id,
            ]
        );

        // Transaksi pesanan-reguler tambahan untuk variasi data operasional
        $trxRegulerTambahan = Transaction::firstOrCreate(
            [
                'method' => 'pesanan-reguler',
                'status' => 'belum-diproses',
                'start_date' => now()->subDays(2)->toDateString(),
            ],
            [
                'user_id' => $userKasir->id,
                'customer_id' => $customer->id,
                'name' => 'Ibu Sari',
                'phone' => '081234567890',
                'date' => now()->addDay()->toDateString(),
                'time' => '11:00:00',
                'end_date' => now()->addDay()->toDateString(),
                'payment_status' => 'dp',
                'total_amount' => 190000,
                'created_by_shift' => $shiftAktif->id,
            ]
        );
        TransactionDetail::firstOrCreate(
            ['transaction_id' => $trxRegulerTambahan->id, 'product_id' => $prodBoluKeju->id],
            ['quantity' => 2, 'price' => 95000]
        );

        // Transaksi siap-beli tambahan untuk memperkaya data laporan harian
        $trxSiapBeliTambahan = Transaction::firstOrCreate(
            [
                'method' => 'siap-beli',
                'status' => 'selesai',
                'date' => now()->subDay()->toDateString(),
                'time' => '16:00:00',
            ],
            [
                'user_id' => $userKasir->id,
                'customer_id' => $customer->id,
                'name' => 'Ibu Sari',
                'phone' => '081234567890',
                'payment_status' => 'lunas',
                'total_amount' => 75000,
                'created_by_shift' => $shiftAktif->id,
            ]
        );
        TransactionDetail::firstOrCreate(
            ['transaction_id' => $trxSiapBeliTambahan->id, 'product_id' => $prodPudingSusu->id],
            ['quantity' => 3, 'price' => 25000]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 18. PRODUCTIONS — TC-054..TC-064
        // PR = produksi pesanan, PS = produksi siap-beli
        // ─────────────────────────────────────────────────────────────────────

        // Produksi pesanan-kotak: status Belum Diproses — TC-056, TC-057
        $produksiPesanan = Production::firstOrCreate(
            [
                'transaction_id' => $trxKotak->id,
                'method' => 'pesanan-kotak',
                'status' => 'Belum Diproses',
            ],
            [
                'date' => now()->subDays(14)->toDateString(),
                'time' => '08:00:00',
                'is_start' => false,
                'is_finish' => false,
            ]
        );
        ProductionDetail::firstOrCreate(
            ['production_id' => $produksiPesanan->id, 'product_id' => $prodBrownies->id],
            ['quantity_plan' => 8, 'quantity_get' => 0, 'quantity_fail' => 0, 'cycle' => 1]
        );

        // Produksi siap-beli: status Dimulai — TC-063 (selesaikan produksi)
        $produksiSiapBeliAktif = Production::firstOrCreate(
            [
                'method' => 'siap-beli',
                'status' => 'Dimulai',
                'is_start' => true,
                'is_finish' => false,
            ],
            [
                'transaction_id' => null,
                'date' => now()->subDays(1)->toDateString(),
                'time' => '08:00:00',
            ]
        );
        ProductionDetail::firstOrCreate(
            ['production_id' => $produksiSiapBeliAktif->id, 'product_id' => $prodBrownies->id],
            ['quantity_plan' => 10, 'quantity_get' => 10, 'quantity_fail' => 0, 'cycle' => 1]
        );

        // Produksi selesai — TC-064 (riwayat produksi)
        $produksiSelesai = Production::firstOrCreate(
            [
                'method' => 'siap-beli',
                'status' => 'Selesai',
                'date' => now()->subDays(20)->toDateString(),
            ],
            [
                'transaction_id' => null,
                'time' => '08:00:00',
                'is_start' => true,
                'is_finish' => true,
                'start_date' => now()->subDays(20)->toDateString(),
                'end_date' => now()->subDays(20)->toDateString(),
            ]
        );
        ProductionDetail::firstOrCreate(
            ['production_id' => $produksiSelesai->id, 'product_id' => $prodBrownies->id],
            ['quantity_plan' => 8, 'quantity_get' => 8, 'quantity_fail' => 0, 'cycle' => 1]
        );

        // Produksi pesanan-reguler tambahan untuk transaksi baru
        $produksiRegulerTambahan = Production::firstOrCreate(
            [
                'transaction_id' => $trxRegulerTambahan->id,
                'method' => 'pesanan-reguler',
                'status' => 'Belum Diproses',
            ],
            [
                'date' => now()->toDateString(),
                'time' => '09:30:00',
                'is_start' => false,
                'is_finish' => false,
            ]
        );
        ProductionDetail::firstOrCreate(
            ['production_id' => $produksiRegulerTambahan->id, 'product_id' => $prodBoluKeju->id],
            ['quantity_plan' => 2, 'quantity_get' => 0, 'quantity_fail' => 0, 'cycle' => 1]
        );

        // Produksi siap-beli tambahan yang sudah selesai
        $produksiSiapBeliTambahan = Production::firstOrCreate(
            [
                'method' => 'siap-beli',
                'status' => 'Selesai',
                'date' => now()->subDays(4)->toDateString(),
            ],
            [
                'transaction_id' => null,
                'time' => '07:30:00',
                'is_start' => true,
                'is_finish' => true,
                'start_date' => now()->subDays(4)->toDateString(),
                'end_date' => now()->subDays(4)->toDateString(),
            ]
        );
        ProductionDetail::firstOrCreate(
            ['production_id' => $produksiSiapBeliTambahan->id, 'product_id' => $prodPudingSusu->id],
            ['quantity_plan' => 20, 'quantity_get' => 20, 'quantity_fail' => 0, 'cycle' => 1]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 19. EXPENSES (BELANJA) — TC-035..TC-043
        // Belanja Draft     : untuk TC-039 (Mulai Belanja)
        // Belanja Dimulai   : untuk TC-040, TC-041 (input aktual; coba melebihi ekspektasi)
        // Belanja Selesai   : untuk TC-043 (riwayat belanja)
        // Belanja Gagal     : untuk TC-042 (semua item = 0 → status Gagal)
        // ─────────────────────────────────────────────────────────────────────

        // Draft (TC-039)
        $belanjaDraft = Expense::firstOrCreate(
            [
                'supplier_id' => $supplier->id,
                'status' => 'Draft',
                'note' => 'Belanja mingguan TC-039',
            ],
            [
                'expense_date' => now()->subDays(3)->toDateString(),
                'is_start' => false,
                'is_finish' => false,
                'grand_total_expect' => 240000,
                'grand_total_actual' => 0,
            ]
        );
        ExpenseDetail::firstOrCreate(
            ['expense_id' => $belanjaDraft->id, 'material_id' => $matTepung->id],
            [
                'unit_id' => $unitKg->id,
                'quantity_expect' => 10,
                'price_expect' => 15000,
                'total_expect' => 150000,
                'quantity_get' => 0,
                'price_get' => 0,
                'total_actual' => 0,
            ]
        );
        ExpenseDetail::firstOrCreate(
            ['expense_id' => $belanjaDraft->id, 'material_id' => $matGula->id],
            [
                'unit_id' => $unitKg->id,
                'quantity_expect' => 5,
                'price_expect' => 18000,
                'total_expect' => 90000,
                'quantity_get' => 0,
                'price_get' => 0,
                'total_actual' => 0,
            ]
        );

        // Dimulai (TC-040, TC-041)
        $belanjaDimulai = Expense::firstOrCreate(
            [
                'supplier_id' => $supplier->id,
                'status' => 'Dimulai',
                'note' => 'Belanja tengah bulan TC-040',
            ],
            [
                'expense_date' => now()->subDays(7)->toDateString(),
                'is_start' => true,
                'is_finish' => false,
                'grand_total_expect' => 150000,
                'grand_total_actual' => 0,
            ]
        );
        ExpenseDetail::firstOrCreate(
            ['expense_id' => $belanjaDimulai->id, 'material_id' => $matTepung->id],
            [
                'unit_id' => $unitKg->id,
                'quantity_expect' => 10,
                'price_expect' => 15000,
                'total_expect' => 150000,
                'quantity_get' => 0,
                'price_get' => 0,
                'total_actual' => 0,
            ]
        );

        // Selesai (TC-043 riwayat)
        $belanjaSelesai = Expense::firstOrCreate(
            [
                'supplier_id' => $supplier->id,
                'status' => 'Selesai',
                'note' => 'Belanja awal bulan riwayat',
            ],
            [
                'expense_date' => now()->subDays(30)->toDateString(),
                'end_date' => now()->subDays(30)->toDateString(),
                'is_start' => true,
                'is_finish' => true,
                'grand_total_expect' => 300000,
                'grand_total_actual' => 295000,
            ]
        );
        ExpenseDetail::firstOrCreate(
            ['expense_id' => $belanjaSelesai->id, 'material_id' => $matTepung->id],
            [
                'unit_id' => $unitKg->id,
                'quantity_expect' => 10,
                'price_expect' => 15000,
                'total_expect' => 150000,
                'quantity_get' => 10,
                'price_get' => 15000,
                'total_actual' => 150000,
                'is_quantity_get' => true,
                'expiry_date' => '2027-01-01',
            ]
        );
        ExpenseDetail::firstOrCreate(
            ['expense_id' => $belanjaSelesai->id, 'material_id' => $matGula->id],
            [
                'unit_id' => $unitKg->id,
                'quantity_expect' => 8,
                'price_expect' => 18000,
                'total_expect' => 144000,
                'quantity_get' => 8,
                'price_get' => 18000,
                'total_actual' => 144000,
                'is_quantity_get' => true,
            ]
        );

        // Gagal (TC-042 — semua item aktual = 0)
        Expense::firstOrCreate(
            [
                'supplier_id' => $supplier2->id,
                'status' => 'Gagal',
                'note' => 'Belanja gagal TC-042',
            ],
            [
                'expense_date' => now()->subDays(14)->toDateString(),
                'end_date' => now()->subDays(14)->toDateString(),
                'is_start' => true,
                'is_finish' => true,
                'grand_total_expect' => 50000,
                'grand_total_actual' => 0,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 20. HITUNG (STOCK COUNT) — TC-139..TC-151
        // Draft        : TC-144 (Mulai Hitung)
        // Sedang Proses: TC-145, TC-146, TC-147, TC-148
        // Selesai      : TC-149 (riwayat hitung)
        // Catat Rusak  : TC-147 (kuantitas melebihi stok)
        // ─────────────────────────────────────────────────────────────────────

        // Draft — Hitung Persediaan (TC-144)
        $hitungDraft = Hitung::firstOrCreate(
            [
                'user_id' => $userInventori->id,
                'action' => 'Hitung Persediaan',
                'status' => 'Draft',
                'note' => 'Stock opname bulanan TC-144',
            ],
            [
                'hitung_date' => now()->subDays(2)->toDateString(),
                'is_start' => false,
                'is_finish' => false,
                'grand_total' => 0,
                'loss_grand_total' => 0,
            ]
        );
        HitungDetail::firstOrCreate(
            ['hitung_id' => $hitungDraft->id, 'material_batch_id' => $batchTepung->id],
            [
                'material_id' => $matTepung->id,
                'quantity_expect' => 10,
                'quantity_actual' => 0,
                'total' => 0,
                'loss_total' => 0,
            ]
        );
        HitungDetail::firstOrCreate(
            ['hitung_id' => $hitungDraft->id, 'material_batch_id' => $batchGula->id],
            [
                'material_id' => $matGula->id,
                'quantity_expect' => 5,
                'quantity_actual' => 0,
                'total' => 0,
                'loss_total' => 0,
            ]
        );

        // Sedang Diproses — untuk input aktual (TC-145, TC-146, TC-148)
        $hitungDiproses = Hitung::firstOrCreate(
            [
                'user_id' => $userInventori->id,
                'action' => 'Hitung Persediaan',
                'status' => 'Sedang Diproses',
                'note' => 'Hitung sedang berjalan TC-145',
            ],
            [
                'hitung_date' => now()->subDay()->toDateString(),
                'is_start' => true,
                'is_finish' => false,
                'grand_total' => 0,
                'loss_grand_total' => 0,
            ]
        );
        HitungDetail::firstOrCreate(
            ['hitung_id' => $hitungDiproses->id, 'material_batch_id' => $batchTepung->id],
            [
                'material_id' => $matTepung->id,
                'quantity_expect' => 10,
                'quantity_actual' => 9,
                'total' => 0,
                'loss_total' => 0,
            ]
        );

        // Catat Rusak Sedang Diproses — TC-147 (input melebihi stok → error)
        $hitungRusak = Hitung::firstOrCreate(
            [
                'user_id' => $userInventori->id,
                'action' => 'Catat Rusak',
                'status' => 'Sedang Diproses',
                'note' => 'Catat rusak TC-147',
            ],
            [
                'hitung_date' => now()->subDays(3)->toDateString(),
                'is_start' => true,
                'is_finish' => false,
                'grand_total' => 0,
                'loss_grand_total' => 0,
            ]
        );
        HitungDetail::firstOrCreate(
            ['hitung_id' => $hitungRusak->id, 'material_batch_id' => $batchTepung->id],
            [
                'material_id' => $matTepung->id,
                'quantity_expect' => 10,
                'quantity_actual' => 0,
                'total' => 0,
                'loss_total' => 0,
            ]
        );

        // Selesai — riwayat hitung (TC-149)
        Hitung::firstOrCreate(
            [
                'user_id' => $userInventori->id,
                'action' => 'Hitung Persediaan',
                'status' => 'Selesai',
                'note' => 'Riwayat hitung TC-149',
            ],
            [
                'hitung_date' => now()->subDays(30)->toDateString(),
                'hitung_date_finish' => now()->subDays(30)->toDateString(),
                'is_start' => true,
                'is_finish' => true,
                'grand_total' => 0,
                'loss_grand_total' => 1000,
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 21. INVENTORY LOGS — TC-150, TC-151
        // Menyediakan log untuk uji filter alur persediaan berdasarkan aksi
        // ─────────────────────────────────────────────────────────────────────
        $logBelanja = InventoryLog::firstOrCreate(
            [
                'material_id' => $matTepung->id,
                'material_batch_id' => $batchTepung->id,
                'action' => 'belanja',
                'reference_type' => 'Expense',
                'reference_id' => $belanjaSelesai->id,
            ],
            [
                'user_id' => $userInventori->id,
                'quantity_change' => 10,
                'quantity_after' => 10,
                'note' => 'Penambahan stok dari belanja awal bulan',
            ]
        );

        InventoryLog::firstOrCreate(
            [
                'material_id' => $matTepung->id,
                'material_batch_id' => $batchTepung->id,
                'action' => 'produksi',
                'reference_type' => 'Production',
                'reference_id' => $produksiSelesai->id,
            ],
            [
                'user_id' => $userProduksi->id,
                'quantity_change' => -0.5,
                'quantity_after' => 9.5,
                'note' => 'Pemakaian untuk produksi Brownies Coklat',
            ]
        );

        InventoryLog::firstOrCreate(
            [
                'material_id' => $matCoklat->id,
                'material_batch_id' => $batchCoklatBesar->id,
                'action' => 'belanja',
                'reference_type' => 'Expense',
                'reference_id' => $belanjaSelesai->id,
            ],
            [
                'user_id' => $userInventori->id,
                'quantity_change' => 5,
                'quantity_after' => 5,
                'note' => 'Penambahan stok coklat bubuk',
            ]
        );

        InventoryLog::firstOrCreate(
            [
                'material_id' => $matGula->id,
                'material_batch_id' => $batchGula->id,
                'action' => 'hitung',
                'reference_type' => 'Hitung',
            ],
            [
                'user_id' => $userInventori->id,
                'quantity_change' => -1,
                'quantity_after' => 4,
                'note' => 'Penyesuaian hasil stock opname',
            ]
        );

        // ─────────────────────────────────────────────────────────────────────
        // 22. NOTIFICATIONS — TC-123..TC-125, TC-156..TC-157, TC-169..TC-170, TC-179..TC-180
        // Setiap user role mendapat notifikasi belum-dibaca dan sudah-dibaca
        // ─────────────────────────────────────────────────────────────────────
        $notifSeed = [
            // Inventori — TC-124, TC-125, TC-156, TC-157
            [
                'user_id' => $userInventori->id,
                'title' => 'Belanja Selesai',
                'body' => 'Belanja telah diselesaikan dan stok diperbarui.',
                'type' => 'inventori',
                'is_read' => false,
                'status' => 2,
            ],
            [
                'user_id' => $userInventori->id,
                'title' => 'Stok Hampir Habis',
                'body' => 'Coklat Bubuk mendekati batas minimum stok.',
                'type' => 'inventori',
                'is_read' => false,
                'status' => 1,
            ],
            // Produksi — TC-179, TC-180
            [
                'user_id' => $userProduksi->id,
                'title' => 'Pesanan Baru Masuk',
                'body' => 'Pesanan pesanan-kotak menunggu diproduksi.',
                'type' => 'produksi',
                'is_read' => false,
                'status' => 1,
            ],
            [
                'user_id' => $userProduksi->id,
                'title' => 'Produksi Selesai',
                'body' => 'Produksi siap-beli telah selesai.',
                'type' => 'produksi',
                'is_read' => true,
                'status' => 2,
            ],
            // Kasir — TC-169, TC-170
            [
                'user_id' => $userKasir->id,
                'title' => 'Pesanan Dapat Diambil',
                'body' => 'Pesanan pelanggan siap diambil.',
                'type' => 'kasir',
                'is_read' => false,
                'status' => 2,
            ],
            [
                'user_id' => $userKasir->id,
                'title' => 'Shift Akan Berakhir',
                'body' => 'Shift hari ini akan berakhir dalam 1 jam.',
                'type' => 'kasir',
                'is_read' => false,
                'status' => 1,
            ],
            // Admin — TC-123, TC-124, TC-125
            [
                'user_id' => $userAdmin->id,
                'title' => 'Akun Baru Ditambahkan',
                'body' => 'Ahmad Fauzi berhasil terdaftar sebagai Kasir.',
                'type' => 'manajemen',
                'is_read' => false,
                'status' => 2,
            ],
            [
                'user_id' => $userAdmin->id,
                'title' => 'Laporan Tersedia',
                'body' => 'Laporan bulan Januari 2026 siap diunduh.',
                'type' => 'manajemen',
                'is_read' => true,
                'status' => 2,
            ],
        ];

        foreach ($notifSeed as $notif) {
            Notification::firstOrCreate(
                ['user_id' => $notif['user_id'], 'title' => $notif['title']],
                $notif
            );
        }

        // ─────────────────────────────────────────────────────────────────────
        // 23. POINTS HISTORY — TC-162 (gunakan poin saat transaksi)
        // ─────────────────────────────────────────────────────────────────────
        PointsHistory::firstOrCreate(
            [
                'phone' => '081234567890',
                'action_id' => 'EARNED-OR-01',
            ],
            [
                'action' => 'Pesanan Reguler',
                'points' => 50,
                'transaction_id' => $trxSelesai->id,
            ]
        );

        $this->command->info('TestSeeder selesai! Data pengujian 184 test case berhasil dimuat.');
        $this->command->newLine();
        $this->command->table(
            ['Modul', 'Data Tersedia'],
            [
                ['Users (aktif)', 'inventori, produksi, kasir, admin + fauzi'],
                ['Users (negatif)', 'belumaktif, nonaktif, token valid/expired/sudah-aktif'],
                ['Roles', 'Inventori, Produksi, Kasir (max:3), Admin, Supervisor (max:2)'],
                ['Categories', 'Kue Basah, Kue Kering, Minuman'],
                ['Units', 'Kilogram (base), Gram, Liter (base), Mililiter, Pcs'],
                ['Suppliers', 'Makmur, Sentosa'],
                ['Materials (>= 3 pakai kg)', 'Tepung, Gula, Coklat, Mentega, Telur, Keju, Susu Cair'],
                ['Batches', 'Tepung 10kg, Gula 5kg, Coklat 0.1kg (kecil), Coklat 5kg, Mentega 3kg, Keju 2kg, Susu 6L'],
                ['Products', 'Brownies Coklat, Kue Lapis, Donat Gula, Bolu Keju, Puding Susu'],
                ['Type Costs', 'Kemasan, Gas, Listrik'],
                ['Customers', 'Ibu Sari (poin:50), Pak Rudi'],
                ['Shifts', '1 aktif (open), 1 tutup (closed)'],
                ['Transactions', 'OR selesai + OR belum-diproses, OK belum-diproses, OS selesai + OS selesai tambahan'],
                ['Productions', 'pesanan-kotak Belum Diproses, pesanan-reguler Belum Diproses, siap-beli Dimulai, siap-beli Selesai x2'],
                ['Expenses', 'Draft, Dimulai, Selesai (riwayat), Gagal'],
                ['Hitung', 'Draft, Sedang Diproses, Catat Rusak, Selesai (riwayat)'],
                ['Inventory Logs', '4 log (belanja x2, produksi, hitung)'],
                ['Notifications', '8 notif (belum baca + sudah baca per role)'],
                ['Points History', '1 riwayat earning poin'],
            ]
        );
    }
}