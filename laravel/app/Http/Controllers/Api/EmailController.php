<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        Mail::send([], [], function ($message) use ($formData) {
            $message->to('2daw.equip11@fp.insjoaquimmir.cat')
                ->subject('Nuevo mensaje de contacto')
                ->setBody($this->buildEmailContent($formData, true), 'text/html');
        });

        // Enviar correo al remitente (la persona que envía el formulario)
        Mail::send([], [], function ($message) use ($formData) {
            $message->to($formData['email'])
                ->subject('Confirmación de envío de mensaje')
                ->setBody($this->buildEmailContent($formData, false), 'text/html');
        });

        return response()->json(['message' => 'Email sent successfully']);
    }

    private function buildEmailContent($formData, $isRecipient)
    {
        $title = $isRecipient ? 'Nuevo mensaje de contacto' : 'Confirmación de envío de mensaje';
        $content = $isRecipient ? 'Has recibido un nuevo mensaje de contacto.' : 'Gracias por tu mensaje. Hemos recibido tu consulta y te responderemos pronto.';
        $content .= '<br><br>Detalles del mensaje:';
        $content .= '<br>Nombres: ' . $formData['name'];
        $content .= '<br>Teléfono: ' . ($formData['phone'] ?? '-');
        $content .= '<br>Correo electrónico: ' . $formData['email'];
        $content .= '<br>Mensaje: ' . $formData['mensaje'];

        return "<h2>$title</h2><p>$content</p>";
    }
}
