@extends('layout')
@section('pagina_titulo', $categoria->nome)

@section('pagina_conteudo')

<div class="container">
	<div class="row">
		<h3>{{ $categoria->nome }}</h3>
        <hr/>
		
		@if ($categoria->categoriaProdutos)
			<h3>Produtos</h3>

			@include('produtos._produtos', ['produtos' => $categoria->categoriaProdutos])
		@endif
	</div>
</div>

@endsection