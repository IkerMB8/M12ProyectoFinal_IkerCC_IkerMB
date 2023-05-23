<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:productos.list')->only('index');
        $this->middleware('permission:productos.create')->only(['create','store']);
        $this->middleware('permission:productos.read')->only('show');
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
        $Productos = Producto::all(); 
        return response()->json([
            'success' => true,
            'data'    => $Productos
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
            'id_stripe' => 'required',
            'name'      => 'required',
            'price'     => 'required|numeric',
            'image'     => 'required'
        ]);

        $Producto = Producto::create([
            'id_stripe' =>$request->input('id_stripe'),
            'name' =>$request->input('name'),
            'price' =>$request->input('price'),
            'image' =>$request->input('image'),
        ]);

        return response()->json([
            'success' => true,
            'data'    => $Producto
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
        $Producto = Producto::find($id);
        if ($Producto){
            return response()->json([
                'success' => true,
                'data'    => $Producto
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, Producto no encontrado'
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
        $Producto = Producto::find($id);
        if ($Producto){
            $validatedData = $request->validate([
                'price'     => 'numeric',
                'image'     => 'numeric'
            ]);
            if ($request->input('id_stripe')){
                $Producto->id_stripe=$request->input('id_stripe');
            }
            if ($request->input('name')){
                $Producto->name=$request->input('name');
            }
            if ($request->input('price')){
                $Producto->price=$request->input('price');
            }
            if ($request->input('image')){
                $Producto->image=$request->input('image');
            }
            $Producto->save();

            return response()->json([
                'success' => true,
                'data'    => $Producto
            ], 201);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error, Producto no encontrado'
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
        $Producto = Producto::find($id);
        if ($Producto){
            Producto::destroy($Producto->id);
            return response()->json([
                'success' => true,
                'data'    => "Producto eliminado correctamente"
            ], 200);
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error encontrando Producto'
            ], 404);
        }
    }

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }


}
