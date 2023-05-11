<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model {
    use HasFactory;

    protected $fillable = [
        'chave_nota',
        'valor',
        'data_hora'
    ];

    protected $casts = [
        'data_hora' => 'datetime',
    ];

    public static function boot() {
        parent::boot();

        // Preencher automaticamente o campo com tempo atual
        static::creating(function ($model) {
            $model->data_hora = now();
        });
    }
}
