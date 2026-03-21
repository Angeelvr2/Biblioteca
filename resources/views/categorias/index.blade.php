@extends('layout.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Encabezado con título y botón de nueva categoría -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">📋 Categorías</h1>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('categorias.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                + Nueva Categoría
            </a>
        </div>

        <!-- Tarjeta contenedora de la tabla -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <!-- Cabecera de la tabla -->
                    <thead class="bg-gradient-to-r from-indigo-600 to-indigo-800 text-white">
                        <tr>
                            <th class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">ID</th>
                            <th class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Nombre</th>
                            <th class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Acciones</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody class="divide-y divide-gray-200">
                        @forelse($categorias as $categoria)
                            <tr class="hover:bg-indigo-50 transition duration-200">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $categoria->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $categoria->nombre }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium transition">✏️ Editar</a>
                                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium transition">🗑️ Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <p class="text-lg">No hay categorías registradas</p>
                                        <a href="#" class="mt-4 text-indigo-600 hover:text-indigo-800 font-medium">+ Crear primera categoría</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categorias->links() }} <!-- Paginación de Laravel -->
            </div>
        </div>

        <!-- Contador de registros -->
        <div class="mt-4 text-sm text-gray-500">
            Mostrando {{ $categorias->count() }} {{ $categorias->count() == 1 ? 'categoría' : 'categorías' }}
        </div>
    </div>
@endsection