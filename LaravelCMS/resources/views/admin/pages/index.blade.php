@extends('adminlte::page')

@section('title', 'Minhas Páginas')

@section('content')
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Lista de Páginas</h3>
            <a href="{{route('pages_cadaster_get')}}">
                <button type="button" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Nova Página</button>
            </a>
        </div>
        
        <div class="card-body">
            <div class="col-sm-12">
                @if(session('warning'))
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible text-white">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="fas fa-exclamation-triangle"></i> Atenção!</h4>
                            {{session('warning')}}
                        </div>
                    </div>
                @elseif(session('success'))
                    <div class="box-body">
                        <div class="alert alert-success alert-dismissible text-white">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="fas fa-check"></i> Sucesso!</h4>
                            {{session('success')}}
                        </div>
                    </div>
                @endif
            </div>
            
            @if(count($pages))
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Título</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{$page->id}}</td>
                                <td>{{$page->title}}</td>
                                <td class='text-center'>
                                    <a href="{{route('page-edit', $page->id)}}">
                                        <button type="button" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{route('page-detele', $page->id)}}">
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="box-body">
                    <div class="alert alert-warning alert-dismissible text-white">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="fas fa-exclamation-triangle"></i> Atenção!</h4>
                        Nenhum registro foi cadastrado.
                    </div>
                </div>
            @endif
        </div>
        <!-- /.card-body -->
        @if(count($pages) >= 10)
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{$pages->links()}}
                </ul>
            </div>
        @endif
  </div>
@endsection