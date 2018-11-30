@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Reestablecer contraseña</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar enlace de reestablecer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Preguntas</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.question') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @forelse($preguntas as $pregunta) 
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
                        No hay preguntas
                        @endforelse

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Validar cambio de contraseña
                                </button>
                            </div>
                        </div>

                        @if ( $errors->count() > 0 )
                            <div class="alert alert-danger">
                                <p>{{$errors->first()}}</p>
                            </div>  
                        @endif

                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
