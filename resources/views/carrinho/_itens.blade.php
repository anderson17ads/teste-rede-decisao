<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Qtd</th>
            <th>Produto</th>
            <th>Preço</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalPedido = 0;
        @endphp
        
        @foreach ($itens as $id => $item)
            <tr data-carrinho-item="{{ $id }}">
                <td>
                    <img src="{{URL::asset('/image/uploads/produtos/')}}/{{ $item['imagem'] }}">
                </td>
                <td class="center-align">

                    <div class="carrinho-quantidade">
                        <a 
                            href="{{ route('carrinho.quantidade', ['id' => $id]) }}" 
                            class="carrinho-setas aumentar" 
                            data-carrinho-quantidade="1"></a>

                        <a 
                            href="{{ route('carrinho.quantidade', ['id' => $id]) }}" 
                            class="carrinho-setas diminuir" 
                            data-carrinho-quantidade="0"></a>

                        <input type="text" value="{{ $item['quantidade'] }}" data-carrinho-quantidade-input>          
                    </div>

                    <a 
                        href="{{ route('carrinho.remover', ['id' => $id]) }}" 
                        class="tooltipped" 
                        data-position="right" 
                        data-delay="50" 
                        data-tooltip="Retirar produto do carrinho?"
                        data-carrinho-remover>
                        Retirar produto
                    </a>
                </td>

                <td> {{ $item['nome'] }} </td>
                
                <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                
                @php
                    $totalProduto = $item['preco'] * $item['quantidade'];
                    $totalPedido += $totalProduto;
                @endphp
                
                <td data-carrinho-produto-total>R$ {{ number_format($totalProduto, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <strong class="col offset-l6 offset-m6 offset-s6 l4 m4 s4 right-align">Total do pedido: </strong>
    
    <span class="col l2 m2 s2" data-carrinho-pedido-total>
        R$ {{ number_format($totalPedido, 2, ',', '.') }}
    </span>
</div>