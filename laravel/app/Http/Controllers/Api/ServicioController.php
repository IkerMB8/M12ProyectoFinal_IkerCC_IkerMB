<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use Illuminate\Support\Facades\Storage;

class ServicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:productos.create')->only(['create','store']);
        $this->middleware('permission:productos.update')->only(['edit','update']);
        $this->middleware('permission:productos.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $servicios = Servicio::all(); 
        return response()->json([
            'success' => true,
            'data'    => $servicios
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Validar fitxer
        $validatedData = $request->validate([
            'Nombre'          => 'required',
            'Tipo'      => 'required',
            'Precio'     => 'required|numeric'
        ]);

        $servicio = Servicio::create([
            'Nombre' =>$request->input('Nombre'),
            'Tipo' =>$request->input('Tipo'),
            'Precio' =>$request->input('Precio'),
        ]);

        return response()->json([
            'success' => true,
            'data'    => $servicio
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $servicio = Servicio::find($id);
        if ($servicio){
            return response()->json([
                'success' => true,
                'data'    => $servicio
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, servicio no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $servicio = Servicio::find($id);
        if ($servicio){
            if ($request->input('Nombre')){
                $servicio->Nombre=$request->input('Nombre');
            }
            if ($request->input('Tipo')){
                $servicio->Tipo=$request->input('Tipo');
            }
            if ($request->input('Precio')){
                $servicio->Precio=$request->input('Precio');
            }
            $servicio->save();

            return response()->json([
                'success' => true,
                'data'    => $servicio
            ], 201);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, servicio no encontrado'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $servicio = Servicio::find($id);
        if ($servicio){
            Servicio::destroy($servicio->id);
            return response()->json([
                'success' => true,
                'data'    => "Servicio eliminado correctamente"
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error encontrando servicio'
            ], 404);
        }
    }

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }


}
