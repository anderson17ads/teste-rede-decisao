<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $fillable = [
        'nome',
        'imagem'
    ];

    /**
     * Recupera os produtos relacionados
     *
     * @return array
     */
    public function categoriaProdutos()
    {
        return $this->hasMany('App\ProdutoCategoria');
    }
}
