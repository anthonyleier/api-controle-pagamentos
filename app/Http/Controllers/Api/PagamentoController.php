<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePagamentoRequest;
use App\Http\Resources\PagamentoResource;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $pagamentos = Pagamento::all();
        return PagamentoResource::collection($pagamentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdatePagamentoRequest $request) {
        $data = $request->validated();
        $pagamento = Pagamento::create($data);
        return new PagamentoResource($pagamento);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $pagamento = Pagamento::findOrFail($id);
        return new PagamentoResource($pagamento);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $data = $request->all();
        $pagamento = Pagamento::findOrFail($id);
        return new PagamentoResource($pagamento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->delete();
        return response()->json([], 204);
    }
}
