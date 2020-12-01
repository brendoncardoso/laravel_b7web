@extends('layouts.layout')

@section('title', 'Crud')

@section('header', 'Login')

@section('content')

    @if(session('warning'))
        {{session('warning')}}
        <br><br>
    @endif

    <form action="" method="post">
        @csrf

        <input type="email" name="email" id="" placeholder="email"><br><br>
        <input type="password" name="password" id="" placeholder="senha"><br><br>

        <input type="submit" value="Logar">
    </form>

    <br>
        <p>Tentativas: {{$tentativas}}</p>
    <br>
    <a href="/register">Registrar</a>
@endsection