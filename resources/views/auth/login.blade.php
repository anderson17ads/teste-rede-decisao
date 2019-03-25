@extends('layout')
@section('pagina_titulo', 'Login' )

@section('pagina_conteudo')

<div class="container">
    <div class="row">
        <div class="col l6 offset-l3 s12 m10 offset-m2">
            <h3>Entrar</h3>

            <div class="col l12 s12 m12">
                <form method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    @include('auth._form_email')
                    @include('auth._form_password')

                    <div class="row">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}} id="remember" />
                        <label for="remember">Lembre-se de mim</label>
                    </div>

                    <div class="row">
                        <button type="submit" class="btn col l8 s12 m8">
                            Entrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection