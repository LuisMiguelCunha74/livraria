<h2>deseja eliminar um genero</h2>
<h2>{{$genero->designacao}}</h2>
<form action="{{route('generos.destroy',['id'=>$genero->id_genero])}}" method="post">
@csrf
@method('delete')
<input type="submit" value="enviar">
</form>