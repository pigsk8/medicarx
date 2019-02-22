@extends('layouts.app')

@section('content')

@role('admin')
<div class="container">
    <div class="page-header">
        <h2>Lista de usuarios</h2>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('warning'))
        <div class="alert alert-warning">
            {{ session()->get('warning') }}
        </div>
    @endif

    @if(session()->has('danger'))
        <div class="alert alert-danger">
            {{ session()->get('danger') }}
        </div>
    @endif

    <table id="dt-user" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Cedula</th>
                <th>Ver</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <?php $roles = $user->roles()->get(); ?> 
            <tr>
                <td class="text-capitalize">{{ $user->name }}</td>
                <td class="text-capitalize">
                    @forelse( $roles as $role )
                        {{ $role->name }}</span>  
                    @empty
                        No tiene rol
                    @endforelse
                </td>
                <td class="text-capitalize">{{ $user->ci }}</td>
                <td><a href="{{ route('perfil-user', ['user' => $user->id ]) }}">
                    <button type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </button>
                </a></td>
                <td>
                    @if(Auth::user()->id==$user->id)
                    <button type="disable" class="btn btn-disable">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    @else
                    <form action="{{ route('perfil.destroy', ['user' => $user->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endrole

@role(['medico','paciente'])
<script>window.location = "/";</script>
@endrole

@endsection