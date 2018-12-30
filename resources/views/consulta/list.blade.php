@extends('layouts.app')

@section('content')
@role('admin')
<div class="container">

    <div class="page-header">
        <h2>Listado de Consultas</h2>
    </div>

    <div>
        @if(empty($consultas))
        <p>No existen consultas</p>
        @else
        <table id="dt" class="table">
            <thead>
                <tr>
                    <th>Medico</th>
                    <th>Paciente</th>
                    <th>Fecha de solicitud</th>
                    <th>Fecha de entrega</th>
                    <th>Estudio</th>
                    <th>Ir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultas as $consulta)
                <tr>
                    <td class="text-capitalize">{{ $consulta->user_medico->name }}</td>
                    <td class="text-capitalize">{{ $consulta->user_paciente->name }}</td>
                    <td>{{ $consulta->fecha_solicitud }}</td>
                    <td>{{ $consulta->fecha_entrega }}</td>
                    <td>
                        @foreach($consulta->radiografias as $radiografia)
                            {{ $radiografia->estudio->descripcion }}
                        @endforeach
                    </td>
                <td><a href="{{ route('consulta-show', ['consulta' => $consulta->id ]) }}">Ir</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>


</div>
@endrole

@role(['medico','paciente'])
<script>window.location = "/";</script>
@endrole


@endsection