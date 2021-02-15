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
                <h3 class="card-title">Editar Página</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                </div>
                <a href="{{route('pages')}}">
                    <button type="" class="btn btn-danger float-right"><i class="fa fa-arrow-left"></i> Voltar</button>
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
              
            
                <form action="{{route('page-update', $page->id)}}" method="POST" class="form-horizontal">
                    @csrf
        
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Formulário</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-1 col-form-label">Título:</label>
                                <div class="col-sm-11">
                                    <input type="text" name="title" class="form-control" id="" placeholder="Título" value="{{old('title', $page->title)}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Texto:</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control bodyfield" name="body" id="" cols="30" rows="10" placeholder="">{{old('body', $page->body)}}</textarea>
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

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.bodyfield',
            height: 300,
            plugins: ['link', 'table', 'image', 'autoresize', 'lists'],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullpage | ' +
                'forecolor backcolor emoticons | help',
            menubar: false,
            content_css:  '{{asset('assets/css/content.css')}}',
            images_upload_url: '{{route('imageupload')}}',
            images_upload_credentials: true,
            convert_urls: false
        });
    </script>

@endsection


