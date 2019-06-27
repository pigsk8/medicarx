@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Reportes</h2>

    <div>
        <h3>Cantidad de usuarios: {{ $count_user }}</h3>
        @foreach ($list_user as $item => $value)
            <p>{{$item}}: {{$value}}</p>
        @endforeach
    </div>

    <div>
        <h3>Cantidad de Radiografías realizadas hoy: {{ $count_today}}</h3>
        @forelse ($estudios_today as $item => $value)
            @if($value == 1)
                <p>{{$item}}: {{$value}} Estudio</p>
            @else
                <p>{{$item}}: {{$value}} Estudios</p>
            @endif
        @empty
            <p>No se han registrado radiografías hoy</p>
        @endforelse
    </div>

    <div>
        <h3>Cantidad de Radiografías realizadas en los ultimos 7 días:  {{ $count_week}}</h3>
        @foreach ($estudios_week as $item => $value)
            @if($value == 1)
                <p>{{$item}}: {{$value}} Estudio</p>
            @else
                <p>{{$item}}: {{$value}} Estudios</p>
            @endif
        @endforeach
    </div>

    <div>
        <h3>Cantidad de Radiografías realizadas en los ultimos 30 días:  {{ $count_month}}</h3>
        @foreach ($estudios_month as $item => $value)
            @if($value == 1)
                <p>{{$item}}: {{$value}} Estudio</p>
            @else
                <p>{{$item}}: {{$value}} Estudios</p>
            @endif
        @endforeach
    </div>

</div>

@endsection