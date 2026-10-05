<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfController;
use App\Livewire\ActivateAccount;
use App\Livewire\User\Index;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
    ]);
});

Route::get('/', App\Livewire\Landing\Index::class)->name('home');
Route::get('/landing-produk', App\Livewire\Landing\Produk::class)->name('landing-produk');
Route::get('/landing-produk/{product}', App\Livewire\Landing\Detail::class)->name('landing-produk-detail');
Route::get('/landing-faq', App\Livewire\Landing\Faq::class)->name('landing-faq');

Route::get('/generate-sitemap', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/landing-produk'))
        ->add(Url::create('/landing-faq'));

    \App\Models\Product::all()->each(function (\App\Models\Product $product) use ($sitemap) {
        $sitemap->add(Url::create(route('landing-produk-detail', $product)));
    });

    $sitemap->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap generated';
});

// PWA Offline Route
Route::get('/offline', function () {
    return view('modules.laravelpwa.offline');
})->name('laravelpwa.offline');

// Aktivasi Akun (guest only)
Route::get('/aktivasi-akun/{token}', ActivateAccount::class)
    ->middleware('guest')
    ->name('activate-account');

Route::get('dashboard', function () {
    return redirect()->route('ringkasan-umum');
})
    ->middleware(['auth'])
    ->name('dashboard');
Route::get('/ringkasan-umum', [DashboardController::class, 'ringkasan'])
    ->middleware('auth')
    ->name('ringkasan-umum');
Route::get('/menunggu-peran', App\Livewire\Dashboard\NoRole::class)
    ->middleware('auth')
    ->name('no-role');
Route::get('/laporan-kasir', App\Livewire\Dashboard\LaporanKasir::class)
    ->middleware(['auth', 'permission:kasir.laporan.kelola'])
    ->name('laporan-kasir');
Route::get('/laporan-kasir/pdf', [PdfController::class, 'laporanKasir'])
    ->middleware(['auth', 'permission:kasir.laporan.kelola'])
    ->name('laporan-kasir.pdf');
Route::get('/laporan-produksi', App\Livewire\Dashboard\LaporanProduksi::class)
    ->middleware(['auth', 'permission:produksi.laporan.kelola'])
    ->name('laporan-produksi');
Route::get('/laporan-produksi/pdf', [PdfController::class, 'laporanProduksi'])
    ->middleware(['auth', 'permission:produksi.laporan.kelola'])
    ->name('laporan-produksi.pdf');
Route::get('/laporan-inventori', App\Livewire\Dashboard\LaporanInventori::class)
    ->middleware(['auth', 'permission:inventori.laporan.kelola'])
    ->name('laporan-inventori');
Route::get('/laporan-inventori/pdf', [PdfController::class, 'laporanInventori'])
    ->middleware(['auth', 'permission:inventori.laporan.kelola'])
    ->name('laporan-inventori.pdf');

// Export pages for kasir/produksi/inventori export-only pages
Route::get('/laporan-kasir/export', App\Livewire\Dashboard\ExportKasir::class)
    ->middleware(['auth', 'permission:kasir.laporan.kelola'])
    ->name('laporan-kasir.export');
Route::get('/laporan-kasir/excel', [PdfController::class, 'kasirExcel'])
    ->middleware(['auth', 'permission:kasir.laporan.kelola'])
    ->name('laporan-kasir.excel');

Route::get('/laporan-produksi/export', App\Livewire\Dashboard\ExportProduksi::class)
    ->middleware(['auth', 'permission:produksi.laporan.kelola'])
    ->name('laporan-produksi.export');
Route::get('/laporan-produksi/excel', [PdfController::class, 'produksiExcel'])
    ->middleware(['auth', 'permission:produksi.laporan.kelola'])
    ->name('laporan-produksi.excel');

Route::get('/laporan-inventori/export', App\Livewire\Dashboard\ExportInventori::class)
    ->middleware(['auth', 'permission:inventori.laporan.kelola'])
    ->name('laporan-inventori.export');
Route::get('/laporan-inventori/excel', [PdfController::class, 'inventoriExcel'])
    ->middleware(['auth', 'permission:inventori.laporan.kelola'])
    ->name('laporan-inventori.excel');

