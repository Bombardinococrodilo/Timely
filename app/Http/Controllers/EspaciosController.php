<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espacios;

class EspaciosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacios = Espacios::all();
        return view('espacios.index', compact('espacios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('espacios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string',
            'estado' => 'required|in:disponible,ocupado,mantenimiento',
        ]);

        Espacios::create($request->all());

        return redirect()->route('espacios.index')
                         ->with('success', 'Espacio creado exitosamente.');
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
        $espacio = Espacios::findOrFail($id);
        return view('espacios.edit', compact('espacio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'required|string',
            'estado' => 'required|in:disponible,ocupado,mantenimiento',
        ]);

        $espacio = Espacios::findOrFail($id);
        $espacio->update($request->all());

        return redirect()->route('espacios.index')
                         ->with('success', 'Espacio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $espacio = Espacios::findOrFail($id);
        $espacio->delete();

        return redirect()->route('espacios.index')
                         ->with('success', 'Espacio eliminado exitosamente.');
    }
}
