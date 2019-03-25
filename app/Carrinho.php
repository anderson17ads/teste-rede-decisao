<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;


class Carrinho extends Model
{
	/**
	 * Calcula o total do pedido
	 *
	 * @return float
	 */
    public function totalPedido()
    {
        $totalPedido = 0;

    	if (Session::has('Carrinho')) {
    		foreach (Session::get('Carrinho') as $item) {
                $totalPedido += ($item['quantidade'] * str_replace(',', '.', $item['preco']));
            }
    	}

        return $totalPedido;
    }

    /**
     * Realiza a lógica da quantidade dos itens do carrinho
     *  
     * @param object $request
     * @param int $id
     * @param bool $tipo
     *
     * @return string/json
     */
    public static function quantidade(
        $request = null,
        $id      = null,
        $tipo    = 0
    )
    {
        $quantidade = ($request->query('quantidade')) ? $request->query('quantidade') : 0;

        ($tipo)? ++$quantidade : --$quantidade;

        if ($quantidade <= 0) $quantidade = 1;
        
        $carrinho = Session::get('Carrinho');

        $carrinho[$id]['quantidade'] = $quantidade;

        Session::put('Carrinho', $carrinho);

        return [
            'quantidade'    => $quantidade,
            'produto_total' => 'R$ ' . number_format(($quantidade * $carrinho[$id]['preco']), 2, ',', '.'),
            'pedido_total'  => 'R$ ' . number_format(parent::totalPedido(), 2, ',', '.')
        ];
    }

    /**
     * Remove um item do carrinho
     *
     * @param int $id
     *
     * @return string/json
     */
    public static function remover($id = null)
    {
        if (!is_null($id)) {
            $carrinho = Session::get('Carrinho');
            unset($carrinho[$id]);

            Session::put('Carrinho', $carrinho);
        }
        
        return [
            'pedido_total'  => 'R$ ' . number_format(parent::totalPedido(), 2, ',', '.')
        ];
    }
}
