@extends('layout')
@section('pagina_titulo', 'BUSCA')

@section('pagina_conteudo')

<div class="container">
	<div class="row">
		@if ($produtos)
			<div class=" col center s12 m12 l12">
				<h3>Produtos encontrados para <b>{{ Request::input('palavra') }}</b></h3>
			</div>
			
			@foreach($produtos as $produto)
				<div class="col s12 m6 l4">
					<div class="card medium">
						<div class="card-image">
							<img src="{{URL::asset('/image/uploads/produtos/')}}/{{ $produto->imagem }}">
						</div>
						
						<div class="card-content">
							<span class="card-title grey-text text-darken-4 truncate" title="{{ $produto->nome }}">
								{{ $produto->nome }}
							</span>
							<p>R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
						</div>

						<div class="card-action">
							<a class="blue-text" href="{{ route('produto', $produto->id) }}">Veja mais</a>
						</div>
					</div>
				</div>
			@endforeach
		@else
			<div class=" col center s12 m12 l12">
				<h3>Nenhum produto encontrado para <b>{{ Request::input('palavra') }}</b></h3>
			</div>

			<div class="home-busca col center s12 m12 l12">
				<h3>Não desista, faça uma nova busca</h3>
			
				@include('busca._form_busca')
			</div>
		@endif
	</div>
</div>

@endsection