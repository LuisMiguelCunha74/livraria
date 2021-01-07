<form action="{{route('livros.update',['id'=>$livro->id_livro])}}" enctype="multipart/form-data" method="post">
@method('patch')    
@csrf
Titulo: <input type="text" name="titulo" value="{{$livro->titulo}}"><br>
    @if ( $errors->has('titulo'))
    devera indicar um titulo correto<br>
    @endif
Idioma: <input type="text" name="idioma" value="{{$livro->idioma}}"><br>
    @if ( $errors->has('idioma'))
    devera indicar um idioma correto<br>
    @endif
Total páginas: <input type="text" name="total_paginas" value="{{$livro->total_paginas}}"><br>
    @if ( $errors->has('total_paginas'))
    devera indicar um total_paginas correto<br>
    @endif
Data edição: <input type="date" name="data_edicao" value="{{$livro->data_edicao}}"><br>
    @if ( $errors->has('data_edicao'))
    devera indicar um data_edicao correto<br>
    @endif
ISBN: <input type="text" name="isbn" value="{{$livro->isbn}}"><br>
     @if ( $errors->has('isbn'))
    devera indicar um isbn correto(13 caracteres)<br>
    @endif
Observações: <input type="text" name="observacoes" value="{{$livro->observacoes}}"><br>
     @if ( $errors->has('observacoes'))
    devera indicar um observacoes correto<br>
    @endif
Imagem capa: <input type="file" name="imagem_capa" value="{{$livro->imagem_capa}}"><br>
     @if ( $errors->has('imagem_capa'))
    devera indicar uma imagem_capa correto<br>
    @endif

Género:
            <select name="id_genero">
        @foreach($generos as $genero)
            <option value="{{$genero->id_genero}}" @if($genero->id_genero==$livro->id_genero)selected @endif>{{$genero->designacao}}</option>
        @endforeach
     @if ( $errors->has('id_genero'))
    devera indicar um id_genero<br>
    @endif
    </select>
    <br>
Autor:
         <select name="id_autor[]" multiple="multiple">
            @foreach ($autores as $autor)
                <option value="{{$autor->id_autor}}" @if(in_array($autor->id_autor, $autoresLivro))selected @endif>
                {{$autor->nome}}
                </option>
            @endforeach
        </select>
        <br>
    @if ( $errors->has('id_autor'))
        devera indicar um is_autor correto<br>
    @endif
Sinopse: <input type="text" name="sinopse" value="{{$livro->sinopse}}"><br>
    @if ( $errors->has('sinopse'))
    devera indicar um sinopse correto<br>
    @endif

Editora: 
   <select name="id_editora[]" multiple="multiple">
        @foreach($editoras as $editora)
            <option value="{{$editora->id_editora}}"@if(in_array($editora->id_editora, $editorasLivro))selected @endif>{{$editora->nome}}</option>
        @endforeach
    </select>   
    <br>
    <input type="submit" value="enviar">
</form>