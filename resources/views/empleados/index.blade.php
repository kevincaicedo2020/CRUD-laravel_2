@extends('layouts.app')

@section('content')

<div class="container">
    
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{Session::get('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


    <a href="{{ url('/empleados/create')}}" class="btn btn-success">Crear Formulario</a>
    
    <table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $empleados as $empleado )
        <tr>
            <td>{{$empleado->id}}</td>


            <td>
                <img src="{{ asset('storage').'/'.$empleado->Foto }}" class="img-thumbnail img-fluid" style="width:200px" alt="">
            </td>
            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->ApellidoPaterno}}</td>
            <td>{{$empleado->ApellidoMaterno}}</td>
            <td>{{$empleado->Correro}}</td>
            <td>
                
                <a href="{{ url('/empleados/'.$empleado->id.'/edit') 
                
                }}" class="btn btn-warning">Editar</a>

                | 
                
                <form action="{{ url('/empleados/'.$empleado->id) }}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" onclick="return confirm('Quieres borrar?')" class="btn btn-danger" value="Borrar">
                </form>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection