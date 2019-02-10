@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h2>Listado de estudios</h2>
    </div>

    @if(!empty($estudios))
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo de estudio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudios as $estudio)
                <tr>
                    <td>{{ $estudio->id }}</td>
                    <td>{{ $estudio->descripcion}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No hay estudios</p>
    @endif

</div>

@endsection