<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Profesor;
use App\Models\Curso;
use App\Models\Asignaturas; 
use App\Models\Espacios;    
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class HorarioController extends Controller
{
    private $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
    private $horas = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];

    public function index()
    {
        $horarios = Horario::with(['profesor', 'curso', 'asignatura', 'espacio'])
                           ->orderBy('dia')
                           ->orderBy('hora_inicio')
                           ->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $profesores = Profesor::all();
        $cursos = Curso::all();
        $asignaturas = Asignaturas::all(); 
        $espacios = Espacios::all();       
        
        return view('horarios.create', compact('profesores', 'cursos', 'asignaturas', 'espacios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profesor_id' => 'required',
            'curso_id' => 'required',
            'asignatura_id' => 'required',
            'espacio_id' => 'required',
            'dia' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio', 
        ]);

        
        if ($errorAforo = $this->validarAforo($request)) {
            return back()->withErrors(['error' => $errorAforo])->withInput();
        }

        if ($errorCruce = $this->validarCruce($request)) {
            return back()->withErrors(['error' => $errorCruce])->withInput();
        }

        Horario::create($request->all());

        return redirect()->route('horarios.index')->with('success', 'Clase programada exitosamente.');
    }

    public function edit(Horario $horario)
    {
        $profesores = Profesor::all();
        $cursos = Curso::all();
        $asignaturas = Asignaturas::all(); 
        $espacios = Espacios::all();       

        return view('horarios.edit', compact('horario', 'profesores', 'cursos', 'asignaturas', 'espacios'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'profesor_id' => 'required',
            'curso_id' => 'required',
            'asignatura_id' => 'required',
            'espacio_id' => 'required',
            'dia' => 'required',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        if ($errorAforo = $this->validarAforo($request)) {
            return back()->withErrors(['error' => $errorAforo])->withInput();
        }

        if ($errorCruce = $this->validarCruce($request, $horario->id)) {
            return back()->withErrors(['error' => $errorCruce])->withInput();
        }

        $horario->update($request->all());

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado.');
    }

    public function grilla()
    {
        $horarios = Horario::with(['profesor', 'curso', 'asignatura', 'espacio'])->get();
        
        $horas = $this->horas;
        $dias = $this->dias;
        return view('horarios.grilla', compact('horarios', 'horas', 'dias'));
    }

    public function descargarPDF()
    {

        $horarios = Horario::with(['profesor', 'curso', 'asignatura', 'espacio'])->get();
        $horas = $this->horas;
        $dias = $this->dias;

        $pdf = Pdf::loadView('horarios.pdf', compact('horarios', 'horas', 'dias'));

        return $pdf->download('horario_general_timely.pdf');
    }

    
    private function validarAforo(Request $request)
    {
        $curso = Curso::find($request->curso_id);
        $espacio = Espacios::find($request->espacio_id);

        if ($espacio && $curso && $espacio->capacidad < $curso->cantidad_estudiantes) {
            return "¡Error de Aforo! El espacio '{$espacio->nombre}' solo tiene capacidad para {$espacio->capacidad} personas, pero el curso tiene {$curso->cantidad_estudiantes} estudiantes.";
        }
        return null;
    }

    
    private function validarCruce(Request $request, $ignorarId = null)
    {
        $query = Horario::where('dia', $request->dia)
            ->where(function($q) use ($request) {
                $q->where('hora_inicio', '<', $request->hora_fin)
                  ->where('hora_fin', '>', $request->hora_inicio);
            })
            ->where(function($q) use ($request) {
                $q->where('profesor_id', $request->profesor_id)
                  ->orWhere('espacio_id', $request->espacio_id)
                  ->orWhere('curso_id', $request->curso_id);
            });

        if ($ignorarId) {
            $query->where('id', '!=', $ignorarId);
        }

        if ($query->exists()) {
            return '¡Conflicto! Ya existe una clase asignada en este horario para el profesor, curso o espacio seleccionado.';
        }
        return null;
    }
}