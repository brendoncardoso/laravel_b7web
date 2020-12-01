@extends('layouts.layout')

@section('title', 'Crud')

@section('header', 'Lista de Tarefas')

@section('content')

    <a href="{{route('tarefas.add')}}">Adicionar nova tarefa</a>

    <br>
    <br>

    <table border="1" style='text-align:center'>
        @if(count($list) > 0)
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Resolvido</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->titulo}}</td>
                        <td>
                            @if($item->status == 1)
                                Não Resolvido
                            @else 
                                Resolvido
                            @endif
                        </td>
                        <td>
                            @if($item->status == 1)
                                <a href="{{route('tarefas.done', ['id' => $item->id])}}">[Marcar]</a>
                            @else 
                                <a href="{{route('tarefas.undone', ['id' => $item->id])}}">[Desmarcar]</a>
                            @endif
                            
                            <a href="{{route('tarefas.edit', ['id' => $item->id])}}">[Editar]</a>
                            <a href="{{route('tarefas.delete', ['id' => $item->id])}}}">[Excluir]</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @else
            Não há registros na tabela.
        @endif
    </table>
@endsection

