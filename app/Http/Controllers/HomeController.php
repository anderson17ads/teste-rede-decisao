<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

use App\Categoria;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::get()->all();

        $categorias = Categoria::get()->all();
        
        return view('home.index', compact('produtos', 'categorias'));        
    }
}
