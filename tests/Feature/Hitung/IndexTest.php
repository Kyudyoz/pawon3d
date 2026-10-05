<?php

declare(strict_types=1);

use App\Livewire\Hitung\Form;
use App\Livewire\Hitung\Index;
use App\Livewire\Hitung\Mulai;
use App\Livewire\Hitung\Rincian;
use App\Livewire\Hitung\Riwayat;
use App\Models\Hitung;
use App\Models\HitungDetail;
use App\Models\Material;
use App\Models\MaterialBatch;
use App\Models\StoreProfile;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;

beforeEach(function () {
    $profile = StoreProfile::firstOrCreate(['id' => 1], [
        'name' => 'Test Store',
        'address' => 'Test Address',
        'phone' => '08123456789',
    ]);
    View::share('storeProfile', $profile);

    $permission = Permission::firstOrCreate(['name' => 'inventori.hitung.kelola', 'guard_name' => 'web']);

    $this->user = User::factory()->create([
        'is_active' => true,
        'activated_at' => now(),
    ]);
    $this->user->givePermissionTo($permission);
});

// TC-139: Staff Inventori mengakses halaman hitung
test('user can access hitung page', function () {
    $response = $this->actingAs($this->user)->get(route('hitung'));

    $response->assertOk();
    $response->assertSeeLivewire(Index::class);
});

// TC-139 riwayat sub: akses halaman riwayat hitung
// TC-149: Staff Inventori melihat riwayat hitung
test('user can access riwayat hitung page', function () {
    $response = $this->actingAs($this->user)->get(route('hitung.riwayat'));

    $response->assertOk();
    $response->assertSeeLivewire(Riwayat::class);
});

// TC-140: Staff Inventori membuat rencana hitung dengan data valid
test('can create hitung with valid data', function () {
    $unit = Unit::create(['name' => 'Kilogram', 'alias' => 'kg', 'group' => 'berat']);
    $material = Material::create(['name' => 'Tepung Terigu', 'is_active' => true, 'status' => 'tersedia']);
    $batch = MaterialBatch::create([
        'material_id' => $material->id,
        'unit_id' => $unit->id,
        'batch_quantity' => 10,
        'date' => now()->addMonths(6),
    ]);

    Livewire::actingAs($this->user)
        ->test(Form::class)
        ->set('action', 'Hitung Persediaan')
        ->set('hitung_details', [
            [
                'material_id' => (string) $material->id,
                'material_batch_id' => (string) $batch->id,
                'material_quantity' => 10,
                'quantity_actual' => 0,
                'unit_name' => ' (kg)',
                'total' => 0,
            ]
        ])
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('hitung.rencana'));
});

// TC-141: Staff Inventori membuat rencana hitung tanpa memilih bahan baku
test('validates material is required when creating hitung', function () {
    Livewire::actingAs($this->user)
        ->test(Form::class)
        ->set('action', 'Hitung Persediaan')
        ->set('hitung_details', [
            [
                'material_id' => '',
                'material_batch_id' => '',
                'material_quantity' => 0,
                'quantity_actual' => 0,
                'unit_name' => ' (satuan)',
                'total' => 0,
            ]
        ])
        ->call('save')
        ->assertHasErrors(['hitung_details.0.material_id']);
});

// TC-142: Staff Inventori membuat rencana hitung tanpa memilih batch
test('validates batch is required when creating hitung', function () {
    $unit = Unit::create(['name' => 'Gram', 'alias' => 'g', 'group' => 'berat']);
    $material = Material::create(['name' => 'Gula Pasir', 'is_active' => true, 'status' => 'tersedia']);

    Livewire::actingAs($this->user)
        ->test(Form::class)
        ->set('action', 'Hitung Persediaan')
        ->set('hitung_details', [
            [
                'material_id' => (string) $material->id,
                'material_batch_id' => '',
                'material_quantity' => 0,
                'quantity_actual' => 0,
                'unit_name' => ' (g)',
                'total' => 0,
            ]
        ])
        ->call('save')
        ->assertHasErrors(['hitung_details.0.material_batch_id']);
});

// TC-143: Staff Inventori membuat rencana hitung tanpa memilih jenis aksi
test('validates action is required when creating hitung', function () {
    Livewire::actingAs($this->user)
        ->test(Form::class)
        ->set('action', '')
        ->call('save')
        ->assertHasErrors(['action']);
});

// TC-144: Staff Inventori memulai penghitungan stok
test('can start hitung from rincian page', function () {
    $hitung = Hitung::create([
        'user_id' => $this->user->id,
        'action' => 'Hitung Persediaan',
        'status' => 'Belum Diproses',
        'is_start' => false,
        'is_finish' => false,
        'grand_total' => 0,
        'loss_grand_total' => 0,
    ]);

    Livewire::actingAs($this->user)
        ->test(Rincian::class, ['id' => $hitung->id])
        ->call('start')
        ->assertSet('status', 'Sedang Diproses')
        ->assertSet('is_start', true);

    $hitung->refresh();
    expect($hitung->status)->toBe('Sedang Diproses');
    expect((bool) $hitung->is_start)->toBeTrue();
});