Route::middleware(['auth'])->group(function () {
    // Pekerja routes
    Route::middleware(['permission:manajemen.pekerja.kelola'])->group(function () {
        Route::get('/pekerja', Index::class)->name('user');
        Route::get('/pekerja/tambah', App\Livewire\User\Form::class)->name('user.tambah');
        Route::get('/pekerja/{id}/rincian', App\Livewire\User\Form::class)->name('user.edit');
        Route::get('/pekerja/cetak', [PdfController::class, 'generateUserPDF'])->name('user.pdf');
    });

    // Peran routes
    Route::middleware(['permission:manajemen.peran.kelola'])->group(function () {
        Route::get('/peran', App\Livewire\Peran\Index::class)->name('role');
        Route::get('/peran/tambah', App\Livewire\Peran\Form::class)->name('role.tambah');
        Route::get('/peran/{id}/rincian', App\Livewire\Peran\Form::class)->name('role.edit');
        Route::get('/peran/cetak', [PdfController::class, 'generateRolePDF'])->name('role.pdf');
    });

    // Pelanggan routes
    Route::middleware(['permission:manajemen.pelanggan.kelola'])->group(function () {
        Route::get('/pelanggan', App\Livewire\Customer\Index::class)->name('customer');
        Route::get('/pelanggan/{id}/rincian', App\Livewire\Customer\Show::class)->name('customer.show');
    });

    Route::get('/notifikasi', App\Livewire\Notification\Index::class)->name('notifikasi');

    Route::group(['middleware' => ['permission:inventori.produk.kelola|inventori.persediaan.kelola|inventori.belanja.rencana.kelola|inventori.toko.kelola|inventori.belanja.mulai|inventori.hitung.kelola|inventori.alur.lihat|inventori.laporan.kelola']], function () {
        Route::get('/kategori', App\Livewire\Category\Index::class)->name('kategori');
        Route::get('/satuan-ukur', App\Livewire\Unit\Index::class)->name('satuan-ukur');
        Route::get('/jenis-biaya', App\Livewire\TypeCost\Index::class)->name('jenis-biaya');
        Route::get('/kategori-persediaan', App\Livewire\IngredientCategory\Index::class)->name('kategori-persediaan');
        Route::get('/produk', App\Livewire\Product\Index::class)->name('produk');
        Route::get('/produk/tambah/', App\Livewire\Product\Form::class)->name('produk.tambah');
        Route::get('/produk/{id}/rincian', App\Livewire\Product\Form::class)->name('produk.edit');
        Route::get('/supplier', App\Livewire\Supplier\Index::class)->name('supplier');
        Route::get('/supplier/tambah', App\Livewire\Supplier\Form::class)->name('supplier.tambah');
        Route::get('/supplier/{id}/rincian', App\Livewire\Supplier\Form::class)->name('supplier.edit');
        Route::get('/supplier/cetak', [PdfController::class, 'generateSupplierPDF'])
            ->name('supplier.pdf');
        Route::get('/bahan-baku', App\Livewire\Material\Index::class)->name('bahan-baku');
        Route::get('/bahan-baku/tambah', App\Livewire\Material\Form::class)->name('bahan-baku.tambah');
        Route::get('/bahan-baku/{id}/rincian', App\Livewire\Material\Form::class)->name('bahan-baku.edit');
        Route::get('/bahan-baku/cetak', [PdfController::class, 'generateMaterialPDF'])
            ->name('bahan-baku.pdf');
        Route::get('/belanja', App\Livewire\Expense\Index::class)->name('belanja');
        Route::get('/belanja/rencana', App\Livewire\Expense\Rencana::class)->name('belanja.rencana');
        Route::get('/belanja/tambah', App\Livewire\Expense\Form::class)->name('belanja.tambah');
        Route::get('/belanja/{id}/edit', App\Livewire\Expense\Form::class)->name('belanja.edit');
        Route::get('/belanja/{id}/rincian', App\Livewire\Expense\Rincian::class)->name('belanja.rincian');
        Route::get('/belanja/{id}/dapatkan-belanja', App\Livewire\Expense\Mulai::class)->name('belanja.dapatkan-belanja');
        Route::get('/belanja/riwayat', App\Livewire\Expense\Riwayat::class)->name('belanja.riwayat');
        Route::get('/belanja/cetak/{id}', [PdfController::class, 'generateExpenseDetailPDF'])
            ->name('rincian-belanja.pdf');
        Route::get('/hitung', App\Livewire\Hitung\Index::class)->name('hitung');
        Route::get('/hitung/rencana', App\Livewire\Hitung\Rencana::class)->name('hitung.rencana');
        Route::get('/hitung/tambah', App\Livewire\Hitung\Form::class)->name('hitung.tambah');
        Route::get('/hitung/{id}/edit', App\Livewire\Hitung\Form::class)->name('hitung.edit');
        Route::get('/hitung/{id}/rincian', App\Livewire\Hitung\Rincian::class)->name('hitung.rincian');
        Route::get('/hitung/{id}/mulai-aksi', App\Livewire\Hitung\Mulai::class)->name('hitung.mulai');
        Route::get('/hitung/riwayat', App\Livewire\Hitung\Riwayat::class)->name('hitung.riwayat');
        Route::get('/alur-persediaan', App\Livewire\Alur\Index::class)->name('alur-persediaan');
    });

    Route::group(['middleware' => ['permission:kasir.pesanan.kelola|kasir.laporan.kelola']], function () {
        Route::get('/transaksi', App\Livewire\Transaction\Index::class)->name('transaksi');
        Route::get('/transaksi/{id}/edit', App\Livewire\Transaction\Edit::class)->name('transaksi.edit');
        Route::get('/transaksi/{id}/rincian-pesanan', App\Livewire\Transaction\RincianPesanan::class)->name('transaksi.rincian-pesanan');
        Route::get('/transaksi/{id}/rincian-produk', App\Livewire\Transaction\RincianProduk::class)->name('transaksi.rincian-produk');
        Route::get('/transaksi/{method}/pesanan', App\Livewire\Transaction\Pesanan::class)->name('transaksi.pesanan');
        Route::get('/transaksi/siap-beli', App\Livewire\Transaction\SiapBeli::class)->name('transaksi.siap-beli');
        Route::get('/transaksi/{method}/riwayat', App\Livewire\Transaction\Riwayat::class)->name('transaksi.riwayat');
        Route::get('/transaksi/siap-beli/{date}', App\Livewire\Transaction\TanggalSiapBeli::class)->name('transaksi.tanggal-siap-beli');
        Route::get('/transaksi/{id}/buat-pesanan', App\Livewire\Transaction\BuatPesanan::class)->name('transaksi.buat-pesanan');
        Route::get('/transaksi-riwayat-sesi', App\Livewire\Transaction\RiwayatSesiPenjualan::class)->name('transaksi.riwayat-sesi');
        Route::get('/transaksi-rincian-sesi/{id}', App\Livewire\Transaction\RincianSesi::class)->name('transaksi.rincian-sesi');
        Route::get('/transaksi/cetak', [PdfController::class, 'generateTransactionPDF'])
            ->name('transaksi.pdf');
        Route::get('/transaksi/{id}/struk', [PdfController::class, 'generateStrukPDF'])
            ->name('transaksi.struk');
        Route::get('/transaksi/{id}/print', function () {
            return view('pdf.pdf', [
                'transaction' => \App\Models\Transaction::find(request()->id),
            ]);
        })->name('transaksi.cetak');
    });

    Route::group(['middleware' => ['permission:produksi.rencana.kelola|produksi.mulai|produksi.laporan.kelola']], function () {
        Route::get('/produksi', App\Livewire\Production\Index::class)->name('produksi');
        Route::get('/produksi/tambah-siap-beli', App\Livewire\Production\TambahSiapBeli::class)->name('produksi.tambah-siap-beli');
        Route::get('/produksi/{id}/edit-siap-beli', App\Livewire\Production\TambahSiapBeli::class)->name('produksi.edit-siap-beli');
        Route::get('/produksi/{id}/rincian', App\Livewire\Production\Rincian::class)->name('produksi.rincian');
        Route::get('/produksi/{id}/mulai-produksi', App\Livewire\Production\Mulai::class)->name('produksi.mulai');
        Route::get('/produksi/{id}/mulai-siap-beli', App\Livewire\Production\MulaiSiapBeli::class)->name('produksi.mulai-siap-beli');
        Route::get('/produksi/riwayat/{method}', App\Livewire\Production\Riwayat::class)->name('produksi.riwayat');
        Route::get('/produksi/pesanan/{method}', App\Livewire\Production\Pesanan::class)->name('produksi.pesanan');
        Route::get('/produksi/antrian-produksi', App\Livewire\Production\AntrianProduksi::class)->name('produksi.antrian-produksi');
        Route::get('/produksi/{id}/rincian-siap-beli', App\Livewire\Production\RincianSiapBeli::class)->name('produksi.rincian-siap-beli');
        Route::get('/produksi/{id}/rincian-pesanan', App\Livewire\Production\RincianPesanan::class)->name('produksi.rincian-pesanan');
    });

    Route::get('/pengaturan', App\Livewire\Setting\Index::class)->name('pengaturan');
    Route::get('/profil-saya/{id}', App\Livewire\Setting\MyProfile::class)->name('profil-saya');

    // Profil Usaha
    Route::middleware(['permission:manajemen.profil_usaha.kelola'])->group(function () {
        Route::get('/profil-usaha', App\Livewire\Setting\StoreProfile::class)->name('profil-usaha');
    });

    // Metode Pembayaran
    Route::middleware(['permission:manajemen.pembayaran.kelola'])->group(function () {
        Route::get('/metode-pembayaran', App\Livewire\Setting\PaymentMethod::class)->name('metode-pembayaran');
    });

    Route::get('transaksi/laporan', [PDFController::class, 'printReport'])->name('transaksi.laporan');
});

