@extends('layout.user')

@section('content')
<h1>Bienvenido, {{ auth()->user()->name }}</h1>
@endsection