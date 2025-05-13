<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = ['name', 'quantity', 'min', 'max', 'value', 'exercicio_id', 'total'];

    public function exercicio(): BelongsTo
    {
        return $this->belongsTo(Exercicio::class);
    }
}
