@extends('layout')
@section('pagina_titulo', 'HOME')

@section('pagina_conteudo')

<div class="container">
	<div class="row">

		<div class="home-busca col center s12 m12 l12">
			<h3>Faça sua busca pelos melhores produtos</h3>
			
			@include('busca._form_busca')
		</div>

		@if ($categorias)
			<div class="home-categorias col s12 m12 l12">
				<div class="row">
					<h3>Categorias</h3>

					@foreach($categorias as $categoria)
						<div class="home-categorias-item col s12 m6 l4">
							<a href="{{ route('categoria', ['id' => $categoria->id]) }}">
								<img src="{{URL::asset('/image/uploads/categorias/')}}/{{ $categoria->imagem }}
								">
								<p>{{ $categoria->nome }}</p>
							</a>
						</div>
					@endforeach
				</div>
			</div>
		@endif
		
		@if ($produtos)
			<h3>Produtos</h3>

			@include('produtos._produtos')
		@endif
	</div>
</div>

@endsection