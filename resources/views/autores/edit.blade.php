<form action="{{route('autores.update', ['id'=>$autores->id_autores])}}" method="post">
@csrf
Nome: <input type="text" name="nome" value="{{$autores->nome}}"><br>
    @if ( $errors->has('nome'))
    devera indicar um nome correto<br>
    @endif
Nacionalidade: <input type="text" name="nacionalidade" value="{{$autores->nacionalidade}}"><br>
    @if ( $errors->has('nacionalidade'))
    devera indicar um nacionalidade correto<br>
    @endif
Data nascimento: <input type="date" name="data_nascimento" value="{{$autores->data_nascimeno}}"><br>
    @if ( $errors->has('data_nascimento'))
    devera indicar um data_nascimento correto<br>
    @endif
Fotografia: <input type="text" name="fotografia" value="{{$autores->fotografia}}"><br>
    @if ( $errors->has('fotografia'))
    devera indicar um fotografia correto<br>
    @endif
<input type="submit" value="enviar">
</form>