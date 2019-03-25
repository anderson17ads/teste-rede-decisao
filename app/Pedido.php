<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];

    /**
     * Recupera o pedido com a soma total e quantidade de produtos
     *
     * @return array
     */
	public function pedidoProdutos()
    {
        return $this->hasMany('App\PedidoProduto')
            ->select( \DB::raw('produto_id, sum(valor) as valores, count(1) as qtd') )
            ->groupBy('produto_id')
            ->orderBy('produto_id', 'DESC');
    }

    /**
     * Recupera os produtos relacionados
     *
     * @return array
     */
    public function pedidoProdutoItens()
    {
        return $this->hasMany('App\PedidoProduto');
    }

    /**
     * Recupera o endereço de entrega
     *
     * @return array
     */    
    public function enderecoEntrega()
    {
        return $this->hasOne('App\PedidoEndereco');
    }
}
