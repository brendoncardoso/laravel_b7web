@extends('site.layout')

@section('title', $page['title'])
@section('description', $page['slug'])
@section('description', $page['slug'])

@section('content')
    <div class="container my-4">
        {!! $page['body'] !!}
    </div>
@endsection