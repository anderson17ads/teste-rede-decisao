@extends('layout')
@section('pagina_titulo', 'Pedidos' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <h3>Detalhe Pedido</h3>
        
        <div class="divider"></div>
        
        <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
        
        <h5 class="col l6 s12 m6"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>

        <h5></h5>

        <div class="row col s12 m12 l12">
            <h4>Produtos</h4>

            <table>
                <thead>
                    <tr>
                        <th>Qtd</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                
                @php
                    $totalPedido = 0;
                @endphp

                @foreach ($pedido->pedidoProdutoItens as $pedidoProduto)
                    @php
                        $totalProduto = ($pedidoProduto->valor * $pedidoProduto->quantidade);
                        $totalPedido += $totalProduto;
                    @endphp

                    <tr>
                        <td>
                            <img width="100" src="{{URL::asset('/image/uploads/produtos/')}}/{{ $pedidoProduto->produto->imagem }}">
                        </td>

                        <td>{{ $pedidoProduto->quantidade }}</td>

                        <td>{{ $pedidoProduto->produto->nome }}</td>
                        
                        <td>R$ {{ number_format($pedidoProduto->valor, 2, ',', '.') }}</td>
                        
                        <td>R$ {{ number_format($totalProduto, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td><strong>Total do pedido</strong></td>
                        <td>R$ {{ number_format($totalPedido, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row col s12 m12 l12">
            <h4>Endereço de Entrega</h4>

            <p>CEP: {{ $pedido->enderecoEntrega->cep }}</p>
                
            <p>
                Endereço: {{ $pedido->enderecoEntrega->endereco }}, 
                {{ $pedido->enderecoEntrega->numero }}
                {{ $pedido->enderecoEntrega->complemento }}
            </p>

            <p>Bairro: {{ $pedido->enderecoEntrega->bairro }}</p>
            
            <p>Cidade: {{ $pedido->enderecoEntrega->cidade }}</p>

            <p>Estado: {{ $pedido->enderecoEntrega->estado }}</p>

            <p>Observação: {{ $pedido->enderecoEntrega->observacao }}</p>

        </div>
    
        <div class="row col s12 m12 l12">
            <a 
                href="{{ route('pedidos.index') }}"
                class="btn-large col red l6 s6 m12 tooltipped"
                data-position="bottom"
                data-delay="50"
                data-tooltip="Detalhe do pedido">
                Pedidos
            </a>
        </div>      
    </div>

</div>

@endsection