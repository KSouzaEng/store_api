<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'telefone1', 'telefone2','cliente_id',
    ];

    public function clinte()
    {
        return $this->belongsTo(Cliente::class);
    }
}
