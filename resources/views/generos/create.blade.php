<form action="{{route('generos.store')}}" method="post">
@csrf
designação: <input type="text" name="desginacao" value="{{old('desginacao')}}"><br>
    @if ( $errors->has('desginacao'))
    devera indicar um desginacao correto<br>
    @endif
observações: <input type="text" name="observacoes" value="{{old('observacoes')}}"><br>
    @if ( $errors->has('observacoes'))
    devera indicar um observacoes correto<br>
    @endif
<input type="submit" value="enviar">
</form>