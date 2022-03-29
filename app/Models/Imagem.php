<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    use HasFactory;

    protected $fillable = [
       'cliente_id','url'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
