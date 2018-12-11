@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if (Auth::check())
                {{-- <h2>Bienvenido {{ Auth::user()->name }} </h2> --}}
                @role(['paciente','medico'])
                    <div class="page-header">
                        <h2>Nuevas consultas</h2>
                    </div>

                    <div class="">
                        @if(empty($consultas_pendientes))
                        <p>No tiene consultas</p>
                        @else
                        <table id="dt-pendientes" class="table">
                            <thead>
                                <tr>
                                    <th>Medico</th>
                                    <th>Paciente</th>
                                    <th>Fecha de solicitud</th>
                                    <th>Estudio</th>
                                    <th>Ir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultas_pendientes as $consulta)
                                <tr>
                                    <td>{{ $consulta->user_medico->name }}</td>
                                    <td>{{ $consulta->user_paciente->name }}</td>
                                    <td>{{ $consulta->fecha_solicitud }}</td>
                                    
                                    <td> 
                                        @foreach($consulta->radiografias as $radiografia)
                                            {{ $radiografia->estudio->descripcion }}
                                        @endforeach
                                    </td>
                                    <td><a href="">Ir</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                @endrole
                @role('admin')
                    <div class="page-header">
                        <h2>Operaciones</h2>
                    </div>
                    <div>
                        <a href="{{ route('consulta-crear') }}">
                            <button class="btn btn-default">Nueva Consulta</button>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('consultas') }}">
                            <button class="btn btn-default">Listar Consultas</button>
                        </a>
                    </div>
                @endrole
            @else
                <div>
                    <h2>Medicarx</h2>
                    <h3>Sistema de radiografías</h3>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus dolore incidunt nemo voluptatum autem laudantium fugiat saepe harum assumenda, vero aperiam aspernatur id vel voluptates similique natus reprehenderit in soluta!</p>
                </div>
            @endif

        </div>
        <div class="col-md-6">
            @if (Auth::guest())
                @include('auth.forms.loginform')
            @else
                @role('admin')
                    @include('auth.forms.registerform')
                @endrole

                @role(['paciente','medico'])
                    <div class="page-header">
                        <h2>Historial de consultas</h2>
                    </div>
                    <div>
                        @if(empty($consultas_revisada))
                            <p>No tiene consultas</p>
                        @else

                        <table id="dt-revisadas" class="table">
                            <thead>
                                <tr>
                                    <th>Medico</th>
                                    <th>Paciente</th>
                                    <th>Fecha de entregada</th>
                                    <th>Estudio</th>
                                    <th>Ir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultas_revisadas as $consulta)
                                <tr>
                                    <td>{{ $consulta->user_medico->name }}</td>
                                    <td>{{ $consulta->user_paciente->name }}</td>
                                    <td>{{ $consulta->fecha_entrega }}</td>
                                    <td>
                                        @foreach($consulta->radiografias as $radiografia)
                                        {{ $radiografia->estudio->descripcion }}
                                        @endforeach
                                    </td>
                                    <td><a href="">Ir</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                @endrole

            @endif
        </div>
    </div>
</div>

@endsection
