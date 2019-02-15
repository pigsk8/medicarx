@extends('layouts.app')

@section('content')
@role('admin')
<div class="container">

    <div class="page-header">
        <h2>Crear Consulta</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
    @endif
    

    <form action="{{ route('consulta-save') }}" method="POST" enctype="multipart/form-data" id="form-upload-file">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="select-paciente">Seleccione paciente:</label>
            <select class="selectpicker form-control text-capitalize" data-live-search="true" name="paciente" id="select-paciente">
                @foreach ($users as $user)
                    @if ($user->roles->get(0)['name'] == 'paciente')
                    <option 
                        data-tokens="{{ $user->ci }} {{ $user->username }}" 
                        value="{{ $user->id }}"
                        class="text-capitalize"                    
                    >{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="select-medico">Seleccione medico:</label>
            <select class="selectpicker form-control text-capitalize" data-live-search="true" name="medico" id="select-medico">
                @foreach ($users as $user)
                    @if ($user->roles->get(0)['name'] == 'medico')
                    <option 
                        data-tokens="{{ $user->ci }} {{ $user->username }}" 
                        value="{{ $user->id }}" 
                        class="text-capitalize"                    
                    >{{ $user->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="multiple-file">
            <div class="item-file">

                <div class="form-group">
                    <label>Subir imagen radiografica:</label>
                    <input type="file" class="form-control-file" name="img-rad[]">
                    <div id="name-file"></div>
                </div>
                <div class="form-group">
                    <label for="select-estudio">Seleccione tipo de estudio:</label>
                    <select class="form-control text-capitalize" name="estudio[]" id="select-estudio">
                        @foreach ($estudios as $estudio)
                            <option value="{{ $estudio->id }}" {{ (old("estudio") == $estudio->id ? "selected":"") }} class="text-capitalize">{{ $estudio->descripcion }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div class="add-new-file">
            <span>Agregar nuea imagen radiografica </span>
                <button class="btn btn-info btn-add-file" data-route="{{ route('estudio.list') }}">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </div>

        <button type="submit" class="btn btn-default">Crear</button>

    </form>

    <br>
    @if($errors->any())   
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

</div>
@endrole

@role(['medico','paciente'])
<script>window.location = "/";</script>
@endrole


@endsection