<h2>deseja eliminar o livro</h2>
<h2>{{$livro->titulo}}</h2>
<form action="{{route('livros.destroy',['id'=>$livro->id_livro])}}" method="post">
@csrf
@method('delete')
<input type="submit" value="enviar">
<input type="button">
</form>