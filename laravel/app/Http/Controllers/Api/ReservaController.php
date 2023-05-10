<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Storage;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reservas = Reserva::all(); 
        return response()->json([
            'success' => true,
            'data'    => $reservas
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
        $validatedData = $request->validate([
            'Fecha'          => 'required',
            'Email'          => 'required',
            'Telefono'      => 'required|numeric',
            'ID_Cliente'      => 'required|numeric',
            'ID_Trabajador'      => 'required|numeric',
            'ID_Servicio'     => 'required|numeric'
        ]);

        $reserva = Reserva::create([
            'Fecha' =>$request->input('Fecha'),
            'Email' =>$request->input('Email'),
            'Telefono' =>$request->input('Telefono'),
            'ID_Cliente' =>$request->input('ID_Cliente'),
            'ID_Trabajador' =>$request->input('ID_Trabajador'),
            'ID_Servicio' =>$request->input('ID_Servicio')
        ]);

        return response()->json([
            'success' => true,
            'data'    => $reserva
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
        $reserva = Reserva::find($id);
        if ($reserva){
            return response()->json([
                'success' => true,
                'data'    => $reserva
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, reserva no encontrada'
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
        $reserva = Reserva::find($id);
        if ($reserva){
            if ($request->input('Fecha')){
                $reserva->Fecha=$request->input('Fecha');
            }
            if ($request->input('Email')){
                $reserva->Email=$request->input('Email');
            }
            if ($request->input('Telefono')){
                $reserva->Telefono=$request->input('Telefono');
            }
            if ($request->input('ID_Cliente')){
                $reserva->ID_Cliente=$request->input('ID_Cliente');
            }
            if ($request->input('ID_Trabajador')){
                $reserva->ID_Trabajador=$request->input('ID_Trabajador');
            }
            if ($request->input('ID_Servicio')){
                $reserva->ID_Servicio=$request->input('ID_Servicio');
            }
            $reserva->save();

            return response()->json([
                'success' => true,
                'data'    => $reserva
            ], 201);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, reserva no encontrada'
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
        $reserva = Reserva::find($id);
        if ($reserva){
            Reserva::destroy($reserva->id);
            return response()->json([
                'success' => true,
                'data'    => "Reserva eliminada correctamente"
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error encontrando reserva'
            ], 404);
        }
    }

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }


}
