@extends('layout.admin')

@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">➕ Agregar Libro</h1>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            
            <form action="{{ route('libros.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Libro</label>
                    <input type="text" name="nombre" id="nombre" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div>
                    <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                    <input type="text" name="isbn" id="isbn" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div>
                    <label for="autor" class="block text-sm font-medium text-gray-700">Autor</label>
                    <input type="text" name="autor" id="autor" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div>
                    <label for="editorial" class="block text-sm font-medium text-gray-700">Editorial</label>
                    <input type="text" name="editorial" id="editorial" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div>
                    <label for="categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                    <select name="categoria" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">              
                    <option value=""></option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="flex space-x-3">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        Guardar Libro
                    </button>
                    <a href="{{ route('home') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection