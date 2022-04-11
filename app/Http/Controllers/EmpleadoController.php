<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage; /* Esto se incluye para poder editar osea cambiar la img en la BD*/


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['empleados'] = Empleado::paginate(2);
        return view('empleados.index',$datos);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $datos_del_empleado = request()->all(); */
        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correro'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpg,jpeg,png'
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];
        $this->validate($request,$campos,$mensaje);

        $datos_del_empleado = request()->except('_token');
        if($request->hasFile('Foto')){
            $datos_del_empleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datos_del_empleado);
        /* return response()->json($datos_del_empleado); */

        return redirect('empleados')->with('mensaje','Empleado agregado correctamente');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(/* Empleado $empleado */$id)
    {
        $empleado = Empleado::FindOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, /* Empleado $empleado */ $id)
    {

        $campos = [
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correro'=>'required|email'
        ];

        $mensaje = [
            'required'=>'El :attribute es requerido'
        ];
        if($request->hasFile('Foto')){
            $campos = ['Foto'=>'required|max:10000|mimes:jpg,jpeg,png'];
            $mensaje = ['Foto.required'=>'La foto es requerida'];
        }

        $this->validate($request,$campos,$mensaje);


        $datos_del_empleado = request()->except(['_token', '_method']);

        if($request->hasFile('Foto')){
            $empleado = Empleado::FindOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datos_del_empleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }
        /* $empleado = Empleado::FindOrFail($id);
        Storage::delete('public/'.$empleado->Foto);
        $datos_del_empleado['Foto'] = $request->file('Foto')->store('uploads','public'); */

        Empleado::where('id','=',$id)->update($datos_del_empleado);

        $empleado = Empleado::FindOrFail($id);
        /* return view('empleados.edit', compact('empleado')); Este es otro modo pero como que prefiero el de abajo */ 
        return Redirect('empleados')->with('mensaje','Empleado Modificado');  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(/* Empleado $empleado */$id)
    {
        /* $empleado = Empleado::FindOrFail($id);
        Storage::delete('public/'.$empleado->Foto);
                                                            mi version del codigo
        Empleado::destroy($id);
        return Redirect('empleados'); */
        $empleado = Empleado::FindOrFail($id);
        if(Storage::delete('public/'.$empleado->Foto))
        {
            Empleado::destroy($id);
        }

        return Redirect('empleados')->with('mensaje','Empleado borrado');  
    }
}
