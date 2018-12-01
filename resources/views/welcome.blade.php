@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if (Auth::check())
                <h2>Bienvenido {{ Auth::user()->name }} </h2>
                @role(['paciente','medico'])
                    <div>
                        <h2>Nuevas consultas</h2>
                    </div>
                @endrole
                @role('admin')
                    <div>
                        <a href="{{ route('consulta-crear') }}">
                            <button class="btn btn-default">Nueva Consulta</button>
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
                    <div>
                        <h2>Historial de consultas</h2>
                    </div>
                @endrole

            @endif
        </div>
    </div>
</div>

@endsection
