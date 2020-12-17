<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Editora;
use Auth;

class LivrosController extends Controller
{
    //
    public function index(){
        //$livros = Livro::all()->sortbydesc('idl');
        $livros= Livro::paginate(4);
        return view('livros.index',[
            'livros'=>$livros
        ]);
    }
    public function show(Request $request){
        $idLivro = $request->id;
        //$livro=Livro::findOrFail($idLivro);
        //$livro=Livro::find($idLivro);
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        return view('livros.show',[
            'livro'=>$livro
        ]);
    }
    public function create(){
            $autores = Autor::all();
            $generos = Genero::all();
            $editoras = Editora::all();
        return view('livros.create',[
            'generos'=>$generos,
            'autores'=>$autores,
            'editoras'=>$editoras
        ]);
        
    }
    
    public function store(Request $request){
        //$novoLivo = $request->all();
       //dd ($novoLivo);

        $novoLivro = $request->validate([
            'titulo'=>['required', 'min:3', 'max:100'],
            'idioma'=>['required', 'min:3', 'max:10'],
            'total_paginas'=>['nullable', 'numeric', 'min:1'],
            'data_edicao'=>['nullable', 'date'],
            'isbn'=>['required', 'min:13', 'max:13'],
            'observacoes'=>['nullable', 'min:1', 'max:255'],
            'imagem_capa'=>['nullable', 'min:1', 'max:255'],
            'id_genero'=>['nullable', 'numeric', 'min:10'],
            'sinopse'=>['nullable', 'min:1', 'max:255']
        ]);
                   if(Auth::check()){
               $userAtual = Auth::user()->id;
               $novoLivro['id_user']=$userAtual;
           }
        if (Gate::allows('admin')){
        $autores = $request->id_autor;
        $editoras=$request->id_editora;
        $livro = Livro::create($novoLivro); 
        $livro->autores()->attach($autores);
        $livro->editoras()->attach($editoras);
        return redirect()->route('livros.show', [
            'id'=>$livro->id_livro
        ]);
        }
       
        
    }
    
    public function edit (Request $request){
        $id = $request->id;
        $generos = Genero::all();
        $autores = Autor::all();
        $editoras=Editora::all();
        $livro = livro::where('id_livro',$id)->with(['genero','autores','editoras'])->first();
        $autoresLivros = [];
        //obter id_autor dos autores deste livro
        foreach($livro->autores as $autor){
            $autoresLivros[] = $autor->id_autor;
        }
        $editorasLivro= [];
        foreach($livro->editoras as $editora){
            $editorasLivro[]=$editora->id_editora;
        }
        if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin')){
        if(isset($livro->user->id_user))
        if(auth()->user()->id == $livro->id_user){
            return view('livros.edit', ['livro'=>$livro, 'generos' =>$genero, 'autores'=>$autores, 'autoresLivro'=>$autoresLivros, 'editoras'=>$editoras, 'editorasLivro'=>$editorasLivro]);
        }
        else{
            return view('index');
        }
        else{ 
            return view('livros.edit',['livro'=>$livro, 'generos'=>$generos, 'autores'=>$autores, 'autoresLivro'=>$autoresLivros, 'editoras'=>$editoras, 'editorasLivro'=>$editorasLivro]);
            }
            }
            else{
                return redirect()->route(livros.index)->with('mensagem','Nao tem premissao para aceder a area protegida');
            }
                    
    }
    
    public function update (Request $request){
        $id = $request->id;
        $livro = Livro::findOrFail ($id);
        // dd($request->all());
        $updateLivro = $request->validate([
            'titulo'=>['required', 'min:3', 'max:100'],
            'idioma'=>['required', 'min:3', 'max:10'],
            'total_paginas'=>['nullable', 'numeric', 'min:1'],
            'data_edicao'=>['nullable', 'date'],
            'isbn'=>['required', 'min:13', 'max:13'],
            'observacoes'=>['nullable', 'min:1', 'max:255'],
            'imagem_capa'=>['nullable', 'min:1', 'max:255'],
            'id_genero'=>['nullable', 'numeric'],
            'sinopse'=>['nullable', 'min:1', 'max:255']
        ]);
        // dd($updateLivro);
        if (Gate::allows('admin')){
        $autores=$request->id_autor;
        $editoras=$request->id_editora;
        $livro->update($updateLivro);
        $livro->autores()->sync($autores);
        $livro->editoras()->sync($editoras);
        return redirect()->route('livros.show', [ 
        'id'=>$livro->id_livro
        ]);
        }
    }
        
    

    
    public function delete (Request $request){
        $livro = Livro::where ('id_livro', $request->id )->first();
        if(is_null($livro)){
            return redirect()->route('livros.index')->with('mensagem','o livro nao existe');
        }
        else
        {
            return view('livros.delete',['livro'=>$livro]);
        }
    }
    public function destroy(Request $request){
        $livro= Livro::where('id_livro', $request->id)->first();
        $autoresLivro=Livro::findOrfail($request->id)->autores;
        $editorasLivro=Livro::findOrfail($request->id)->editoras;
        $livro->autores()->detach($autoresLivro);
        $livro->editoras()->detach($editorasLivro);
        if(is_null($livro)){
            return redirect()->route('livros.index')->with('msg','O livro não existe');
        }
        else{
            $livro->delete();
            return redirect()->route('livros.index');
        }
    }
    
    public function comentarios(Request $request){
        $idlivro = $request->id;
        $livro = Livro::findOrfail($request->id)->livros;
        $comentario = $request->validate([
            'comentario'=>['required', 'min:3', 'max:200'] 
        ]);
            
    }
}
