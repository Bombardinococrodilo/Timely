<?php
namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; 

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'grado' => 'required|string',
            'grupo' => 'required|string',
            'cantidad_estudiantes' => 'required|integer|min:1',
            
            'grado' => Rule::unique('cursos')->where(function ($query) use ($request) {
                return $query->where('grado', $request->grado)
                             ->where('grupo', $request->grupo);
            }),
        ], [
            'grado.unique' => 'Este curso (Grado y Grupo) ya existe.' 
        ]);

        Curso::create($request->all());
        return redirect()->route('cursos.index')->with('success', 'Curso creado correctamente.');
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'grado' => 'required|string',
            'grupo' => 'required|string',
            'cantidad_estudiantes' => 'required|integer|min:1',
            
            'grado' => Rule::unique('cursos')->where(function ($query) use ($request) {
                return $query->where('grado', $request->grado)
                             ->where('grupo', $request->grupo);
            })->ignore($curso->id),
        ]);

        $curso->update($request->all());
        return redirect()->route('cursos.index')->with('success', 'Curso actualizado.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
    }
}