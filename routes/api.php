<?php

use App\Http\Controllers\Api\PagamentoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/pagamentos', PagamentoController::class);
Route::apiResource('/users', UserController::class);
