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
        if (Gate::allows('admin')){
            return view('editoras.create');
        }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
        public function store(Request $request){
        if (Gate::allows('admin')){
            $novoEditoras = $request->validate([
        'nome'=>['required', 'min:3', 'max:100'],
        'morada'=>['required', 'min:3', 'max:255'],
        'observacoes'=>['required', 'min:3', 'max:255']
        ]);
         $editora = Editora::create($novoEditoras);
        return redirect()->route('editoras.show', [
            'ide'=>$editora->id_editora]);
    }
        }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    
    public function edit (Request $request){
        if (Gate::allows('admin')){
        $id = $request->id;
        $editora = editora::where('id_editora',$id)->with(['livros'])->first();
        //dd ($genero);
        return view('editoras.edit',[
            'editora'=>$editora
        ]);
            }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    
    public function update (Request $request){
        if (Gate::allows('admin')){
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
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    
     public function delete (Request $request){
        if (Gate::allows('admin')){
         $editora = Editora::where ('id_editora', $request->id )->first();
        if(is_null($editora)){
            return redirect()->route('editoras.index')->with('mensagem','A editora nao existe');
        }
        else
        {
            return view('editoras.delete',['editora'=>$editora]);
        }
            }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
    }
    public function destroy(Request $request){
        if (Gate::allows('admin')){
        $idEditora = $request->id;
        $editora = Editora::findOrFail($idEditora);
        $editora->delete();
        return redirect()->route('editoras.index')->with('mensagem','editora eleminado!');
    }
        }
        else{
            return redirect()->route('livros.index')->with('mensagem','Nao tem permissão para aceder a area pretendida');
        }
}
