<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\Rule;

class Exercicio extends Model
{
    protected $fillable = ['name', 'description', 'operation', 'limite', 'total'];

    protected $casts = [
        'nome' => 'string',
        'descricao' => 'string',
        'operation' => \App\Enums\OperationsEnum::class,
        'limite' => 'integer',
        'total' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function maximizar()
    {
        return $this->items->sum(function($item) {
            $quantidade = max($item->min, min($item->quantidade, $item->max));
            return $quantidade * $item->valor;
        });
    }

    public function minimizar()
    {
        return $this->items->sum(function($item) {
            $quantidade = max($item->min, min($item->quantidade, $item->max));
            return $quantidade * $item->valor;
        });
    }
}
