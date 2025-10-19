<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar todos los productos
    public function index()
    {
        $productos = Producto::all();
        return response()->json([
            'success' => true,
            'data' => $productos
        ], 200);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        // LOG PARA DEBUG
        \Log::info('=== STORE PRODUCTO ===', [
            'has_file_imagen' => $request->hasFile('imagen'),
            'all_files' => array_keys($request->allFiles()),
            'all_input' => $request->except(['imagen']),
            'content_type' => $request->header('Content-Type'),
        ]);

        $request->validate([
            'ean_producto' => 'required|string|max:50',
            'Referencia' => 'required|string|max:100',
            'Gramos' => 'nullable|numeric',
            'Tamano' => 'nullable|string|max:50',
            'Color' => 'nullable|string|max:50',
            'PrecioUnitario' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagenPath = null;

        // Guardar la imagen si existe
        if ($request->hasFile('imagen')) {
            \Log::info('IMAGEN ENCONTRADA', ['nombre' => $request->file('imagen')->getClientOriginalName()]);
            
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            
            // Guardar en public/imagenes
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $imagenPath = '/imagenes/' . $nombreImagen;
            
            \Log::info('IMAGEN GUARDADA', ['ruta' => $imagenPath]);
        } else {
            \Log::info('SIN IMAGEN');
        }

        $producto = Producto::create([
            'ean_producto' => $request->ean_producto,
            'Referencia' => $request->Referencia,
            'Gramos' => $request->Gramos,
            'Tamano' => $request->Tamano,
            'Color' => $request->Color,
            'PrecioUnitario' => $request->PrecioUnitario,
            'imagen' => $imagenPath,
            'CantidadStock' => $request->CantidadStock ?? 0,
            'Estado' => 'activo',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto creado exitosamente',
            'data' => $producto
        ], 201);
    }

    // Ver un producto específico
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

    // Actualizar un producto
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
            'Referencia' => 'required|string|max:100',
            'Gramos' => 'nullable|numeric',
            'Tamano' => 'nullable|string|max:50',
            'Color' => 'nullable|string|max:50',
            'PrecioUnitario' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagenPath = $producto->imagen; // Mantener la imagen actual

        // Si hay nueva imagen, eliminar la anterior y guardar la nueva
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
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
            'Referencia' => $request->Referencia,
            'Gramos' => $request->Gramos,
            'Tamano' => $request->Tamano,
            'Color' => $request->Color,
            'PrecioUnitario' => $request->PrecioUnitario,
            'imagen' => $imagenPath,
            'CantidadStock' => $request->CantidadStock ?? $producto->CantidadStock,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Producto editado exitosamente',
            'data' => $producto
        ], 200);
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        }

        // Eliminar imagen si existe
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