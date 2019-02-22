@extends('layouts.app')

@section('content')

<div class="container">

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if ($errors->has('diagnostico'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('diagnostico') }}
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Información de consulta</h3>
        </div>
        <div class="panel-body">
            <p>Medico: <span class="text-capitalize">{{ $consulta->user_medico->name }}</span></p>
            <p>Paciente: <span class="text-capitalize">{{ $consulta->user_paciente->name }}</span></p>
            <p>Fecha de solicitud: {{ $consulta->fecha_solicitud }}</p>
            <p>Fecha de entrega: {{ $consulta->fecha_entrega }}</p>
        </div>
    </div>

    <h2>Visor de Radiografías</h2>

    <div class="viewer-container">
        <ul class="nav nav-tabs">
            <?php $cont_rad=0 ?>
            @foreach($consulta->radiografias as $radiografia)
            <li class="{{ ($cont_rad==0) ? 'active' : '' }}">
                <a data-toggle="tab" href="#rad-{{$cont_rad+1}}">
                    <img src="{{ Storage::url($radiografia->ruta_img) }}" alt="" width="150px" height="auto">
                </a>
            </li>
            <?php $cont_rad++ ?>
            @endforeach
        </ul>

        <div class="tab-content">
            <?php $cont_rad=0 ?>
            @foreach($consulta->radiografias as $radiografia)
                <div id="rad-{{$cont_rad+1}}" class="tab-pane fade in {{ ($cont_rad==0) ? 'active' : '' }} viewer-item">
                    <p>Tipo de estudio: <span class="text-capitalize">{{$radiografia->estudio->descripcion}}</span></p>
                    <figure>
                        <img src="{{ Storage::url($radiografia->ruta_img) }}" alt="" width="40%">
                    </figure> 
                    <br>
                    <a href="{{ Storage::url($radiografia->ruta_img) }}" download>
                        <button type="submit" class="btn btn-default">Descargar</button>
                    </a>
                </div>
            <?php $cont_rad++ ?>
            @endforeach
        </div>

    </div>

    <br><br>

    @role('medico')
    <form action="{{ Route('consulta-save-diagnostico', ['consulta' => $consulta->id ]) }}" method="POST">
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <label for="diagnostico">Diagnostico:</label>            
        </div>
        <div class="panel-body">
            <div class="form-group">
            <textarea class="form-control" name="diagnostico" id="diagnostico" rows="5" style="resize: none;">{{$consulta->diagnostico}}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Enviar</button>
        </div>
    </div>
    </form>
    @endrole

    @role(['admin','paciente'])
    <div class="panel panel-default">
        <div class="panel-heading">
            <label for="diagnostico">Diagnostico:</label>            
        </div>
        <div class="panel-body">
            @empty($consulta->diagnostico)
                No hay diagnostico
            @else
                {{$consulta->diagnostico}}
            @endempty
                
        </div>
    </div>
    @endrole




</div>

@endsection