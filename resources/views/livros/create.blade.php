<form action="{{route('livros.store')}}" enctype="multipart/form-data" method="post">
@csrf
Titulo: <input type="text" name="titulo" value="{{old('titulo')}}"><br>
    @if ( $errors->has('titulo'))
    devera indicar um titulo correto<br>
    @endif
Idioma: <input type="text" name="idioma" value="{{old('idioma')}}"><br>
    @if ( $errors->has('idioma'))
    devera indicar um idioma correto<br>
    @endif
Total páginas: <input type="text" name="total_paginas" value="{{old('total_paginas')}}"><br>
    @if ( $errors->has('total_paginas'))
    devera indicar um total_paginas correto<br>
    @endif
Data edição: <input type="date" name="data_edicao" value="{{old('data_edicao')}}"><br>
    @if ( $errors->has('data_edicao'))
    devera indicar um data_edicao correto<br>
    @endif
ISBN: <input type="text" name="isbn" value="{{old('isbn')}}"><br>
     @if ( $errors->has('isbn'))
    devera indicar um isbn correto(13 caracteres)<br>
    @endif
Observações: <input type="text" name="observacoes" value="{{old('observacoes')}}"><br>
     @if ( $errors->has('observacoes'))
    devera indicar um observacoes correto<br>
    @endif
Imagem capa: <input type="file" name="imagem_capa" value="{{old('imagem_capa')}}"><br>
    <select name="id_genero">
        @foreach($generos as $genero)
            <option value="{{$genero->id_genero}}">{{$genero->designacao}}</option>
        @endforeach
    </select>
    
    @if ( $errors->has('imagem_capa'))
        devera indicar uma imagem_capa correto<br>
    @endif
Género: <input type="text" name="id_genero" value="{{old('id_genero')}}"><br>
     @if ( $errors->has('id_genero'))
    devera indicar um id_genero<br>
    @endif
Autor: <select name="id_autor[]" multiple="multiple">
            @foreach ($autores as $autor)
                <option value="{{$autor->id_autor}}">
                {{$autor->nome}}</option>
            @endforeach
        </select>
<br>
     @if ( $errors->has('id_autor'))
    devera indicar um is_autor correto<br>
    @endif
Sinopse: <input type="text" name="sinpse" value="{{old('sinopse')}}"><br>
    @if ( $errors->has('sinopse'))
    devera indicar um sinopse correto<br>
    @endif

Editora:
   <select name="id_editora[]" multiple="multiple">
        @foreach($editoras as $editora)
            <option value="{{$editora->id_editora}}">{{$editora->nome}}</option>
        @endforeach
    </select>
pdf:
    <input type="file" name="pdf" value="{{old('pdf')}}"><br>
    @if ( $errors->has('pdf'))
    devera indicar um pdf correto<br>
    @endif
<input type="submit" value="enviar">
</form>