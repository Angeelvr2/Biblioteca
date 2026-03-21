<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Libro;
use App\Models\Prestamo;    

class PrestamosController extends Controller
{
    public function index()
    {
       $prestamos = Prestamo::with('libro', 'usuario')->get(); 
       return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        return view('prestamos.create');
    }

    public function buscar_usuario(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $usuario_nombre = $request->input('usuario_nombre');

        if(!empty($usuario_id)) 
            {
                $usuario =  User::findOrFail($usuario_id);

                return view('prestamos.create', compact('usuario'));
            }

        if(!empty($usuario_nombre)) 
        {
            $usuario = User::where('name', 'like', '%' . $usuario_nombre . '%')->first();
                
            return view('prestamos.create', compact('usuario'));
        }
    }

    public function select_libro(Request $request)
    {
        $usuario_id = $request->input('usuario_id');
        $usuario = User::findOrFail($usuario_id);
        $libros = Libro::where('estatus', 0)->orderBy('id','asc')->get();

        return view('prestamos.select_libro', compact('usuario', 'libros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'libro_id' => 'required|exists:libros,id',
        ]);

        #Crear transacción
        \DB::beginTransaction();

        try {
        $prestamo = new Prestamo();
        $prestamo->usuario_id = $request->input('usuario_id');
        $prestamo->libro_id = $request->input('libro_id');
        $prestamo->save();

        $libros = Libro::findorFail($request->input('libro_id'));
        $libros->estatus = 1;
        $libros->save();

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->route('prestamos.index')->with('error', 'Error al registrar el préstamo. ' . $e->getMessage());
        }

        return redirect()->route('prestamos.index')->with('success', 'Préstamo registrado exitosamente.');
    }
}
