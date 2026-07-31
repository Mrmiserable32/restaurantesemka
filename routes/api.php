<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Testdb;

if (app()->environment('local')) {
    Route::get('/cekdatabase', [Testdb::class, 'check']);
}
