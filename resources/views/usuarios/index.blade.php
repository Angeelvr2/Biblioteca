@extends('layout.admin')

@section('content')
 <div class="container mx-auto px-4 py-8">

<h1 class="text-3xl font-bold text-gray-800">📋Lista de Usuarios</h1>
<br>

<a href="{{ route('usuarios.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 shadow-md">Crear Usuario</a>
<br><br>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
        <table class="w-full">
    <thead>
        <tr>
            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">ID</th>
            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Tipo</th>
            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $usuario->id }}</td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $usuario->name }}</td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $usuario->email }}</td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $usuario->user_type }}</td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium transition">✏️ Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium transition">🗑️ Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
   </table>
  </div>
 </div>
</div>
@endsection