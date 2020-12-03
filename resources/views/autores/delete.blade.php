<h2>deseja eliminar um genero</h2>
<h2>{{$autor->nome}}</h2>
<form action="{{route('autores.destroy',['id'=>$autor->id_autor])}}" method="post">
@csrf
@method('delete')
<input type="submit" value="enviar">
</form>