@extends('layout.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800">🗑️ Eliminar Usuario</h1>
    <p>¿Está seguro que desea eliminar este usuario?</p>

    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 mt-4">
    <table class="table-auto w-full">
        <thread>
            <tr>
                <th class="col-md-1">ID</th>
                <th class="col-md-5">Nombre</th>
                <th class="col-md-6">Email</th>
                <th class="col-md-1">Tipo</th>
            </tr>
        </thread>
        <tbody>
            <tr>
                <td class="col-md-1">{{ $usuario->id }}</td>
                <td class="col-md-5">{{ $usuario->name }}</td>
                <td class="col-md-6">{{ $usuario->email }}</td>
                <td class="col-md-1">{{ $usuario->user_type }}</td>
            </tr>   
        </tbody>
    </table>

    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
        @csrf
        @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Si, eliminar</button>
    <a href="{{ route('usuarios.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancelar</a>
    </form>
</div>
</div>
@endsection