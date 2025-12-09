{{-- resources/views/admin/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Bienvenido al Panel de Administración</h1>
@endsection

@section('content')
    <p>Este es un panel de administración usando AdminLTE.</p>
    <a href="{{url('/')}}">
        <button class="px-5 py-2">Volver a la página de inicio</button>
    </a>
@endsection