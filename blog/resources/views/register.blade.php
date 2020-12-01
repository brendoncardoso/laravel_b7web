@extends('layouts.layout')

@section('title', 'Crud')

@section('header', 'Registrar')

@section('content')

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li><br>
            @endforeach
        </ul>       
    @endif

    <form action="" method="post">
        @csrf

    <input type="text" name="name" id="" placeholder="Nome" value="{{old('name')}}"><br><br>
        <input type="email" name="email" id="" placeholder="Email" value="{{old('email')}}"><br><br>
        <input type="password" name="password" id="" placeholder="Senha" value="{{old('password')}}"><br><br>
        <input type="password" name="password_confirmation" id="" placeholder="Confirmar Senha" value="{{old('password_confirmation')}}"><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <br>
    <a href="/login">Logar</a>
@endsection