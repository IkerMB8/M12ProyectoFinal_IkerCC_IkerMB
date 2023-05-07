<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Storage;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trabajadores = Trabajador::all(); 
        return response()->json([
            'success' => true,
            'data'    => $trabajadores
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
            'Apellido'      => 'required',
            'Telefono'     => 'required|numeric'
        ]);

        $trabajador = Trabajador::create([
            'Nombre' =>$request->input('Nombre'),
            'Apellido' =>$request->input('Apellido'),
            'Telefono' =>$request->input('Telefono'),
        ]);

        \Log::debug("DB storage OK");

        return response()->json([
            'success' => true,
            'data'    => $trabajador
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
        $trabajador = Trabajador::find($id);
        if ($trabajador){
            return response()->json([
                'success' => true,
                'data'    => $trabajador
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, trabajador no encontrado'
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
        $trabajador = Trabajador::find($id);
        if ($trabajador){
            //
            // Validar fitxer
            $validatedData = $request->validate([
                'Nombre'          => 'required',
                'Apellido'      => 'required',
                'Telefono'     => 'required|numeric'
            ]);

            if ($request->input('Nombre')){
                $trabajador->Nombre=$request->input('Nombre');
            }
            if ($request->input('Apellido')){
                $trabajador->Apellido=$request->input('Apellido');
            }
            if ($request->input('Telefono')){
                $trabajador->Telefono=$request->input('Telefono');
            }
            $trabajador->save();

            return response()->json([
                'success' => true,
                'data'    => $trabajador
            ], 201);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, trabajador no encontrado'
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
        $trabajador = Trabajador::find($id);
        if ($trabajador){
            Trabajador::destroy($trabajador->id);
            return response()->json([
                'success' => true,
                'data'    => "Trabajador eliminado correctamente"
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error encontrando trabajador'
            ], 404);
        }
    }

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }


}
