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
        return view('generos.create');
    }
        public function store(Request $request){
        $novoGenero = $request->validate([
        'designacao'=>['required', 'min:3', 'max:30'],
        'observacoes'=>['required', 'min:3', 'max:255'],
        ]);
         $genero = Genero::create($novoGenero);
        return redirect()->route('editoras.show', [
            'id'=>$genero->id_genero]);
    }
    
    public function edit (Request $request){
        $id = $request->id;
        $genero = genero::where('id_genero',$id)->first();
        //dd ($genero);
        return view('generos.edit',[
            'genero'=>$genero
        ]);
    }
    
    public function update (Request $request){
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
    
    public function delete (Request $request){
        $genero = Genero::where ('id_genero', $request->id )->first();
        if(is_null($genero)){
            return redirect()->route('generos.index')->with('mensagem','o genero nao existe');
        }
        else
        {
            return view('generos.delete',['genero'=>$genero]);
        }
    }
    public function destroy(Request $request){
        $idGenero = $request->id;
        $genero = Genero::findOrFail($idGenero);
        $genero->delete();
        return redirect()->route('generos.index')->with('mensagem','genero eleminado!');
    }
}
