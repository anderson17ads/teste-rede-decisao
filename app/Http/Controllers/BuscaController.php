<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

class BuscaController extends Controller
{
    public function index()
    {
    	$request = Request();

    	$produtos = [];

    	$palavra = $request->input('palavra');

    	if ($palavra) {
    		$produtos = Produto::orWhere([
    			['nome', 'like', "%{$palavra}%"]
			])
			->orWhere([
    			['descricao', 'like', "%{$palavra}%"]
			])
			->get()->all();
    	}

    	return view('busca.index', compact('produtos'));
    }
}
