<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Pedido;
use App\PedidoProduto;
use App\PedidoEndereco;

class PedidosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Listagem dos pedidos
     *
     * @return void
     */
    public function index()
    {
        $pedidos = Pedido::where([
            'status'  => 'PA',
            'user_id' => Auth::id()
        ])->orderBy('created_at', 'DESC')->get();

        $cancelados = Pedido::where([
            'status'  => 'CA',
            'user_id' => Auth::id()
        ])->orderBy('updated_at', 'DESC')->get();
        
        return view('pedidos.index', compact('pedidos', 'cancelados'));
    }

    /**
     * Detalhe do pedido
     *
     * @return void
     */
    public function detalhe($id = null)
    {
        $pedido = Pedido::where([
            'id'      => $id,
            'user_id' => Auth::id()
        ])->first();

        if (!$pedido) return redirect()->route('pedidos.index');

        return view('pedidos.detalhe', compact('pedido'));
    }

    /**
     * Dados de entrega
     *
     * @return void
     */
    public function dados(Request $request)
    {
        $itens = ($request->session()->has('Carrinho'))
            ? $request->session()->get('Carrinho') : [];
     
        return view('pedidos.dados', compact('itens'));
    }

    /**
     * Conclui um pedido
     *
     * @return void
     */
    public function concluir()
    {
        $this->middleware('VerifyCsrfToken');

        $request = Request();

        if (!$request->session()->has('Carrinho')) return redirect()->route('carrinho.index');

        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'status'  => 'PA'
        ]);

        if ($pedido->id) {
            foreach ($request->session()->get('Carrinho') as $item) {
                PedidoProduto::create([
                    'pedido_id'  => $pedido->id,
                    'produto_id' => $item['id'],
                    'valor'      => $item['preco'],
                    'quantidade' => $item['quantidade'],
                    'status'     => 'PA'
                ]);
            }

            PedidoEndereco::create(array_merge(
                ['pedido_id' => $pedido->id],
                $request->all()    
            ));
            
            $request->session()->flash('mensagem-sucesso', 'Pedido realizado com sucesso!');

            $request->session()->pull('Carrinho');
            
            return redirect()->route('pedidos.index');
        }
    }

    /**
     * Cancelar um pedido
     *
     * @return void
     */
    public function cancelar()
    {
        $this->middleware('VerifyCsrfToken');

        $request = Request();

        $id = $request->input('pedido_id');

        $pedido = Pedido::where([
            'id' => $id
        ])->exists();

        if ($pedido) {
            Pedido::where([
                'id' => $id
            ])->update([
                'status' => 'CA'
            ]);

            $request->session()->flash('mensagem-sucesso', 'Pedido cancelados com sucesso!');
        } else {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
        }

        return redirect()->route('pedidos.index');
    }
}
