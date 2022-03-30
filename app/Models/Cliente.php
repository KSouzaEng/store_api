<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'name', 'email', 'imagem','cliente_id',
    ];

    public function vendedor(){

        return $this->belongsToMany(User::class, 'vendedor_clientes');
    }
    public function telefone()
    {
        return $this->hasMany(Telefone::class);
    }
    public function tipocliente()
    {
        return $this->hasMany(Tipocliente::class);
    }
    public function imagem()
    {
        return $this->hasMany(Imagem::class);
    }
}
