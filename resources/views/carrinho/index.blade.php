@extends('layout')
@section('pagina_titulo', 'Carrinho' )

@section('pagina_conteudo')

<div class="container carrinho">
    <div class="row">
        <h3>Meu Carrinho</h3>
        <hr/>
        
        @if (Session::has('mensagem-sucesso'))
            <div class="card-panel green">
                <strong>{{ Session::get('mensagem-sucesso') }}</strong>
            </div>
        @endif
        
        @if (Session::has('mensagem-falha'))
            <div class="card-panel red">
                <strong>{{ Session::get('mensagem-falha') }}</strong>
            </div>
        @endif
        
        @if ($itens)
            @include('carrinho._itens')

            <div class="row">
                <a 
                    class="btn-large tooltipped col l4 s4 m4 offset-l2 offset-s2 offset-m2" 
                    data-position="top" 
                    data-delay="50" 
                    data-tooltip="Voltar a página inicial para continuar comprando?" 
                    href="{{ route('index') }}">
                    Continuar comprando
                </a>
                
                <a 
                    href="{{ route('pedidos.dados') }}"
                    class="btn-large col offset-l1 offset-s1 offset-m1 l5 s5 m5 tooltipped"
                    data-position="top" 
                    data-delay="50" 
                    data-tooltip="Adquirir os produtos concluindo a compra?">
                    Concluir compra
                </a>
            </div>
        @else
            <h5>Não há nenhum produto no carrinho</h5>
        @endif
    </div>
</div>

@push('scripts')
@endpush

@endsection