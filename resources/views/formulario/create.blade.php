<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar formulario</title>
    @vite('resources/css/app.css') <!-- Importa los estilos generados por Vite (Tailwind CSS, etc.) -->
</head>
<body class="bg-[linear-gradient(90deg,#d1f4b6,#66dfbc,#00c2da,#009df2,#476ade)] font-monofont-sans">
    <header class="grid grid-cols-3 items-center w-full p-10">
    <!-- Botón para volver a la página de inicio -->
    <div class="flex justify-start">
        <a href="{{ route('index') }}">
            <button class="rounded-2xl bg-black text-white hover:bg-white hover:text-black cursor-pointer px-7 py-3 shadow-md">
                Inicio
            </button>
        </a>
    </div>

    <!-- Título principal centrado -->
    <h1 class="text-5xl text-center font-bold drop-shadow-lg">ENVÍANOS TUS DUDAS</h1>

    <!-- Botón que lleva a la lista de formularios enviados -->
    <div class="flex justify-end">
        <a href="{{ route('formulario.index') }}">
            <button class="rounded-2xl bg-black text-white hover:bg-white hover:text-black cursor-pointer px-7 py-3 shadow-md">
                Ver dudas
            </button>
        </a>
    </div>
    </header>
    <!-- MENSAJE DE ERRORES DE VALIDACIÓN (si existen) -->
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error) <!-- Muestra cada error de validación -->
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
    @endif
    <main class="flex grow flex-col items-center p-8">

        <!-- FORMULARIO DE ENVÍO -->
        <form action="{{ route('formulario.store') }}" method="POST" class="bg-white/90 rounded-2xl shadow-2xl p-10 w-full max-w-2xl space-y-6 border border-white/30">
            
            @csrf <!-- Token de seguridad requerido por Laravel para formularios POST -->
            <!-- Campo de correo electrónico -->
            <div>
                <label for="email">Introduzca el correo: </label> <br>
                <input class="block py-1.5 pr-3 pl-4 text-base text-black placeholder:text-gray-500  sm:text-sm/6 focus:outline-sky-500 w-full shadow-md bg-gray-300 rounded-2xl" type="text" id="email" name="email" placeholder="ejemplo@gmail.com">
            </div>

            <!-- Campo de asunto -->
            <div>
                <label for="topic">Introduzca el asunto: </label> <br>
                <input class="block py-1.5 pr-3 pl-4 text-base text-black placeholder:text-gray-500  sm:text-sm/6 focus:outline-sky-500 w-full shadow-md bg-gray-300 rounded-2xl" type="text" id="topic" name="topic" placeholder="Esto es un formulario genial">
            </div>

            <!-- Campo de descripción o sugerencia -->
            <div>
                <label for="description">Escribe la propuesta para mejorar nuestra página: </label>
                <textarea class="block py-1.5 pr-3 pl-4 text-base text-black placeholder:text-gray-500  sm:text-sm/6 focus:outline-sky-500 w-full shadow-md bg-gray-300 rounded-2xl" id="description" name="description" rows="3" cols="30" placeholder="Escriba alguna sugerencia de como quieres que sea nuestra página web"></textarea>
            </div>

            <!-- Botón para enviar el formulario -->
            <div class="flex justify-center">
                <input
                    class="rounded-2xl bg-black text-white hover:bg-sky-500 cursor-pointer px-7 py-3 shadow-md"
                    type="submit"
                    value="ENVIAR"
                >
            </div>
        </form>
    </main>
</body>
</html>