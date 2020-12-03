<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;

class AutoresController extends Controller
{
    //
    public function index(){
        //$autores = Autor::all()->sortbydesc('idl');
        $autores= Autor::paginate(4);
        return view('autores.index',[
            'autores'=>$autores
        ]);
    }
    public function show(Request $request){
        $idAutores = $request->ida;
        //$autores=Autor::findOrFail($idAutores);
        //$autores=Autor::find($idAutores);
        $autores=Autor::where('id_autor',$idAutores)->with('livros')->first();
        return view('autores.show',[
            'autores'=>$autores
        ]);
    }
        public function create(){
        return view('autores.create');
    }
    public function store(Request $request){
        $novoAutor = $request->validate([
        'nome'=>['required', 'min:3', 'max:100'],
        'nacionalidade'=>['required', 'min:3', 'max:20'],
        'data_nascimento'=>['nullable', 'date'],
        'fotografia'=>['nullable', 'min:3', 'max:255']
        ]);
         $autor = Autor::create($novoAutor);
        return redirect()->route('autores.show', [
            'ida'=>$autor->id_autor]);
    }
    
        public function edit (Request $request){
        $id = $request->id;
        $autore = autore::where('id_autore',$id)->with(['livros'])->first();
        //dd ($genero);
        return view('autores.edit',[
            'autore'=>$editora
        ]);
    }
    
    public function update (Request $request){
        $id = $request->all();
        $autore = Editorao::findOrFail ($id);
        $updateAutores = $request->validate([
        'nome'=>['required', 'min:3', 'max:100'],
        'morada'=>['required', 'min:3', 'max:255'],
        'observacoes'=>['required', 'min:3', 'max:255']
        ]);
        $autore->update($atualizar<Autore);
        return redirect()->route('autores.show', [ 
        'id'=>$autore->id_autore
        ]);
    }
    
         public function delete (Request $request){
        $autor = Autor::where ('id_autor', $request->id )->first();
        if(is_null($autor)){
            return redirect()->route('autor.index')->with('mensagem','o autor nao existe');
        }
        else
        {
            return view('autores.delete',['autor'=>$autor]);
        }
    }
    public function destroy(Request $request){
        $idAutor = $request->id;
        $autor = Autor::findOrFail($idAutor);
        $autor->delete();
        return redirect()->route('autores.index')->with('mensagem','autor eleminado!');
    }
}
