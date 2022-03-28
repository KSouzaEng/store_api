<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo_pessoa','cliente_id',
    ];
    public function clinte()
    {
        return $this->belongsTo(Cliente::class);
    }
}
