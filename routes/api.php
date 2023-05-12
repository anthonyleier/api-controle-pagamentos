<?php

use App\Http\Controllers\Api\PagamentoController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NotaController;
use Illuminate\Support\Facades\Route;

// Calcular o valor total das notas para cada remetente
// Calcular o valor que o remetente irá receber pelo que já foi entregue
// Calcular o valor que o remetente irá receber pelo que ainda não foi entregue
// Calcular quanto o remetente deixou de receber devido ao atraso na entrega
Route::get('/notas/{cnpj}', [NotaController::class, 'show']);

// Agrupar as notas por remetente
Route::get('/notas', [NotaController::class, 'index']);

// CRUD de Pagamentos e Usuários
Route::apiResource('/pagamentos', PagamentoController::class);
Route::apiResource('/usuarios', UserController::class);
