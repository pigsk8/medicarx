@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('auth.forms.loginform')
        </div>
    </div>
</div>
@endsection
