<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoCategoria extends Model
{
	protected $fillable = [
        'produto_id',
        'categoria_id'
    ];

    /**
     * Interligando o produto
     *
     * @return array
     */
    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }

    /**
     * Interligando a categoria
     *
     * @return array
     */
    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
    }
}
