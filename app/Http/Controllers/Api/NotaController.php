<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApiAzapfyService;
use Exception;

class NotaController extends Controller {
    public function index() {
        try {
            $service = new ApiAzapfyService();
            $dados = $service->getAgrupamentoNotasPorCNPJ();

            if ($dados) {
                return response()->json($dados);
            } else {
                return response()->json(['erro' => 'Falha na comunicação com API Azapfy'], 500);
            }

        } catch (Exception $e) {
            return response()->json(['erro' => $e->getMessage()], 500);
        }
    }

    public function show(string $id) {
        //
    }
}
