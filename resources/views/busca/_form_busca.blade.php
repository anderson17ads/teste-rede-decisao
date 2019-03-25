<div class="col l8 offset-l2 s12 m12">
	<div class="row">
		<form method="GET" action="{{ route('busca') }}">
            <div class="input-field col l10 s10 m12">
                <input id="palavra" type="text" name="palavra" class="validate {{ $errors->has('palavra') ? ' invalid' : '' }}" required autofocus>
                <label for="palavra" data-error="{{ $errors->has('palavra') ? $errors->first('palavra') : null }}">Digite sua busca</label>
            </div>

            <div class="col l2 s2 m12">
            	<div class="row">
                	<button 
                        type="submit" 
                        class="col l12 s12 m12">
                        <i class="medium material-icons">search</i>
                    </button>
                </div>
            </div>
		</form>
    </div>
</div>