// TC-145: Staff Inventori memasukkan kuantitas aktual pada hitung persediaan (valid)
test('can save valid quantity on mulai hitung', function () {
    $unit = Unit::create(['name' => 'Kilogram', 'alias' => 'kg', 'group' => 'berat']);
    $material = Material::create(['name' => 'Tepung Beras', 'is_active' => true, 'status' => 'tersedia']);
    $batch = MaterialBatch::create([
        'material_id' => $material->id,
        'unit_id' => $unit->id,
        'batch_quantity' => 10,
    ]);

    $hitung = Hitung::create([
        'user_id' => $this->user->id,
        'action' => 'Hitung Persediaan',
        'status' => 'Sedang Diproses',
        'is_start' => true,
        'is_finish' => false,
        'grand_total' => 0,
        'loss_grand_total' => 0,
    ]);

    $detail = HitungDetail::create([
        'hitung_id' => $hitung->id,
        'material_id' => $material->id,
        'material_batch_id' => $batch->id,
        'quantity_expect' => 10,
        'quantity_actual' => 0,
        'total' => 0,
        'loss_total' => 0,
    ]);

    Livewire::actingAs($this->user)
        ->test(Mulai::class, ['id' => $hitung->id])
        ->set('hitungDetails.0.quantity_input', 9)
        ->call('save')
        ->assertHasNoErrors();
});

// TC-146: Staff Inventori memasukkan kuantitas negatif pada hitung
test('validates quantity cannot be negative on mulai hitung', function () {
    $unit = Unit::create(['name' => 'Liter', 'alias' => 'L', 'group' => 'volume']);
    $material = Material::create(['name' => 'Minyak Goreng', 'is_active' => true, 'status' => 'tersedia']);
    $batch = MaterialBatch::create([
        'material_id' => $material->id,
        'unit_id' => $unit->id,
        'batch_quantity' => 5,
    ]);

    $hitung = Hitung::create([
        'user_id' => $this->user->id,
        'action' => 'Hitung Persediaan',
        'status' => 'Sedang Diproses',
        'is_start' => true,
        'is_finish' => false,
        'grand_total' => 0,
        'loss_grand_total' => 0,
    ]);

    HitungDetail::create([
        'hitung_id' => $hitung->id,
        'material_id' => $material->id,
        'material_batch_id' => $batch->id,
        'quantity_expect' => 5,
        'quantity_actual' => 0,
        'total' => 0,
        'loss_total' => 0,
    ]);

    Livewire::actingAs($this->user)
        ->test(Mulai::class, ['id' => $hitung->id])
        ->set('hitungDetails.0.quantity_input', -5)
        ->call('save')
        ->assertHasErrors(['hitungDetails.0.quantity_input']);
});

// TC-147: Staff Inventori memasukkan kuantitas rusak/hilang melebihi stok tersedia
test('shows error when quantity exceeds available stock on rusak action', function () {
    $unit = Unit::create(['name' => 'Pcs', 'alias' => 'pcs', 'group' => 'unit']);
    $material = Material::create(['name' => 'Coklat Bubuk', 'is_active' => true, 'status' => 'tersedia']);
    $batch = MaterialBatch::create([
        'material_id' => $material->id,
        'unit_id' => $unit->id,
        'batch_quantity' => 10,
    ]);

    $hitung = Hitung::create([
        'user_id' => $this->user->id,
        'action' => 'Catat Persediaan Rusak',
        'status' => 'Sedang Diproses',
        'is_start' => true,
        'is_finish' => false,
        'grand_total' => 0,
        'loss_grand_total' => 0,
    ]);

    HitungDetail::create([
        'hitung_id' => $hitung->id,
        'material_id' => $material->id,
        'material_batch_id' => $batch->id,
        'quantity_expect' => 10,
        'quantity_actual' => 0,
        'total' => 0,
        'loss_total' => 0,
    ]);

    $component = Livewire::actingAs($this->user)
        ->test(Mulai::class, ['id' => $hitung->id])
        ->set('hitungDetails.0.quantity_input', 15)
        ->call('validateQuantities');

    expect($component->get('errorInputs'))->not->toBeEmpty();
});

// TC-148: Staff Inventori menyelesaikan perhitungan stok
test('can finish hitung from rincian page', function () {
    $unit = Unit::create(['name' => 'Kg', 'alias' => 'kg', 'group' => 'berat']);
    $material = Material::create(['name' => 'Bahan Tes', 'is_active' => true, 'status' => 'tersedia']);
    $batch = MaterialBatch::create([
        'material_id' => $material->id,
        'unit_id' => $unit->id,
        'batch_quantity' => 8,
    ]);

    $hitung = Hitung::create([
        'user_id' => $this->user->id,
        'action' => 'Hitung Persediaan',
        'status' => 'Sedang Diproses',
        'is_start' => true,
        'is_finish' => false,
        'grand_total' => 0,
        'loss_grand_total' => 0,
    ]);

    HitungDetail::create([
        'hitung_id' => $hitung->id,
        'material_id' => $material->id,
        'material_batch_id' => $batch->id,
        'quantity_expect' => 8,
        'quantity_actual' => 8,
        'total' => 0,
        'loss_total' => 0,
    ]);

    Livewire::actingAs($this->user)
        ->test(Rincian::class, ['id' => $hitung->id])
        ->call('finish')
        ->assertSet('status', 'Selesai')
        ->assertSet('is_finish', true);

    $hitung->refresh();
    expect($hitung->status)->toBe('Selesai');
    expect((bool) $hitung->is_finish)->toBeTrue();
});
