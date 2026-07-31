<?php

namespace Tests\Feature;

use App\Models\detail_transaksi;
use App\Models\menu;
use App\Models\transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelPersistenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu_is_stored_in_the_menus_table_with_unguarded_attributes(): void
    {
        $menu = menu::create([
            'nama_menu' => 'Nasi Goreng',
            'harga' => 25000,
            'stok' => 10,
            'foto' => 'nasi-goreng.jpg',
        ]);

        $this->assertSame('menus', $menu->getTable());
        $this->assertDatabaseHas('menus', ['nama_menu' => 'Nasi Goreng', 'stok' => 10]);
        $this->assertEqualsWithDelta(25000.0, menu::find($menu->id)->harga, 0.001);
    }

    public function test_transaksi_is_stored_with_all_attributes_and_defaults_the_timestamp(): void
    {
        $transaksi = transaksi::create([
            'pelanggan_id' => 1,
            'meja_id' => 2,
            'kode_booking' => 'BK-0001',
            'status_pembayaran_dp' => 'pending',
            'nominal_hp' => 50000,
            'metode_pembayaran' => 'transfer',
            'status_pembayaran_trx' => 'settlement',
            'total_bayar' => 150000,
            'kekurangan' => 100000,
            'metode_pembayaran_trx' => 'transfer',
        ]);

        $this->assertSame('transaksis', $transaksi->getTable());
        $this->assertDatabaseHas('transaksis', ['kode_booking' => 'BK-0001', 'meja_id' => 2]);
        $this->assertNotNull($transaksi->fresh()->tgl_jam_trx);
    }

    public function test_detail_transaksi_is_stored_in_the_detail_transaksis_table(): void
    {
        $detail = detail_transaksi::create([
            'transaksi_id' => 1,
            'menu_id' => 2,
            'qty' => 3,
            'harga' => 25000,
        ]);

        $this->assertSame('detail_transaksis', $detail->getTable());
        $this->assertDatabaseHas('detail_transaksis', ['transaksi_id' => 1, 'menu_id' => 2, 'qty' => 3]);
    }
}
