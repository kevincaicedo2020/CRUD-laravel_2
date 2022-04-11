@extends('layouts.app')

@section('content')

<div class="container">

<form action="{{ url('/empleados/'.$empleado->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{ method_field('PATCH') }}
    @include('empleados.form',['Modo'=>'Editar'])
</form>

</div>
@endsection