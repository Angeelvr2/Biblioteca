@extends('layout.admin')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800">Crear Prestamo</h1>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 mt-6">
        <form action="{{route ('prestamos.buscar_usuario') }}" method="POST" class="p-6">
            @csrf
            <label for="usuario_id" class="px-2 py-2 block text-sm font-medium text-gray-700">ID Usuario:</label>
            <input type="text" name="usuario_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <label for="text" name="usuario_nombre" class="px-2 py-2 block text-sm font-medium text-gray-700">Nombre Usuario:</label>
            <input type="text" name="usuario_nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            
            <div class="px-2 py-2 flex space-x-3 between mt-4">
                <input type="submit" value="Buscar" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                <a href="{{ route('prestamos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">Cancelar</a>
            </div>                    
        </form>

        @isset($usuario)
        <div class=" px-2 py-2 mt-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Usuario Encontrado:</h2>
            <p><strong>ID:</strong> {{ $usuario->id }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
        </div>

        <form action="{{ route('prestamos.select_libro') }}" method="POST" class="p-3">
            @csrf
            <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
            <input type="submit" value="Seleccionar Libro" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md mt-4">
        </form>
        @endisset
    </div>
</div>
@endsection