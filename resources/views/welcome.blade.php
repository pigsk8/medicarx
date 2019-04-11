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
                                    <th class="td-id">Id</th>
                                    @role('paciente')
                                    <th>Medico</th>
                                    @endrole
                                    @role('medico')
                                    <th>Paciente</th>
                                    @endrole
                                    <th>Fecha de solicitud</th>
                                    <th>Estudio</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultas_pendientes as $consulta)
                                <tr>
                                    <td class="td-id">{{ $consulta->id }}</td>
                                    @role('paciente')
                                    <td class="text-capitalize">{{ $consulta->user_medico->name }}</td>
                                    @endrole
                                    @role('medico')
                                    <td class="text-capitalize">{{ $consulta->user_paciente->name }}</td>
                                    @endrole
                                    <td>{{ $consulta->fecha_solicitud }}</td>
                                    
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
                    <br>
                    <div>
                        <a href="{{ route('consultas') }}">
                            <button class="btn btn-default">Listar Consultas</button>
                        </a>
                    </div>
                    <br>
                    <div>
                        <a href="{{ route('perfil') }}">
                            <button class="btn btn-default">Listar Usuarios</button>
                        </a>
                    </div>
                    <br>
                    <div>
                        <a href="{{ route('estudio.index') }}">
                            <button class="btn btn-default">Gestionar Tipo de Estudio</button>
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

            <br>

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
                        @if(empty($consultas_revisadas))
                            <p>No tiene consultas</p>
                        @else

                        <table id="dt-revisadas" class="table">
                            <thead>
                                <tr>
                                    <th class="td-id">Id</th>
                                    @role('paciente')
                                    <th>Medico</th>
                                    @endrole
                                    @role('medico')
                                    <th>Paciente</th>
                                    @endrole
                                    <th>Fecha de entregada</th>
                                    <th>Estudio</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($consultas_revisadas as $consulta)
                                <tr>
                                    <td class="td-id">{{ $consulta->id }}</td>
                                    @role('paciente')
                                    <td class="text-capitalize">{{ $consulta->user_medico->name }}</td>
                                    @endrole
                                    @role('medico')
                                    <td class="text-capitalize">{{ $consulta->user_paciente->name }}</td>
                                    @endrole
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
