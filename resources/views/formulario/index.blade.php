<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros del Formulario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">
    <a href="{{ route('index') }}">
            <button class="rounded-2xl bg-black text-white hover:bg-white hover:text-black cursor-pointer px-7 py-3 shadow-md">
                Inicio
            </button>
    </a>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 pb-2">
            Registros Guardados
        </h1>

        {{-- @if (count($formularios) > 0) --}}
        @if (!empty($formularios))
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        @foreach(array_keys($formularios[0]) as $header)
                            <th>{{ ucfirst($header) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($formularios as $form)
                        <tr>
                            @foreach($form as $value)
                                <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay formularios enviados aún.</p>
        @endif
    </div>
    <a href="{{ route('formulario.create') }}" 
        class="max-w-4xl mx-auto m-1 flex mt-7 justify-center rounded-3xl p-6 bg-blue-600 text-white hover:bg-black">
        Enviar otra propuesta
    </a>

</body>
</html>