@extends('layouts.app')

@section('content')
@role('admin')
<div class="container">

    <div>
        <h2>Crear Consulta</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <form action="{{ route('consulta-save') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="select-paciente">Seleccione paciente:</label>
            <select class="selectpicker form-control" data-live-search="true" name="paciente" id="select-paciente">
                @foreach ($users as $user)
                    @if ($user->roles->get(0)['name'] == 'paciente')
                    <option data-tokens="{{ $user->ci }} {{ $user->username }}" value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="select-medico">Seleccione medico:</label>
            <select class="selectpicker form-control" data-live-search="true" name="medico" id="select-medico">
                @foreach ($users as $user)
                    @if ($user->roles->get(0)['name'] == 'medico')
            <option data-tokens="{{ $user->ci }} {{ $user->username }}" value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="select-fecha">Subir imagen radiografica:</label>
            <input type="file" class="form-control-file" name="img-rad">
        </div>

        <div class="form-group">
            <label for="select-estudio">Seleccione tipo de estudio:</label>
            <select class="form-control" name="estudio" id="select-estudio">
                @foreach ($estudios as $estudio)
                    <option value="{{ $estudio->id }}">{{ $estudio->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-default">Crear</button>

    </form>


</div>
@endrole

@role(['medico','paciente'])
<script>window.location = "/";</script>
@endrole


@endsection