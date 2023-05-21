<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'required|email',
            'mensaje' => 'required',
        ]);

        // Enviar correo al destinatario (tu dirección de correo)
        Mail::to('2daw.equip11@fp.insjoaquimmir.cat')->send(new ContactForm($formData, true));

        // Enviar correo al remitente (la persona que envía el formulario)
        Mail::to($formData['email'])->send(new ContactForm($formData, false));

        return response()->json(['message' => 'Email sent successfully']);
    }
}