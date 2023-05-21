<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;
    public $isRecipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formData, $isRecipient)
    {
        $this->formData = $formData;
        $this->isRecipient = $isRecipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = $this->isRecipient ? 'Nuevo mensaje de contacto' : 'Confirmación de envío de mensaje';
        $content = $this->isRecipient ? 'Has recibido un nuevo mensaje de contacto.' : 'Gracias por tu mensaje. Hemos recibido tu consulta y te responderemos pronto.';
        $content .= '<br><br>Detalles del mensaje:';
        $content .= '<br>Nombres: ' . $this->formData['name'];
        $content .= '<br>Teléfono: ' . ($this->formData['phone'] ?? '-');
        $content .= '<br>Correo electrónico: ' . $this->formData['email'];
        $content .= '<br>Mensaje: ' . $this->formData['mensaje'];

        return $this->subject($title)->html($content);
    }
}