@extends('layouts.app')

@section('content')

@role('admin')
<div class="container">
    <div class="page-header">
        <h2>Lista de usuarios</h2>
    </div>

    <table id="dt-user" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Ver</th>
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
                <td class="text-capitalize">{{ $user->estado_usuario->descripcion }}</td>
                <td><a href="{{ route('perfil-user', ['user' => $user->id ]) }}">
                    <button type="button" class="btn btn-info">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                    </button>
                </a></td>
            </tr>
            @endforeach
        </tbody>
    </table>


{{-- 
    <figure>
        <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="" width="150px" height="150px">
    </figure> 
--}}

</div>
@endrole

@role(['medico','paciente'])
<script>window.location = "/";</script>
@endrole

@endsection