<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendedorCliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendedor_id','cliente_id',
    ];

}
