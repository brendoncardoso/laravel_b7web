@extends('adminlte::page')

{{--@section('content_header')
    <h1>Cadastro de Usuários</h1>
@endsection--}}

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Configurações do Site</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
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

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            <h5>Ocorreu um Erro!</h5>
                            @foreach($errors->all() as $errors)
                                <li>{{$errors}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            
                <form action="{{route('settings_save')}}" method="POST" class="form-horizontal">
                    @method('PUT')
                    @csrf
        
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulário</h3>
                        </div>
                            <div class="card-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="" placeholder="Título" value="{{old('title', $setting['title'])}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Subtítulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="subtitle" class="form-control" id="" placeholder="Subtítulo" value="{{old('subtitle', $setting['subtitle'])}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">E-mail para Contato:</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="" placeholder="E-mail" value="{{old('email', $setting['email'])}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Cor do Fundo:</label>
                                <div class="col-sm-1">
                                    <input type="color" name="bgcolor" class="form-control" id="" placeholder="" value="{{old('bgcolor', $setting['bgcolor'])}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Cor do Texto:</label>
                                <div class="col-sm-1">
                                    <input type="color" name="textcolor" class="form-control" id="" placeholder="" value="{{old('textcolor', $setting['textcolor'])}}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <!--<div class="card-footer">
              Footer
            </div>-->
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
@endsection


    