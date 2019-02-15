@extends('layouts.app')

@section('content')
@role('admin')
<div class="container">

    <div class="page-header">
        <h2>Listado de Consultas</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div>
        @if(empty($consultas))
        <p>No existen consultas</p>
        @else
        <table id="dt" class="table">
            <thead>
                <tr>
                    <th class="td-id">Id</th>
                    <th>Medico</th>
                    <th>Paciente</th>
                    <th>Fecha de solicitud</th>
                    <th>Fecha de entrega</th>
                    <th>Estudio</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($consultas as $consulta)
                <tr>
                    <td class="td-id">{{ $consulta->id }}</td>
                    <td class="text-capitalize">{{ $consulta->user_medico->name }}</td>
                    <td class="text-capitalize">{{ $consulta->user_paciente->name }}</td>
                    <td>{{ $consulta->fecha_solicitud }}</td>
                    <td>{{ $consulta->fecha_entrega }}</td>
                    <td class="text-capitalize">
                        @foreach($consulta->radiografias as $radiografia)
                            <?php $variable[] = $radiografia->estudio->descripcion ?>
                        @endforeach
                        {{ implode(" ", array_unique($variable)) }}
                    </td>
                    <td><a href="{{ route('consulta-show', ['consulta' => $consulta->id ]) }}">
                        <button type="button" class="btn btn-info">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </button>
                    </a></td>
                    <td>
                    <form action="{{ route('consulta-delete', ['consulta' => $consulta->id ]) }}"  method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </form>
                    </td>
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