<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiAzapfyService {
    const AZAPFY_API_URL = 'http://homologacao3.azapfy.com.br/api/ps/notas';

    public function __construct() {
        $response = Http::get(self::AZAPFY_API_URL);
        $this->dadosAPI = $response->json();
    }

    public function getAgrupamentoNotasPorCNPJ() {
        $agrupamento = [];

        foreach ($this->dadosAPI as $nota) {
            $cnpj = $nota['cnpj_remete'];

            if (!isset($agrupamento[$cnpj])) {
                $agrupamento[$cnpj] = [
                    'cnpj' => $cnpj,
                    'notas' => []
                ];
            }

            array_push($agrupamento[$cnpj]['notas'], $nota);
        }

        return $agrupamento;
    }

    public function getValores($cnpj) {
        $listaNotas = $this->getAgrupamentoNotasPorCNPJ()[$cnpj]['notas'];

        $valorTotal = 0;
        $valorJaEntregue = 0;
        $valorNaoEntregue = 0;
        $valorAtraso = 0;

        foreach ($listaNotas as $nota) {
            $valorTotal += $nota['valor'];

            if ($nota['status'] == 'COMPROVADO') {
                $dataEmissao = Carbon::createFromFormat('d/m/Y H:i:s', $nota['dt_emis']);
                $dataEntrega = Carbon::createFromFormat('d/m/Y H:i:s', $nota['dt_entrega']);
                $diasTransporte = $dataEmissao->diff($dataEntrega)->days;

                if ($diasTransporte <= 2) {
                    $valorJaEntregue += $nota['valor'];
                } else {
                    $valorAtraso += $nota['valor'];
                }
            } else {
                $valorNaoEntregue += $nota['valor'];
            }
        }

        $valores['valor_total'] = round($valorTotal, 2);
        $valores['valor_ja_entregue'] = round($valorJaEntregue, 2);
        $valores['valor_nao_entregue'] = round($valorNaoEntregue, 2);
        $valores['valor_em_atraso'] = round($valorAtraso, 2);

        return $valores;
    }
}
