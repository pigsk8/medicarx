@extends('layouts.app')

@section('content')

<div class="container">
  
<?php 
  $rolesUser = Auth::user()->roles()->get(); 
  $isAdmin = false;
?> 

@forelse( $rolesUser as $role )
  @if($role->name == 'admin')
    <?php $isAdmin = true ?>
  @endif
@empty
  <?php $isAdmin = false ?>
@endforelse

@if ( Auth::user()->id == $user->id || $isAdmin )

<h3>Editar perfil, usuario <span class="text-capitalize">{{ $user->name }}</span></h3>

<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
    <div class="panel-heading">Actualizar perfil</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="/perfil">
        {{ csrf_field() }}

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
              <label for="preguntas" class="col-md-4 control-label">Preguntas</label> 
            </div> 

            @forelse($questions as $pregunta)
            <div class="form-group{{ $errors->has('pregunta'.$pregunta->id) ? ' has-error' : '' }}">
              <label for="pregunta{{$pregunta->id}}" class="col-md-4 control-label">{{ $pregunta->descripcion }}</label>
              
              <div class="col-md-6">
                  <input id="pregunta{{$pregunta->id}}" type="text" class="form-control" name="pregunta{{$pregunta->id}}" value="" required>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
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
</div>
</div>

@else
<script>window.location = "/";</script>
@endif

</div>
@endsection