@extends('adminlte::page')

@section('title', 'Todos los usuarios')

@section('content_header')
    <h1>Todos los usuarios</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Fecha creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection