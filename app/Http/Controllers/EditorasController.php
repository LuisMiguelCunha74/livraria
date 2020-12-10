<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editora;
use Auth;

class EditorasController extends Controller
{
    //
    public function index(){
        //$editoras = Editora::all()->sortbydesc('idl');
        $editoras= Editora::paginate(4);
        return view('editoras.index',[
            'editoras'=>$editoras
        ]);
    }
    public function show(Request $request){
        $idEditora = $request->ide;
        //$editora=Editora::findOrFail($idEditora);
        //$editora=Editora::find($idEditora);
        $editora=Editora::where('id_editora',$idEditora)->with('livros')->first();
        return view('editoras.show',[
            'editora'=>$editora
        ]);
    }
        public function create(){
        return view('editoras.create');
    }
        public function store(Request $request){
        $novoEditoras = $request->validate([
        'nome'=>['required', 'min:3', 'max:100'],
        'morada'=>['required', 'min:3', 'max:255'],
        'observacoes'=>['required', 'min:3', 'max:255']
        ]);
         $editora = Editora::create($novoEditoras);
        return redirect()->route('editoras.show', [
            'ide'=>$editora->id_editora]);
    }
    
    public function edit (Request $request){
        $id = $request->id;
        $editora = editora::where('id_editora',$id)->with(['livros'])->first();
        //dd ($genero);
        return view('editoras.edit',[
            'editora'=>$editora
        ]);
    }
    
    public function update (Request $request){
        $id = $request->all();
        $editora = Editora::findOrFail ($id);
        $updateEditora = $request->validate([
        'nome'=>['required', 'min:3', 'max:100'],
        'morada'=>['required', 'min:3', 'max:255'],
        'observacoes'=>['required', 'min:3', 'max:255']
        ]);
        $editora->update($atualizar<Editora);
        return redirect()->route('editoras.show', [ 
        'id'=>$editora->id_editora
        ]);
    }
    
     public function delete (Request $request){
        $editora = Editora::where ('id_editora', $request->id )->first();
        if(is_null($editora)){
            return redirect()->route('editoras.index')->with('mensagem','A editora nao existe');
        }
        else
        {
            return view('editoras.delete',['editora'=>$editora]);
        }
    }
    public function destroy(Request $request){
        $idEditora = $request->id;
        $editora = Editora::findOrFail($idEditora);
        $editora->delete();
        return redirect()->route('editoras.index')->with('mensagem','editora eleminado!');
    }
}
