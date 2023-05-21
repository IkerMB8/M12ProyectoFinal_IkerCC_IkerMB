<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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
     * Display a listing of the resource filtered by ID.
     *
     * @param App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function indexByUser(User $user)
    {
        $reservas = auth()->user()->client->reservas()->with('servicio', 'trabajador')->get();

        $reservasData = $reservas->map(function ($reserva) {
            return [
                'id' => $reserva->id,
                'fecha' => $reserva->Fecha,
                'servicio' => $reserva->servicio->Nombre,
                'trabajador' => $reserva->trabajador->Nombre,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $reservasData
        ], 200);
    }


    /**
     * Display a listing of the resource filtered by the current date.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReservasDia(Request $request)
    {
        $fechaActual = Carbon::now()->toDateString();
    
        $reservas = Reserva::whereDate('Fecha', '>=', $fechaActual)->get();
    
        return response()->json([
            'success' => true,
            'data' => $reservas
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
            'ID_Cliente'      => 'numeric',
            'ID_Trabajador'      => 'required|numeric',
            'ID_Servicio'     => 'required|numeric'
        ]);

        $fecha = $request->input('Fecha');
        $citaExistente = Reserva::where('Fecha', $fecha)->first();
        if ($citaExistente) {
            return response()->json([
                'success' => false,
                'message' => 'La hora seleccionada ya está ocupada'
            ], 400);
        }

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
        // Validar los datos de entrada aquí...
        $validatedData = $request->validate([
            'Fecha' => 'sometimes|required',
            'Email' => 'sometimes|required',
            'Telefono' => 'sometimes|required|numeric',
            'ID_Cliente' => 'sometimes|numeric',
            'ID_Trabajador' => 'sometimes|required|numeric',
            'ID_Servicio' => 'sometimes|required|numeric'
        ]);

        $reserva = Reserva::find($id);
        if ($reserva) {
            $fecha = $request->input('Fecha');
            // Comprobar si la hora ya está ocupada
            $horasOcupadas = Reserva::where('Fecha', $fecha)->where('id', '!=', $id)->count();
            if ($horasOcupadas > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'La hora seleccionada ya está ocupada'
                ], 400);
            }

            $reserva->fill(array_filter($request->only([
                'Fecha',
                'Email',
                'Telefono',
                'ID_Cliente',
                'ID_Trabajador',
                'ID_Servicio'
            ])));

            $reserva->save();

            return response()->json([
                'success' => true,
                'data'    => $reserva,
                'message' => 'Cita creada correctamente'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
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
                'message'    => "Reserva eliminada correctamente"
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
