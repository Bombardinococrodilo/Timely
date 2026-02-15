<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class KioscoController extends Controller
{
    public function index(Request $request)
    {

        $todosLosCursos = Curso::orderBy('grado')->orderBy('grupo')->get();

        $cursoBuscado = null;
        $cursosParaCarrusel = null;

        if ($request->has('curso_id')) {

            $cursoBuscado = Curso::with(['horarios.asignatura', 'horarios.espacio', 'horarios.profesor'])
                                 ->find($request->curso_id);
        } else {

            $cursosParaCarrusel = Curso::with(['horarios.asignatura', 'horarios.espacio'])
                                       ->has('horarios')
                                       ->get();
        }

        $horas = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

        return view('kiosco.index', compact('todosLosCursos', 'cursoBuscado', 'cursosParaCarrusel', 'horas', 'dias'));
    }

    public function descargarPdf($id)
    {

        $curso = \App\Models\Curso::with(['horarios.asignatura', 'horarios.espacio', 'horarios.profesor'])->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.horario_curso', ['curso' => $curso]);

        $nombreArchivo = 'Horario_Curso_' . $curso->grado . '_' . $curso->grupo . '.pdf';
        
        return $pdf->download($nombreArchivo);
    }
}