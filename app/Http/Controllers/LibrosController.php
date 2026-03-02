<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosController extends Controller
{
    public function create()
    {
        $categorias = Categorias::all();
        return view('libros.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:250',
            'isbn' => 'required|string|max:100',
            'autor' => 'required|string|max:250',
            'editorial' => 'required|string|max:250',
            'categoria' => 'required|exists:categorias,id',
        ]);

        $libro = new Libro();
        $libro->nombre = $request->nombre;
        $libro->isbn = $request->isbn;
        $libro->autor = $request->autor;
        $libro->editorial = $request->editorial;
        $libro->id_categoria = $request->categoria;
        $libro->estatus = 0;
        $libro->save();

        return redirect()->route('home')->with('success', 'Libro agregado exitosamente');
    }

    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        $categorias = Categorias::all();
        return view('libros.edit', compact('libro', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:250',
            'isbn' => 'required|string|max:100',
            'autor' => 'required|string|max:250',
            'editorial' => 'required|string|max:250',
            'categoria' => 'required|exists:categorias,id',
        ]);

        $libro = Libro::findOrFail($id);
        $libro->nombre = $request->nombre;
        $libro->isbn = $request->isbn;
        $libro->autor = $request->autor;
        $libro->editorial = $request->editorial;
        $libro->id_categoria = $request->categoria;
        $libro->save();

        return redirect()->route('home')->with('success', 'Libro actualizado exitosamente');
    }

    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();

        return redirect()->route('home')->with('success', 'Libro eliminado exitosamente');
    }
}
