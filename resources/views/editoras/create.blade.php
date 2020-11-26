<form action="{{route('editora.store')}}" method="post">
@csrf
Nome: <input type="text" name="nome" value="{{old('nome')}}"><br>
    @if ( $errors->has('nome'))
    devera indicar um nome correto<br>
    @endif
Morada: <input type="text" name="morada" value="{{old('morada')}}"><br>
    @if ( $errors->has('morada'))
    devera indicar um morada correto<br>
    @endif
Observações: <input type="text" name="observacoes" value="{{old('observacoes')}}"><br>
    @if ( $errors->has('observacoes'))
    devera indicar um observacoes correto<br>
    @endif
<input type="submit" value="enviar">
</form>