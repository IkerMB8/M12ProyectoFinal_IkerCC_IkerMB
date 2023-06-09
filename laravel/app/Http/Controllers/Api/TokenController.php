<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $user = User::where('email', $request->user()->email)->first();
       
        return response()->json([
            "success" => true,
            "user"    => $request->user(),
            "roles"   => $user->getRoleNames(),
        ]);
    }
 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            // Get user
            $user = User::where([
                ["email", "=", $credentials["email"]]
            ])->firstOrFail();
            // Revoke all old tokens
            $user->tokens()->delete();
            // Generate new token
            $token = $user->createToken("authToken")->plainTextToken;
            // Token response
            return response()->json([
                "success"   => true,
                "authToken" => $token,
                "tokenType" => "Bearer"
            ], 200);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid login credentials"
            ], 401);
        }
    }
 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success"   => true,
            "message"   => "Log out succesfully"
        ], 200);
    }
 
    public function register(Request $request)
    {
            $requests = $request->validate([
                'name' => 'required',
                'secondname' => 'required',
                'email' => 'required|email', 
                'password' => 'required',
                'telephone' => 'required|integer',
                'birthyear' => 'required|required',
            ]);

            $existingUser = User::where('email', $requests['email'])->first();
            if ($existingUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'El correo electrónico ya está registrado.',
                ], 400);
            }
            
            $cliente = Cliente::create([
                'Nombre' => $requests['name'],
                'Apellido' => $requests['secondname'],
                'Telefono' => $requests['telephone'],
                'AnioNacimiento' => $requests['birthyear'],
            ]);
            $user = User::create([
                'name' => $requests['name'],
                'email' => $requests['email'],
                'password' => Hash::make($requests['password']),
                'ID_Cliente' => $cliente->id,
            ]);
            $user->assignRole('cliente');
            $token = $user->createToken("authToken")->plainTextToken;
            
            // Token response
            return response()->json([
                "success"   => true,
                "authToken" => $token,
                "tokenType" => "Bearer"
            ], 200);
    }
}
