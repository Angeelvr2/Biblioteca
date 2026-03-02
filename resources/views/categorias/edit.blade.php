@extends('layout.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">✏️ Editar Categoría</h1>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <form action="{{ route('categorias.update', $categorias->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
                    <input type="text" name="nombre" id="nombre" value="{{ $categorias->nombre }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="flex space-x-3">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('categorias.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        Cancelar
                    </a>
                </div>
            </form> 
        </div>
    </div>
@endsection