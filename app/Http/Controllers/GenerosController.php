<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use Auth;

class GenerosController extends Controller
{
    //
    public function index(){
        //$generos = Genero::all()->sortbydesc('idl');
        $generos= Genero::paginate(4);
        return view('generos.index',[
            'generos'=>$generos
        ]);
    }
    public function show(Request $request){
        $idgenero = $request->idg;
        //$genero=Genero::findOrFail($idgenero);
        //$genero=Genero::find($idgenero);
        $genero=Genero::where('id_genero',$idgenero)->with('livros')->first();
        return view('generos.show',[
            'genero'=>$genero
        ]);
    }
    
     public function create(){
        if (Gate::allows('admin')){
         return view('generos.create');
            }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
        public function store(Request $request){
        if (Gate::allows('admin')){
            $novoGenero = $request->validate([
        'designacao'=>['required', 'min:3', 'max:30'],
        'observacoes'=>['required', 'min:3', 'max:255'],
        ]);
         $genero = Genero::create($novoGenero);
        return redirect()->route('editoras.show', [
            'id'=>$genero->id_genero]);
            }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    
    public function edit (Request $request){
        if (Gate::allows('admin')){
        $id = $request->id;
        $genero = genero::where('id_genero',$id)->first();
        //dd ($genero);
        return view('generos.edit',[
            'genero'=>$genero
        ]);
             }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    
    public function update (Request $request){
        if (Gate::allows('admin')){
        $id = $request->all();
        $genero = Genero::findOrFail ($id);
        $updateGenero = $request->validate([
        'designacao'=>['required', 'min:3', 'max:30'],
        'observacoes'=>['required', 'min:3', 'max:255'],
        ]);
        $genero->update($atualizar<Genero);
        return redirect()->route('generos.show', [ 
        'id'=>$genero->id_genero
        ]);
            }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    
    public function delete (Request $request){
         if (Gate::allows('admin')){
        $genero = Genero::where ('id_genero', $request->id )->first();
        if(is_null($genero)){
            return redirect()->route('generos.index')->with('mensagem','o genero nao existe');
        }
        else
        {
            return view('generos.delete',['genero'=>$genero]);
        }
             }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    public function destroy(Request $request){
        if (Gate::allows('admin')){
        $idGenero = $request->id;
        $genero = Genero::findOrFail($idGenero);
        $genero->delete();
        return redirect()->route('generos.index')->with('mensagem','genero eleminado!');
        }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
        }        
}
