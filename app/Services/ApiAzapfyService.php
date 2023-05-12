<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiAzapfyService {
    public function getAgrupamentoNotasPorCNPJ() {
        $response = Http::get('http://homologacao3.azapfy.com.br/api/ps/notas');

        if ($response->successful()) {
            $dados = $response->json();
            $lista = [];

            foreach ($dados as $dado) {
                $cnpj = $dado['cnpj_remete'];
                $chave = $dado['chave'];
                $valor = $dado['valor'];

                if (!isset($lista[$cnpj])) $lista[$cnpj] = [];
                array_push($lista[$cnpj], [$chave, $valor]);
            }

            return $lista;
        }
    }
}
