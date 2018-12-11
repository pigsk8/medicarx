@extends('layouts.app')

@section('content')

@role('admin')
<div class="container">
    <div class="page-header">
        <h2>Lista de usuarios</h2>
    </div>

    <table id="dt" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <?php $roles = $user->roles()->get(); ?> 
            <tr>
            <td><a href="{{ route('perfil-user', ['user' => $user->id ]) }}">{{ $user->name }}</a></td>
                <td>
                    @forelse( $roles as $role )
                        {{ $role->name }}</span>  
                    @empty
                        No tiene rol
                    @endforelse
                </td>
                <td>{{ $user->estado_usuario->descripcion }}</td>
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