// ─── Test-only login endpoint (hanya tersedia di local env) ─────────────────
// Digunakan oleh k6 reliability testing untuk mendapatkan sesi tanpa CSRF.
if (app()->environment('local')) {
    Route::post('/test/login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (! \Illuminate\Support\Facades\Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = \Illuminate\Support\Facades\Auth::user();

        if (! $user->activated_at) {
            \Illuminate\Support\Facades\Auth::logout();

            return response()->json(['message' => 'Account not activated'], 403);
        }

        if (! $user->is_active) {
            \Illuminate\Support\Facades\Auth::logout();

            return response()->json(['message' => 'Account disabled'], 403);
        }

        $request->session()->regenerate();

        return response()->json(['message' => 'OK', 'user' => $user->email]);
    })->name('test.login');

    // Cek stok produk
    Route::get('/test/stock-check/{productId}', function (string $productId) {
        $product = \App\Models\Product::select('id', 'name', 'stock')->find($productId);
        if (! $product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'stock' => $product->stock,
        ]);
    });

    // Reset stok produk ke nilai tertentu (untuk setup sebelum pengujian)
    Route::post('/test/stock-reset', function (\Illuminate\Http\Request $request) {
        $productId = $request->input('product_id');
        $stock = (int) $request->input('stock', 100);

        $affected = \App\Models\Product::where('id', $productId)->update(['stock' => $stock]);
        if (! $affected) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json(['success' => true, 'product_id' => $productId, 'stock' => $stock]);
    });

    // Simulasi pembelian siap-beli (tanpa lock) – untuk uji race condition
    Route::post('/test/concurrent-buy', function (\Illuminate\Http\Request $request) {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        $product = \App\Models\Product::find($productId);
        if (! $product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $stockBefore = $product->stock;

        if ($stockBefore < $quantity) {
            return response()->json([
                'success' => false,
                'error' => 'insufficient_stock',
                'message' => 'Stok tidak cukup',
                'stock_before' => $stockBefore,
                'stock_after' => $stockBefore,
            ], 409);
        }

        // Sengaja TIDAK menggunakan lockForUpdate() untuk mendemonstrasikan
        // potensi race condition pada pengurangan stok konkuren.
        $product->decrement('stock', $quantity);
        $stockAfter = $product->fresh()->stock;

        return response()->json([
            'success' => true,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'possible_race' => $stockAfter < 0,
        ]);
    });

    // Cek total batch quantity sebuah material (untuk validasi reliability produksi)
    Route::get('/test/material-batch/{materialId}', function (string $materialId) {
        $material = \App\Models\Material::select('id', 'name', 'status', 'minimum')
            ->find($materialId);

        if (! $material) {
            return response()->json(['error' => 'Material not found'], 404);
        }

        $totalBatch = \App\Models\MaterialBatch::where('material_id', $materialId)
            ->sum('batch_quantity');

        $batches = \App\Models\MaterialBatch::where('material_id', $materialId)
            ->select('id', 'batch_quantity', 'date')
            ->get();

        return response()->json([
            'id' => $material->id,
            'name' => $material->name,
            'status' => $material->status,
            'minimum' => $material->minimum,
            'total_batch' => (float) $totalBatch,
            'batches' => $batches,
        ]);
    });

    // Reset batch quantity material (gunakan ID batch spesifik)
    Route::post('/test/material-batch-reset', function (\Illuminate\Http\Request $request) {
        $batchId = $request->input('batch_id');
        $quantity = (float) $request->input('quantity', 20);

        $affected = \App\Models\MaterialBatch::where('id', $batchId)
            ->update(['batch_quantity' => $quantity]);

        if (! $affected) {
            return response()->json(['error' => 'Batch not found'], 404);
        }

        return response()->json(['success' => true, 'batch_id' => $batchId, 'quantity' => $quantity]);
    });

    // Simulasi pengurangan bahan baku produksi secara konkuren (tanpa lock)
    Route::post('/test/concurrent-produce', function (\Illuminate\Http\Request $request) {
        $materialId = $request->input('material_id');
        $quantity = (float) $request->input('quantity', 1);

        // Ambil batch pertama yang masih ada stok (FIFO)
        $batch = \App\Models\MaterialBatch::where('material_id', $materialId)
            ->where('batch_quantity', '>', 0)
            ->orderBy('date')
            ->first();

        if (! $batch) {
            return response()->json([
                'success' => false,
                'error' => 'insufficient_material',
                'message' => 'Stok bahan baku tidak cukup',
            ], 409);
        }

        $batchBefore = (float) $batch->batch_quantity;

        if ($batchBefore < $quantity) {
            return response()->json([
                'success' => false,
                'error' => 'insufficient_material',
                'message' => 'Stok batch tidak mencukupi',
                'batch_before' => $batchBefore,
            ], 409);
        }

        // Kurangi tanpa lockForUpdate() — untuk mendeteksi race condition
        $batch->decrement('batch_quantity', $quantity);
        $batchAfter = (float) \App\Models\MaterialBatch::find($batch->id)->batch_quantity;

        return response()->json([
            'success' => true,
            'batch_id' => $batch->id,
            'batch_before' => $batchBefore,
            'batch_after' => $batchAfter,
            'possible_race' => $batchAfter < 0,
        ]);
    });

    // Uji atomisitas transaksi: beli produk dalam DB::transaction, opsional gagal di tengah
    Route::post('/test/atomicity-buy', function (\Illuminate\Http\Request $request) {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);
        $forceFail = (bool) $request->input('force_fail', false);

        $product = \App\Models\Product::find($productId);
        if (! $product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $stockBefore = $product->stock;
        $committed = false;
        $rolledBack = false;

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($product, $quantity, $forceFail, &$committed) {
                if ($product->stock < $quantity) {
                    throw new \Exception('insufficient_stock');
                }

                // Kurangi stok dalam transaksi
                $product->decrement('stock', $quantity);

                if ($forceFail) {
                    // Simulasi kegagalan di tengah transaksi
                    throw new \Exception('simulated_failure');
                }

                $committed = true;
            });
        } catch (\Exception $e) {
            $rolledBack = ! $committed;

            if ($e->getMessage() === 'insufficient_stock') {
                return response()->json([
                    'success' => false,
                    'error' => 'insufficient_stock',
                    'stock_before' => $stockBefore,
                    'stock_after' => $product->fresh()->stock,
                    'rolled_back' => null,
                ], 409);
            }

            $stockAfterRollback = $product->fresh()->stock;

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'stock_before' => $stockBefore,
                'stock_after_rollback' => $stockAfterRollback,
                'rolled_back' => $rolledBack,
                'stock_unchanged' => $stockAfterRollback === $stockBefore,
            ]);
        }

        return response()->json([
            'success' => true,
            'stock_before' => $stockBefore,
            'stock_after' => $product->fresh()->stock,
            'rolled_back' => false,
        ]);
    });

    // Jalankan perintah inventory:check-alerts dan kembalikan output-nya
    Route::get('/test/run-inventory-check', function () {
        $output = new \Symfony\Component\Console\Output\BufferedOutput;

        $exitCode = \Illuminate\Support\Facades\Artisan::call('inventory:check-alerts', [], $output);

        $lines = array_filter(
            array_map('trim', explode("\n", $output->fetch())),
            fn ($l) => $l !== ''
        );

        return response()->json([
            'exit_code' => $exitCode,
            'success' => $exitCode === 0,
            'output_lines' => array_values($lines),
        ]);
    });
}
// ─────────────────────────────────────────────────────────────────────────────

require __DIR__.'/auth.php';
