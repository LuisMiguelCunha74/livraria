<form action="{{route('generos.update', ['id'=>$genero->id_genero])}}" method="post">
@method('patch')
@csrf
designação: <input type="text" name="desginacao" value="{{$genero->designacao}}"><br>
    @if ( $errors->has('desginacao'))
    devera indicar um desginacao correto<br>
    @endif
observações: <input type="text" name="observacoes" value="{{$genero->observacoes}}"><br>
    @if ( $errors->has('observacoes'))
    devera indicar um observacoes correto<br>
    @endif
<input type="submit" value="enviar">
</form>