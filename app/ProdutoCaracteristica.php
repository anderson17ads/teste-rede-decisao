<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoCaracteristica extends Model
{
	protected $fillable = [
        'produto_id',
        'caracteristica_id'
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
     * Interligando a caracteristica
     *
     * @return array
     */
    public function caracteristica()
    {
        return $this->belongsTo('App\Caracteristica', 'caracteristica_id', 'id');
    }
}
