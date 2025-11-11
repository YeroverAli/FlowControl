<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registros del Formulario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 pb-2">
            📋 Registros Guardados (Flow Control)
        </h1>

        {{-- @if (count($records) > 0) --}}
        @if (!empty($records))
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        @foreach ($headers as $header)
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($records as $record)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                {{ $record['Email'] ?? '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $record['Tema'] ?? '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $record['Descripción'] ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            {{-- Estructura de control: Si no hay registros --}}
            <p class="text-center py-10 text-gray-500">
                Aún no hay registros en el archivo CSV.
            </p>
        @endif
    </div>
            <a href="{{ route('formulario.create') }}" 
          class="m-1 flex mt-7 justify-center rounded-3xl p-6 bg-blue-600 text-white hover:bg-black">
          Enviar Propuesta
        </a>

</body>
</html>