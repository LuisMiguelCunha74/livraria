<h2>deseja eliminar um genero</h2>
<h2>{{$editora->nome}}</h2>
<form action="{{route('editoras.destroy',['id'=>$editora->id_editora])}}" method="post">
@csrf
@method('delete')
<input type="submit" value="enviar">
</form>