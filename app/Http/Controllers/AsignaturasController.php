<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignaturas;

class AsignaturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignaturas::all();
        return view('asignaturas.index', compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asignaturas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'profesor_asignado' => 'required|string|max:255',
            'horas_semanales' => 'required|string|max:255',
            'tipo_materia' => 'required|string|max:255',
        ]);

        Asignaturas::create($request->all());

        return redirect()->route('asignaturas.index')
                         ->with('success', 'Asignatura creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asignatura = Asignaturas::findOrFail($id);
        return view('asignaturas.edit', compact('asignatura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'profesor_asignado' => 'required|string|max:255',
            'horas_semanales' => 'required|string|max:255',
            'tipo_materia' => 'required|string|max:255',
        ]);

        $asignatura = Asignaturas::findOrFail($id);
        $asignatura->update($request->all());

        return redirect()->route('asignaturas.index')
                         ->with('success', 'Asignatura actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asignatura = Asignaturas::findOrFail($id);
        $asignatura->delete();

        return redirect()->route('asignaturas.index')
                         ->with('success', 'Asignatura eliminada exitosamente.');
    }
}
