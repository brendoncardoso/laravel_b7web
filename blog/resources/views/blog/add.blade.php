@extends('layouts.layout')

@section('title', 'Crud')

@section('header', 'Adicionar Tarefa')

@section('content')
    <a href="{{route('tarefas.list')}}">Voltar</a>
    <br>
    <br>

    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
            <br>
            <br>
        @endforeach
    @endif

    <form action="" method="post">
        @csrf
        <input type="text" name='titulo' valeu=''>

        <input type="submit" value="Cadastrar">
    </form>
@endsection