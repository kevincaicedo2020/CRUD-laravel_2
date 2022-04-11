<h1>{{$Modo}} Empleados</h1>

@if (count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="Nombre">Nombre</label>
    <input type="text" class="form-control" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre') }}" id="Nombre">
</div>

<div class="form-group">
    <label for="ApellidoPaterno">Apellido Paterno</label>
    <input type="text" class="form-control" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno') }}" id="ApellidoPaterno">
</div>

<div class="form-group">
    <label for="Correro">Apellido Materno</label>
    <input type="text" class="form-control" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno')}}" id="ApellidoMaterno">
</div>

<div class="form-group">
    <label for="Correro">Correro</label>
    <input type="text" class="form-control" name="Correro" value="{{ isset($empleado->Correro)?$empleado->Correro:old('Correro') }}" id="Correro">
</div>

<div class="form-group">
    <label for="Foto">Foto</label>
    
    @if (isset($empleado->Foto))
    <img src="{{ asset('storage').'/'.$empleado->Foto }}" class="img-thumbnail img-fluid" style="width:200px" alt="">
    @endif
    
    
    <input type="file" class="form-control" name="Foto" value="{{ isset($empleado->Foto)?$empleado->Foto:'' }}" id="Foto">
</div>


    
    <input type="submit" value="{{$Modo}} datos" class="btn btn-success">

    <a href="{{ url('/empleados/')}}" class="btn btn-primary">Index</a>
    
