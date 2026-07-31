<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
   protected $fillable = [
        'pelanggan_id',
        'meja_id',
        'kode_booking',
        'tgl_jam_trx',
        'status_pembayaran_dp',
        'nominal_hp',
        'metode_pembayaran',
        'status_pembayaran_trx',
        'total_bayar',
        'kekurangan',
        'metode_pembayaran_trx',
    ];
}
