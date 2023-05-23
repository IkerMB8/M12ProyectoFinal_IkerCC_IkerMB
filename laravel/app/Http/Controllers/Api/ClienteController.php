<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clientes.list')->only('index');
        $this->middleware('permission:clientes.create')->only(['create','store']);
        $this->middleware('permission:clientes.read')->only('show');
        $this->middleware('permission:clientes.update')->only(['edit','update']);
        $this->middleware('permission:clientes.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Cliente::all(); 
        return response()->json([
            'success' => true,
            'data'    => $clientes
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerClienteDeUsuario()
    {
        if (auth()->check()) {
            $usuario = auth()->user();
            if ($usuario->client) {
                $cliente = $usuario->client;
                return response()->json([
                    'success' => true,
                    'data'    => $cliente
                ], 201);
            }
            return response()->json(['mensaje' => 'El usuario no tiene un cliente asociado'], 404);
        } else {
            return response()->json(['mensaje' => 'El usuario no está autenticado'], 404);
        }
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
            'Telefono'     => 'required|numeric',
            'AnioNacimiento'     => 'required|numeric'
        ]);

        $cliente = Cliente::create([
            'Nombre' =>$request->input('Nombre'),
            'Apellido' =>$request->input('Apellido'),
            'Telefono' =>$request->input('Telefono'),
            'AnioNacimiento' =>$request->input('AnioNacimiento'),
        ]);

        \Log::debug("DB storage OK");

        return response()->json([
            'success' => true,
            'data'    => $cliente
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
        $cliente = Cliente::find($id);
        if ($cliente){
            return response()->json([
                'success' => true,
                'data'    => $cliente
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, Cliente no encontrado'
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
        $cliente = Cliente::find($id);
        if ($cliente){
            $validatedData = $request->validate([
                'Telefono'     => 'numeric',
                'AnioNacimiento'     => 'numeric'
            ]);
            if ($request->input('Nombre')){
                $cliente->Nombre=$request->input('Nombre');
            }
            if ($request->input('Apellido')){
                $cliente->Apellido=$request->input('Apellido');
            }
            if ($request->input('Telefono')){
                $cliente->Telefono=$request->input('Telefono');
            }
            if ($request->input('AnioNacimiento')){
                $cliente->AnioNacimiento=$request->input('AnioNacimiento');
            }
            $cliente->save();

            return response()->json([
                'success' => true,
                'data'    => $cliente
            ], 201);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, Cliente no encontrado'
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
        $cliente = Cliente::find($id);
        if ($cliente){
            Cliente::destroy($cliente->id);
            return response()->json([
                'success' => true,
                'data'    => "Cliente eliminado correctamente"
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error encontrando Cliente'
            ], 404);
        }
    }

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }


}
