@extends('layouts.app')

@section('content')

<div class="container">
    <div class="page-header">
        <h2>Listado de estudios</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(!empty($estudios))
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo de estudio</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudios as $estudio)
                <tr>
                    <form action="estudio/{{ $estudio->id }}" method="POST"> 
                        {{ csrf_field() }}
                        <td>{{ $estudio->id }}</td>
                        <td> <input type="text" class="form-control" name="descripcion" value="{{ $estudio->descripcion }}" required></td>
                        <td><button type="submit" class="btn btn-info">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </button></td>
                    </form>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </form>
                    </td>
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