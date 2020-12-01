<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Tarefa;
use Illuminate\Support\Facades\Gate;

class TarefasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function list(Request $request){
        //$user = Auth::user();

        $user = $request->user();

        $userLogged = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'remember_token '=> $user->remember_token,
            'admin' => $user->admin
        ];

        $verifyPermission = Gate::allows('list-form');

        //Query Builder
        //$list = DB::select('SELECT * FROM tarefas');

        //ORM
        $list = Tarefa::all();

        return view('tarefas.list', [
            'list' => $list,
            'userLogged' => $userLogged, 
            'verifyPermission' => $verifyPermission
        ]);
    }

    public function add(){
        return view('tarefas.add');
    }

    public function addAction(Request $request){

        $request->validate([
            'titulo' => ['required', 'string']
        ]);

        $titulo = $request->input('titulo');

        //Query Builder
        //DB::insert('INSERT INTO tarefas (titulo) VALUES (?)', ["$titulo"]);

        //ORM
        $sql = new Tarefa();
        $sql->titulo = $titulo;
        $sql->save();

        return redirect()->route('tarefas.list');
    }

    public function edit($id){

        //Query Builder
        //$item = DB::select('SELECT * FROM tarefas where id = ?', [$id]);
        /*if(count($item) > 0){
            return view('tarefas.edit', [
                "item" => $item[0]
            ]);
        }else{
            return redirect()->route('tarefas.list');
        }*/

        //ORM
        $item = Tarefa::find($id);

        if($item){
            return view('tarefas.edit', [
                "item" => $item 
            ]);
        }else{
            return redirect()->route('tarefas.list');
        }
        
    }

    public function editAction(Request $request, $id){
        $request->validate([
            'titulo' => ['required', 'string']
        ]);

        $titulo = $request->input('titulo');

        //Query Builder
        //DB::update('UPDATE tarefas SET titulo = ? WHERE id = ?', ["$titulo", $id]);

        //ORM
        $sql = Tarefa::find($id);
        $sql->titulo = $titulo;
        $sql->save();

        return redirect()->route('tarefas.list');
    }

    public function delete($id){

        //Query Builder
        //DB::delete('DELETE FROM tarefas WHERE id = ?', [$id]);

        //ORM
        $sql = Tarefa::find($id)->delete();
        return redirect()->route('tarefas.list');
    }

    public function done($id){

        //Query Builder
        //DB::update('UPDATE tarefas SET status = ? WHERE id = ?', [0, $id]);

        //ORM
        Tarefa::find($id)->update([
            'status' => '0'
        ]);
        return redirect()->route('tarefas.list');
    }

    public function undone($id){

        //Query Builder
        //DB::update('UPDATE tarefas SET status = ? WHERE id = ?', [1, $id]);

        //ORM
        Tarefa::find($id)->update([
            'status' => '1'
        ]);
        return redirect()->route('tarefas.list');
    }
}
