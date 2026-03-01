<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Testdb;

Route::get('/cekdatabase', [Testdb::class, 'check']);
