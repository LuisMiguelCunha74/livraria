<form action="{{route('livros.store')}}" method="post">
@csrf
Titulo: <input type="text" name="titulo"><br>
Idioma: <input type="text" name="idioma"><br>
Total páginas: <input type="text" name="total_paginas"><br>
Data edição: <input type="text" name="data_edicao"><br>
ISBN: <input type="text" name="isbn"><br>
Observações: <input type="text" name="observações"><br>
Imagem capa: <input type="text" name="imagem_capa"><br>
Género: <input type="text" name="id_genero"><br>
Autor: <input type="text" name="id_autor"><br>
Sinopse: <input type="text" name="sinpse"><br>
<input type="submit" value="enviar">
</form>