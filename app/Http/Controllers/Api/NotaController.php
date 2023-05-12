<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApiAzapfyService;
use Exception;

class NotaController extends Controller {
    public function __construct() {
        $this->service = new ApiAzapfyService();
    }

    public function index() {
        try {
            $dados = $this->service->getAgrupamentoNotasPorCNPJ();
            return response()->json($dados);
        } catch (Exception $e) {
            return response()->json(['Ocorreu um erro no processamento das informações' => $e->getMessage()], 500);
        }
    }

    public function show(string $cnpj) {
        try {
            $valores = $this->service->getValores($cnpj);
            return response()->json($valores);
        } catch (Exception $e) {
            return response()->json(['Ocorreu um erro no processamento das informações' => $e->getMessage()], 500);
        }
    }
}
