<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'cedula' => 'required|string|unique:clientes,cedula',
            'area' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clientes,email'
        ]);

        $cliente = Cliente::create($validated);
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:255',
            'cedula' => 'sometimes|required|string|unique:clientes,cedula,' . $id,
            'area' => 'nullable|string|max:255',
            'email' => 'sometimes|required|email|unique:clientes,email,' . $id
        ]);

        $cliente->update($validated);
        return response()->json($cliente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(['message' => 'Cliente eliminado correctamente'], 200);
    }
}