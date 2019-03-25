<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoEndereco extends Model
{
	protected $fillable = [
        'pedido_id',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'observacao'
    ];
}
