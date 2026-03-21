@extends('layout.admin')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800">Seleccionar Libro para Prestamo</h1>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 mt-6">
        <div class=" px-3 py-1 mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Usuario:</h2>
            <p><strong>ID:</strong> {{ $usuario->id }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
        </div>

        <form action="{{ route('prestamos.store') }}" method="POST" class="p-6">
            @csrf
            <label for="libro" class="px-2 py-2 block text-sm font-medium text-gray-700">Libro:</label>
            <select name="libro_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach($libros as $libro)
                    <option value="{{ $libro->id }}">{{ $libro->nombre }} - {{ $libro->autor }}</option>
                @endforeach
            </select>
            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">

            <div class="px-2 py-2 flex space-x-3 between mt-4">
                <input type="submit" value="Prestar" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                <a href="{{ route('prestamos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">Cancelar</a>
            </div>                   
        </form>

    </div>
</div>
@endsection