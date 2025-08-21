<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Muestra lista de espacios.
     */
    public function index()
    {
        $spaces = Space::all();
        return view('spaces.index', compact('spaces'));
    }

    /**
     * Formulario para crear un espacio.
     */
    public function create()
    {
        return view('spaces.create');
    }

    /**
     * Guarda un espacio en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'capacidad' => 'required|integer|min:1',
            'ubicacion' => 'nullable|string|max:255',
        ]);

        Space::create($request->all());

        return redirect()->route('spaces.index')->with('success', 'Espacio creado correctamente.');
    }
}
