<div class="panel panel-default">
    <div class="panel-heading">Registrar</div>

    <div class="panel-body">
        @if (Auth::guest())
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        @else
        @role('admin')
        <form class="form-horizontal" method="POST" action="/registro">
        @endrole
        @endif
        {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre completo</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                    <input id="ci" type="text" class="form-control" name="ci" value="{{ old('ci') }}" required>

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
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required maxlength="20">

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
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Contraseña</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            @role('admin') 
            @if ($roles)
            <div class="form-group">
                <label for="role" class="col-md-4 control-label">Rol</label>

                <div class="col-md-6">
                    <select class="form-control" name="role" id="role" required>
                        @foreach($roles->sortByDesc('display_name') as $rol)
                        <option value="{{$rol->id}}">{{$rol->display_name}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            @endif
            @endrole

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>