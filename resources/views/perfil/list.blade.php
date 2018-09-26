@extends('layouts.app')

@section('content')

@role('admin')
<div class="container">
  <h2>Lista de usuarios</h2>

  @foreach ($users as $user)
  <div style="border: 1px solid black; border-radius: 4px; padding: 8px; margin-bottom: 8px" class="mb-4">
    <p><a href="/perfil/<?=$user->id?>" class="text-capitalize">{{ $user->name }}</a> Estado del usuario: {{ $user->estado_usuario->descripcion }}
    </p>
      <figure>
    <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="" width="150px" height="150px">
    </figure>
    <?php $roles = $user->roles()->get(); ?>
    <p>
      <span>Rol: </span>
    @forelse( $roles as $role )
      <span>{{ $role->name }}</span>  
    @empty
      <span>No tiene rol</span>
    @endforelse
    </p>
    </div>
  @endforeach

  @if( count($users) )
    {{ $users->links() }}
  @endif

</div>
@endrole

@role(['medico','paciente'])
<script>window.location = "/";</script>
@endrole

@endsection