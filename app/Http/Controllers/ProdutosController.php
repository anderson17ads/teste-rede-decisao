<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

class ProdutosController extends Controller
{
    public function view($id = null)
    {
    	if (is_null($id)) return redirect()->route('index');

		$produto = Produto::where([
			'id'    => $id,
		])->first();
		
		if($produto) {
			return view('produtos.view', compact('produto'));
		}
    }
}