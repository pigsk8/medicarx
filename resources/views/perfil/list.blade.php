@extends('layouts.app')

@section('content')

@role('admin')
<div class="container">
  <h2>Lista de usuarios</h2>

  @foreach ($users as $user)
    <p><a href="/perfil/<?=$user->id?>" class="text-capitalize">{{ $user->name }}</a>  {{ $user->estado_usuario->descripcion }}
    <?php $roles = $user->roles()->get(); ?>
    @forelse( $roles as $role )
      <span>{{ $role->name }}</span>  
    @empty
      <span>No tiene rol</span>
    @endforelse
    </p>
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