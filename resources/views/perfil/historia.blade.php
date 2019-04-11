@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h2>Historial medico</h2>
        <h4>{{ $user->name }}</h4>
    </div>

    <table id="dt-historia" class="table">
        <thead>
            <tr>
                <th>Medico</th>
                <th>Fecha</th>
                <th>Estudio</th>
                <th>Diagnostico</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($consultas as $consulta)
            <tr>
                <td class="text-capitalize">{{ $consulta->user_medico->name }}</td>
                <td>{{ $consulta->fecha_solicitud }}</td>
                <td>
                    @foreach($consulta->radiografias as $radiografia)
                        <?php $variable[] = $radiografia->estudio->descripcion ?>
                    @endforeach
                    {{ implode(" ", array_unique($variable)) }}
                </td>
                <td>{{ $consulta->diagnostico }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection