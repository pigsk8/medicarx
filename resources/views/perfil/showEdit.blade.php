@extends('layouts.app')

@section('content')

<div class="container">

@if ( Auth::user()->id == $user->id || $isAdmin )

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="page-header">
    <h3>Editar perfil - <span class="text-capitalize">{{ $user->name }}</span></h3>
</div>

<div class="row">

    <div class="col-sm-6">

        <div class="panel panel-default">
            <div class="panel-heading">Actualizar perfil</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="/perfil" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nombre completo</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
                        <label for="ci" class="col-md-4 control-label">Cedula de identidad</label>

                        <div class="col-md-6">
                            <input id="ci" type="text" class="form-control" name="ci" value="{{$user->ci}}" required>

                            @if ($errors->has('ci'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ci') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username" class="col-md-4 control-label">Nombre de usuario</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" required>

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Correo electronico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @role('admin') 
                    @if ($roles)
                    <div class="form-group">
                        <label for="role" class="col-md-4 control-label">Rol</label>

                        
                        <div class="col-md-6">
                            <select class="form-control" name="role" id="role">
                                <option value="0"></option>
                                @foreach($roles as $rol)
                                <option value="{{$rol->id}}" {{ $user->hasRole($rol->name) ? 'selected' : '' }}> {{ $rol->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    @endrole

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Actualizar preguntas</div>
            <div class="panel-body">
                <div class="col">
                    <p>
                        @if($hasQuestions)
                            El usuario ya tiene respuestas asociadas
                        @else
                            No tiene respuestas de seguridad
                        @endif
                    </p>
                </div>
                <form class="form-horizontal" method="POST" action="/perfil-preguntas">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <div class="form-group">
                        <p class="col-md-4 control-label">Preguntas</p> 
                    </div> 

                    @forelse($questions as $pregunta)       
                    <div class="form-group{{ $errors->has('pregunta'.$pregunta->id) ? ' has-error' : '' }}">

                        <label for="pregunta{{$pregunta->id}}" class="col-md-4 control-label">{{ $pregunta->descripcion }}</label>
                    
                        <div class="col-md-6">
                            <input id="pregunta{{$pregunta->id}}" type="text" class="form-control" name="pregunta{{$pregunta->id}}" value="" required>
                            @if ($errors->has('pregunta{{$pregunta->id}}'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pregunta'.$pregunta->id) }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="form-group">
                    No hay preguntas de seguridad
                    </div>
                    @endforelse

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                        </div>
                    </div>

                </form> 
            </div>
        </div>

        @role('admin') 
        <div class="panel panel-default">
            <div class="panel-heading">Actualizar estado</div>
            <div class="panel-body">
                <div class="col">
                    <p>
                        Estado actual: {{$user->estado_usuario->descripcion}}
                    </p>
                </div>
                <form class="form-horizontal" method="POST" action="{{Route('edit-perfil-estado')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="form-group">

                        <label for="estado_user" class="col-md-4 control-label">Seleccionar estado</label>
                        <div class="col-md-6">
                            <select name="estado_user" id="estado_user" class="form-control">
                            
                            @forelse($estados as $estado)       
                                    <option value="{{$estado->id}}" @if($user->estado_usuario_id == $estado->id)  {{'selected'}} @endif>{{$estado->descripcion}}</option>
                            @empty
                                No hay estados
                            @endforelse

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Actualizar
                            </button>
                        </div>
                    </div>

                </form> 
            </div>
        </div>
        @endrole

    </div>

</div>

@else
<script>window.location = "/";</script>
@endif

</div>
@endsection