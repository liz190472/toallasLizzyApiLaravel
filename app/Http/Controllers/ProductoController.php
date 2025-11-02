<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return response()->json([
            'success' => true,
            'data' => $productos
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ean_producto' => 'required|string|max:50',
            'referencia' => 'required|string|max:100',
            'gramos' => 'nullable|numeric',
            'tamano' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'preciounitario' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $imagenPath = '/imagenes/' . $nombreImagen;
        }

        $producto = Producto::create([
            'ean_producto' => $request->ean_producto,
            'Referencia' => $request->referencia,
            'Gramos' => $request->gramos,
            'Tamano' => $request->tamano,
            'Color' => $request->color,
            'PrecioUnitario' => $request->preciounitario,
            'imagen' => $imagenPath,
            'CantidadStock' => $request->cantidadstock ?? 0,
            'Estado' => 'activo',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado exitosamente',
            'data' => $producto
        ], 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $producto
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        $request->validate([
            'ean_producto' => 'required|string|max:50',
            'referencia' => 'required|string|max:100',
            'gramos' => 'nullable|numeric',
            'tamano' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'preciounitario' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagenPath = $producto->imagen;

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $imagenPath = '/imagenes/' . $nombreImagen;
        }

        $producto->update([
            'ean_producto' => $request->ean_producto,
            'Referencia' => $request->referencia,
            'Gramos' => $request->gramos,
            'Tamano' => $request->tamano,
            'Color' => $request->color,
            'PrecioUnitario' => $request->preciounitario,
            'imagen' => $imagenPath,
            'CantidadStock' => $request->cantidadstock ?? $producto->CantidadStock,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto editado exitosamente',
            'data' => $producto
        ], 200);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        if ($producto->imagen && file_exists(public_path($producto->imagen))) {
            unlink(public_path($producto->imagen));
        }

        $producto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado exitosamente'
        ], 200);
    }
}