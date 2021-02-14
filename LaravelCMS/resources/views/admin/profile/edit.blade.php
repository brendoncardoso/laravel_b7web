
@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edição do Perfil do Usuário</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <!--<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>-->
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
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Formulário</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->        
                    <form action="{{route('profile_save')}}" method="POST">
                        @method('PUT')
                        @csrf
            
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nome:</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="" placeholder="Nome Completo" value="{{old('name', $user->name)}}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email:</label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="" placeholder="email@email.com" value="{{old('email', $user->email)}}" {{Auth::user()->email != $user->email ? 'disabled' : ''}}>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Telefone:</label>
                                <input id="telephone" type="text" name="telephone" class="form-control " id="" placeholder="(XX) XXXXX-XXXX" value="{{old('telephone', $user->telephone)}}">
                            </div>
                            <div class="form-group">
                                <label for="">Senha</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="****" value="">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Confirmar Senha:</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="" placeholder="****" value="">
                                @if($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <!--<div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                </div>
                            </div>-->
                            <!--<div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>-->
                            </div>
                            <!-- /.card-body -->
            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" style='float:right'>Cadastrar</button>
                            </div>
                    </form>
                    </div>
                    <!-- /.card -->
                </div>
            
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

    