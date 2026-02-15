<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class HorarioProfesorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $profesor;
    public $pdfPersonal;
    public $pdfCurso;

    /**
     * Recibimos el profesor, su PDF personal y (opcionalmente) el PDF de su curso.
     */
    public function __construct($profesor, $pdfPersonal, $pdfCurso = null)
    {
        $this->profesor = $profesor;
        $this->pdfPersonal = $pdfPersonal; // El contenido binario del PDF
        $this->pdfCurso = $pdfCurso;       // Puede ser null si no es director
    }

    /**
     * Asunto del correo.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu Horario Académico - TIMELY',
        );
    }

    /**
     * La vista HTML del correo.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.horario_profesor', // Crearemos esta vista en el paso 3
        );
    }

    /**
     * Aquí ocurre la magia de los adjuntos.
     */
    public function attachments(): array
    {
        // 1. Adjuntamos SIEMPRE el horario personal
        $archivos = [
            Attachment::fromData(fn () => $this->pdfPersonal, 'Mi_Horario.pdf')
                ->withMime('application/pdf'),
        ];

        // 2. Si existe el PDF del curso (es director), lo agregamos al array
        if ($this->pdfCurso) {
            $nombreArchivo = 'Horario_Curso_' . ($this->profesor->cursos->grado ?? 'Grupo') . '.pdf';
            
            $archivos[] = Attachment::fromData(fn () => $this->pdfCurso, $nombreArchivo)
                ->withMime('application/pdf');
        }

        return $archivos;
    }
}