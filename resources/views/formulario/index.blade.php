<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros del Formulario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">

    <!-- Botón para volver a la página de inicio -->
    <a href="{{ route('index') }}">
            <button class="rounded-2xl bg-black text-white hover:bg-white hover:text-black cursor-pointer px-7 py-3 shadow-md">
                Inicio
            </button>
    </a>
     <!-- Contenedor principal centrado -->
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 pb-2">
            Registros Guardados
        </h1>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Asunto</th>
                        <th>Fecha creación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->topic }}</td>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
     <!-- Botón para ir al formulario y enviar una nueva propuesta -->
    <a href="{{ route('formulario.create') }}" 
        class="max-w-4xl mx-auto m-1 flex mt-7 justify-center rounded-3xl p-6 bg-blue-600 text-white hover:bg-black">
        Enviar otra propuesta
    </a>

</body>
</html>