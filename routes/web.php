<?php

use App\Http\Controllers\VarosController;
use App\Models\Megye;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $megyek = Megye::all();
    return view('home',[ 'megyek' => $megyek]);
});

Route::get('/varos/{id}', [VarosController::class, 'getVarosbyMegye']);

Route::get('/deleteVaros/{id}', [VarosController::class, 'delete']);

Route::post('/modifyVaros/{id}', [VarosController::class, 'modify']);

route::post('/addVaros', [VarosController::class, 'store']);
