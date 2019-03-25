<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'preco'
    ];

    /**
     * Recupera as características do produto
     *
     * @return array
     */
    public function caracteristicas()
    {
    	return $this->hasMany('App\ProdutoCaracteristica');
    }
}