<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return response()->json($proveedores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nit' => 'required|string|unique:proveedors,nit',
            'nombre' => 'required|string|max:255',
            'correo_electronico' => 'required|email|unique:proveedors,correo_electronico',
            'numero_telefono' => 'required|string|max:20'
        ]);

        $proveedor = Proveedor::create($validated);
        return response()->json($proveedor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return response()->json($proveedor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $validated = $request->validate([
            'nit' => 'sometimes|required|string|unique:proveedors,nit,' . $id,
            'nombre' => 'sometimes|required|string|max:255',
            'correo_electronico' => 'sometimes|required|email|unique:proveedors,correo_electronico,' . $id,
            'numero_telefono' => 'sometimes|required|string|max:20'
        ]);

        $proveedor->update($validated);
        return response()->json($proveedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return response()->json(['message' => 'Proveedor eliminado correctamente'], 200);
    }
}