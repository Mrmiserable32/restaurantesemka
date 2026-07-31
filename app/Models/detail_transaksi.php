<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{

protected $fillable = [
        'transaksi_id',
        'menu_id',
        'qty',
        'harga',
    ];

}
