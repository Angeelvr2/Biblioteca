@extends('layout.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800">Prestamos</h1>
<br>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
           {{ session('error') }}
        </div>
    @endif


    <a href="{{ route('prestamos.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">Crear Prestamo</a>
<br><br>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">ID</th>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Libro</th>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Usuario</th>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Fecha de Préstamo</th>
                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Acciones</th>
            </tr>
        </thead>
    <tbody>
        @foreach($prestamos as $prestamo)
            <tr class="border-t">
                <td class="px-6 py-4 whitespace-nowrap">{{ $prestamo->id }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $prestamo->libro->nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $prestamo->usuario->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $prestamo->created_at->format('Y-m-d') }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <!-- Aquí puedes agregar botones para editar o eliminar el préstamo -->
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                    <a href="#" class="text-red-600 hover:text-red-900 ml-4">Eliminar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
</div>
</div>
@endsection