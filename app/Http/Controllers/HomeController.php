<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type === 'admin') {
            $libros = Libro::with('categoria')->paginate(5);
            $totalLibros = $libros->total();
            $libros_prestados = Libro::where('estatus', 1)->count();
            $total_usuarios = User::count();
            $devoluciones_pendientes = Prestamo::where('estado', 'pendiente')->count();

        return view('home.index', compact('libros', 'totalLibros', 'libros_prestados', 'total_usuarios', 'devoluciones_pendientes'));
        } else {
          return view('home.index_user');  
        }
    }
}
