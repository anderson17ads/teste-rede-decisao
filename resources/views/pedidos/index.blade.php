@extends('layout')
@section('pagina_titulo', 'Pedidos' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <h3>Meus Pedidos</h3>
        
        @if (Session::has('mensagem-sucesso'))
            <div class="card-panel green">{{ Session::get('mensagem-sucesso') }}</div>
        @endif
        
        @if (Session::has('mensagem-falha'))
            <div class="card-panel red">{{ Session::get('mensagem-falha') }}</div>
        @endif
        
        <div class="divider"></div>
        
        <div class="row col s12 m12 l12">
            <h4>Pedidos concluídos</h4>
            
            @forelse ($pedidos as $pedido)
                <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
                
                <h5 class="col l6 s12 m6"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                
                <form method="POST" action="{{ route('pedidos.cancelar') }}">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Qtd</th>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Total</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
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

                                <td>
                                    <button 
                                        type="submit" 
                                        class="btn-large red col l12 s12 m12 tooltipped" 
                                        data-position="bottom" 
                                        data-delay="50" 
                                        data-tooltip="Cancelar itens selecionados">
                                        Cancelar
                                    </button>
                                </td>

                                <td>
                                    <a 
                                        href="{{ route('pedidos.detalhe', ['id' => $pedido->id]) }}"
                                        class="btn-large red col l12 s12 m12 tooltipped"
                                        data-position="bottom"
                                        data-delay="50"
                                        data-tooltip="Detalhe do pedido">
                                        Detalhes
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"></td>
                                <td><strong>Total do pedido</strong></td>
                                <td>R$ {{ number_format($totalPedido, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            @empty
                <h5 class="center">
                    @if ($cancelados->count() > 0)
                        Neste momento não há nenhum pedido valido.
                    @else
                        Você ainda não fez nenhum pedido.
                    @endif
                </h5>
            @endforelse
        </div>
        <div class="row col s12 m12 l12">
            <div class="divider"></div>
            
            <h4>Pedidos cancelados</h4>
            
            @forelse ($cancelados as $pedido)
                <h5 class="col l2 s12 m2"> Pedido: {{ $pedido->id }} </h5>
                
                <h5 class="col l5 s12 m5"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                
                <h5 class="col l5 s12 m5"> Cancelado em: {{ $pedido->updated_at->format('d/m/Y H:i') }} </h5>
                
                <table>
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Qtd</th>
                            <th>Produto</th>
                            <th>Valor</th>
                            <th>Total</th>
                            <th>&nbsp;</th>
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

                                <td>{{ $pedidoProduto->produto->quantidade }}</td>

                                <td>{{ $pedidoProduto->produto->nome }}</td>
                                
                                <td>R$ {{ number_format($pedidoProduto->valor, 2, ',', '.') }}</td>
                                
                                <td>R$ {{ number_format($totalProduto, 2, ',', '.') }}</td>

                                <td>
                                    <a 
                                        href="{{ route('pedidos.detalhe', ['id' => $pedido->id]) }}"
                                        class="btn-large red col l12 s12 m12 tooltipped"
                                        data-position="bottom"
                                        data-delay="50"
                                        data-tooltip="Detalhe do pedido">
                                        Detalhes
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td><strong>Total do pedido</strong></td>
                            <td>R$ {{ number_format($totalPedido, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            @empty
                <h5 class="center">Nenhum pedido ainda foi cancelado.</h5>
            @endforelse
        </div>
    </div>

</div>

@endsection