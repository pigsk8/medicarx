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

</div>

<div class="container-fluid">
    <div class="viewer-container">
        <ul class="nav nav-tabs list-rad">
            <?php $cont_rad=0 ?>
            @foreach($consulta->radiografias as $radiografia)
            <li class="{{ ($cont_rad==0) ? 'active' : '' }} list-rad-item">
                <a data-toggle="tab" href="#rad-{{$cont_rad+1}}">
                    <img src="{{ Storage::url($radiografia->ruta_img) }}">
                    <p class="text-center"><span class="text-capitalize">{{$radiografia->estudio->descripcion}}</span></p>
                </a>
            </li>
            <?php $cont_rad++ ?>
            @endforeach
        </ul>

        <div class="tab-content">
            <?php $cont_rad=0 ?>
            @foreach($consulta->radiografias as $radiografia)
                <div id="rad-{{$cont_rad+1}}" class="tab-pane fade in {{ ($cont_rad==0) ? 'active' : '' }} viewer-item">
                    <div class="content-img">
                        <div class="controls">
                            <h3>Controles del visor</h3>
                            <div class="btn btn-default control" data-control="control-zoom">
                                <span title="Realiza el zoom pasando el mouse por encima">Zoom</span>    
                            </div>
                            {{-- <div class="btn btn-default control" data-control="control-pan">
                                <span title="Mueve la imagen con click">Mover</span>    
                            </div> --}}
                            <div class="btn btn-default control" data-control="control-glass">
                                <span title="Mueve la lupa con click">Lupa</span>    
                            </div>
                            <div class="btn btn-default control" data-control="control-invert">
                                <span title="Aplica negativo a la imagen">Invertir</span>    
                            </div>
                            

                            {{-- Rotate --}}
                            <div class="btn btn-default control" data-control="control-rotate-horizontal">
                                <span title="Mueve la imagen con click">Voltear</span> 
                                <span class="glyphicon glyphicon-resize-horizontal"></span>    
                            </div>
                            <div class="btn btn-default control" data-control="control-rotate-vertical">
                                <span title="Mueve la imagen con click">Voltear</span>
                                <span class="glyphicon glyphicon-resize-vertical"></span>    
                            </div>
                            <div class="btn btn-default control" data-control="control-rotate-right">
                                <span title="Mueve la imagen con click">Rotar</span>   
                                <span class="glyphicon glyphicon-repeat"></span>    

                            </div>
                            <div class="btn btn-default control" data-control="control-rotate-left">
                                <span title="Mueve la imagen con click">Rotar</span>  
                                <span class="glyphicon glyphicon-repeat icon-left"></span>    
                            </div>

                        </div>
                        <div class="controls-bar">
                            <div class="control-zoom-bar">
                                <h4>Opciones del zoom</h4>
                                <div class="btn btn-default control-zoom" data-zoom="1">
                                    <span>Zoom 1</span>    
                                </div>
                                <div class="btn btn-default control-zoom" data-zoom="1.2">
                                    <span>Zoom 2</span>    
                                </div>
                                <div class="btn btn-default control-zoom" data-zoom="1.4">
                                    <span>Zoom 3</span>    
                                </div>
                                <div class="btn btn-default control-zoom" data-zoom="1.6">
                                    <span>Zoom 4</span>    
                                </div>
                                <div class="btn btn-default control-zoom" data-zoom="1.8">
                                    <span>Zoom 5</span>    
                                </div>
                            </div>
                        </div>
                        
                        {{-- <div class="magnify">
                            <div class="magnify_glass"></div>
                            <div class = "element_to_magnify">
                                <img src="{{ Storage::url($radiografia->ruta_img) }}" draggable="false">
                            </div>
                        </div> --}}
                                        
                        <div class="figure magnify">

                            <div class="magnify_glass"></div>

                            <div class="element_to_magnify">
                                <div class="img-move">
                                    <div class="img-rotate">
                                        <div class="img-flip-vert">
                                            <div class="img-flip-hor">
                                                <figure>
                                                    <img src="{{ Storage::url($radiografia->ruta_img) }}" draggable="false">
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div> 
                    <br>
                    <a href="{{ Storage::url($radiografia->ruta_img) }}" download>
                        <button type="submit" class="btn btn-default">Descargar</button>
                    </a>
                </div>
            <?php $cont_rad++ ?>
            @endforeach
        </div>

    </div>

</div>
<br><br>
<div class="container">

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