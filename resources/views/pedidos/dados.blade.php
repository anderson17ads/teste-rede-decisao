@extends('layout')
@section('pagina_titulo', 'Dados' )

@section('pagina_conteudo')

<div class="container carrinho">
    <div class="row">
        <h3>Finalizar Pedido</h3>
        <hr/>
        
        @include('carrinho._itens')

        <h4>Dados de Entrega</h4>

        <form method="POST" action="{{ route('pedidos.concluir') }}">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="input-field col s4">
                    <input id="cep" type="text" name="cep" value="{{ old('cep') }}" class="validate {{ $errors->has('cep') ? ' invalid' : '' }}" required autofocus>
                    
                    <label for="cep" data-error="{{ $errors->has('cep') ? $errors->first('cep') : null }}" >
                        Cep
                    </label>
                </div>

                <div class="input-field col s4">
                    <input id="endereco" type="text" name="endereco" value="{{ old('endereco') }}" class="validate {{ $errors->has('endereco') ? ' invalid' : '' }}" required autofocus>
                    
                    <label for="endereco" data-error="{{ $errors->has('endereco') ? $errors->first('endereco') : null }}" >
                        Endereço
                    </label>
                </div>

                <div class="input-field col s2">
                    <input id="numero" type="text" name="numero" value="{{ old('numero') }}" class="validate {{ $errors->has('numero') ? ' invalid' : '' }}" required autofocus>
                    
                    <label for="numero" data-error="{{ $errors->has('numero') ? $errors->first('numero') : null }}" >
                        Número
                    </label>
                </div>

                <div class="input-field col s2">
                    <input id="complemento" type="text" name="complemento" value="{{ old('complemento') }}" class="validate {{ $errors->has('complemento') ? ' invalid' : '' }}" autofocus>
                    
                    <label for="complemento" data-error="{{ $errors->has('complemento') ? $errors->first('complemento') : null }}" >
                        Complemento
                    </label>
                </div>
            </div>            
            
            <div class="row">
                <div class="input-field col s4">
                    <input id="bairro" type="text" name="bairro" value="{{ old('bairro') }}" class="validate {{ $errors->has('bairro') ? ' invalid' : '' }}" required autofocus>
                    
                    <label for="bairro" data-error="{{ $errors->has('bairro') ? $errors->first('bairro') : null }}" >
                        Bairro
                    </label>
                </div>

                <div class="input-field col s4">
                    <input id="cidade" type="text" name="cidade" value="{{ old('cidade') }}" class="validate {{ $errors->has('cidade') ? ' invalid' : '' }}" required autofocus>
                    
                    <label for="cidade" data-error="{{ $errors->has('cidade') ? $errors->first('cidade') : null }}" >
                        Cidade
                    </label>
                </div>

                <div class="input-field col s4">
                    <input id="estado" type="text" name="estado" value="{{ old('estado') }}" class="validate {{ $errors->has('estado') ? ' invalid' : '' }}" required autofocus>
                    
                    <label for="estado" data-error="{{ $errors->has('estado') ? $errors->first('estado') : null }}" >
                        Estado
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="observacao" name="observacao" class="materialize-textarea" class="validate {{ $errors->has('observacao') ? ' invalid' : '' }}" autofocus></textarea>
                    
                    <label for="observacao" data-error="{{ $errors->has('observacao') ? $errors->first('observacao') : null }}" >
                        Observação
                    </label>
                </div>
            </div>

            <button 
                type="submit" 
                class="btn-large col l5 s5 m5 tooltipped" 
                data-position="top" 
                data-delay="50" 
                data-tooltip="Adquirir os produtos concluindo a compra?">
                Finalizar Pedido
            </button>   
        </form>
    </div>
</div>

@endsection