<?php

namespace App\Http\Controllers;

use App\Models\Profesor; 
use Illuminate\Support\Facades\Mail;
use App\Mail\HorarioProfesorMail; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{

    public function index()
    {
        $profesores = \App\Models\Profesor::with('cursos')->orderBy('apellido')->get();

        return view('notificaciones.index', compact('profesores')); 
}

    public function enviarMasivo(Request $request)
{

    set_time_limit(300);

    $profesores = [];

    if ($request->input('accion') == 'todos') {

    $profesores = \App\Models\Profesor::with('horarios', 'cursos.horarios.profesor')->get();
    } else {
        
        $request->validate([
            'profesores_ids' => 'required|array|min:1'
        ], [
            'profesores_ids.required' => 'Debes marcar al menos un profesor para usar esta opción.'
        ]);

        $ids = $request->input('profesores_ids');
        $profesores = \App\Models\Profesor::with('horarios', 'cursos.horarios.profesor')
                        ->whereIn('id', $ids) 
                        ->get();
    }

    $contador = 0;

    
    foreach ($profesores as $profe) {
        if ($profe->email) {
            
            $pdfPersonal = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.horario_profesor', ['profesor' => $profe])->output();

            $pdfCurso = null;

            if ($profe->cursos) {

            $pdfCurso = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.horario_curso', ['curso' => $profe->cursos])->output();
            }

            try {
                \Illuminate\Support\Facades\Mail::to($profe->email)
                    ->send(new \App\Mail\HorarioProfesorMail($profe, $pdfPersonal, $pdfCurso));
                
                $contador++;
            } catch (\Exception $e) {
                dd([
                    'Error detectado' => $e->getMessage(),
                    'Profesor fallido' => $profe->nombre . ' ' . $profe->apellido,
                    'Archivo' => $e->getFile(),
                    'Línea' => $e->getLine()
                ]);
            }
        }
    }

    return back()->with('success', "Proceso finalizado. Se enviaron {$contador} correos.");
}
}