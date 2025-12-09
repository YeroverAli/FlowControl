@extends('adminlte::page')

@section('title', 'Usuario')

@section('content_header')
    <h1>Usuario {{ $user->name }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left">Nombre</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Fecha creación</th>
                        <th class="px-4 py-2">Editar usuario</th>
                        <th class="px-4 py-2">Eliminar usuario</th>
                    </tr>
                </thead>
                <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2 text-center">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-center">{{ $user->created_at }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{route('users.edit', $user->id)}}">
                                    <svg xmlns="www.w3.org" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        style="width: 3rem; height: 3rem;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 
                                        4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 
                                        0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <form action="{{route('users.destroy', $user->id)}}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:none; cursor:pointer; padding:0;">
                                        <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                            width="3rem" height="3rem" viewBox="0 0 32 32" xml:space="preserve" fill="#e61919">
                                        <path class="sharpcorners_een" d="M26,21.5C26,27.299,21.299,32,15.5,32S5,27.299,5,21.5c0-4.936,3.41-9.065,8-10.188V9h5v2.312
                                            C22.59,12.435,26,16.564,26,21.5z M16,6c0-0.552,0.448-1,1-1s1,0.448,1,1c0,1.103,0.897,2,2,2s2-0.897,2-2V3.707l0.914,0.914
                                            l0.707-0.707L22.707,3H24V2h-1.293l0.914-0.914l-0.707-0.707L22,1.293V0h-1v1.293l-0.914-0.914l-0.707,0.707L20.293,2H19v1h1.293
                                            l-0.914,0.914l0.707,0.707L21,3.707V6c0,0.552-0.448,1-1,1s-1-0.448-1-1c0-1.103-0.897-2-2-2s-2,0.897-2,2v2h1V6z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{route('users.index')}}" class="btn btn-secondary">Volver atrás</a>

@endsection