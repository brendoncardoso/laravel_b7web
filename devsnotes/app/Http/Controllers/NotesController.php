<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Note;

class NotesController extends Controller
{
    private $array = ['errors' => '', 'result' => []];
    //
    public function all(){
        $notes = Note::all();

        foreach($notes as $note){
            $this->array['result'][] = [
                'id' => $note->id,
                'title' => $note->title
            ];
        }

        return $this->array;
    }

    public function one($id){
        $notes = Note::find($id);

        if($notes){
            $this->array['result'] = $notes;
        }else{
            $this->array['errors'] = true;
        }

        return $this->array;
    }

    public function deleteNote($id){
        $note = Note::find($id);

        if($note){
            $this->array['result'][] = "O ID: $id foi deletado";
            $note->delete();
        }else{
            $this->array['errors'] = true;
        }

        return $this->array;
    }

    public function new(Request $request){
        $title = $request->input('title');
        $body = $request->input('body');

        if($title && $body){
            $new = new Note();
            $new->title = $title;
            $new->body = $title;
            $new->save();

            $this->array['result'] = [
                'id' => $new->id,
                'title' => $new->title,
                'bdoy' => $new->body
            ];
        }else{
            $this->array['errors'] = true;
        }

        return $this->array;
    }

    public function edit(Request $request, $id){
        $notes = Note::find($id);

        $title = $request->input('title');
        $body = $request->input('body');

        if($notes){
            if($title && $body){
                $notes->title = $title;
                $notes->body = $body;
                $notes->save();
    
                $this->array['result'] = [
                    'id' => $notes->id,
                    'title' => $notes->title,
                    'bdoy' => $notes->body
                ];
            }else{
                $this->array['errors'] = true;
            }
        }else{
            $this->array['errors'] = true;
        }

        return $this->array;
    }
}
