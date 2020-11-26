<form action="{{route('autores.store')}}" method="post">
@csrf
Nome: <input type="text" name="nome" value="{{old('nome')}}"><br>
    @if ( $errors->has('nome'))
    devera indicar um nome correto<br>
    @endif
Nacionalidade: <input type="text" name="nacionalidade" value="{{old('nacionalidade')}}"><br>
    @if ( $errors->has('nacionalidade'))
    devera indicar um nacionalidade correto<br>
    @endif
Data nascimento: <input type="date" name="data_nascimento" value="{{old('data_nascimento')}}"><br>
    @if ( $errors->has('data_nascimento'))
    devera indicar um data_nascimento correto<br>
    @endif
Fotografia: <input type="text" name="fotografia" value="{{old('fotografia')}}"><br>
    @if ( $errors->has('fotografia'))
    devera indicar um fotografia correto<br>
    @endif
<input type="submit" value="enviar">
</form>