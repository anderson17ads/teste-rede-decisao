<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;

class CategoriasController extends Controller
{
	/**
	 * Exibindo os produtos dessa categoria
	 *
	 * @return void
	 */
    public function view($id = null)
    {
    	if (is_null($id)) return redirect()->route('index');

    	$categoria = Categoria::where([
    		'id' => $id
		])->first();

    	if (!$categoria->exists()) return redirect()->route('index');

    	return view('categorias.view', compact('categoria'));
    }
}
