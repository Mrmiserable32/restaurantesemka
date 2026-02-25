<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
   protected $fillable = [
        'no_meja',
        'kapasitas',
        'status',
        'create_at'


    ];
}
