@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            
            <div>
                <h1>Medicarx</h1>
                <h3>Sistema de radiografías</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus dolore incidunt nemo voluptatum autem laudantium fugiat saepe harum assumenda, vero aperiam aspernatur id vel voluptates similique natus reprehenderit in soluta!</p>
            </div>

        </div>
        <div class="col">
            @if (Auth::guest())
                @include('auth.forms.loginform')
            @else
                @role('admin')
                    <h2>Hola ADMIN</h2>
                    @include('auth.forms.registerform')
                @endrole

                @role('paciente')
                    <h2>Hola Paciente</h2>
                @endrole

                @role('medico')
                    <h2>Hola Doctor</h2>
                @endrole

                

            @endif
        </div>
    </div>
</div>

@endsection
