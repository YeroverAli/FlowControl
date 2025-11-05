<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar formulario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[linear-gradient(90deg,#d1f4b6,#66dfbc,#00c2da,#009df2,#476ade)] font-monofont-sans">
    <header class="grid grid-cols-3 items-center w-full p-10">
    <div class="flex justify-start">
        <a href="{{ route('index') }}">
        <button class="rounded-2xl bg-black text-white hover:bg-white hover:text-black cursor-pointer px-7 py-3 shadow-md">
            Inicio
        </button>
        </a>
    </div>

    <h1 class="text-5xl text-center font-bold drop-shadow-lg">ENVÍANOS TUS DUDAS</h1>

    <div class="flex justify-end">
        <button class="rounded-2xl bg-black text-white hover:bg-white hover:text-black cursor-pointer px-7 py-3 shadow-md">
        Ver dudas
        </button>
    </div>
    </header>
    <main class="flex grow flex-col items-center p-8">
        <form action="{{ route('formulario.store') }}" method="post" class="bg-white/90 rounded-2xl shadow-2xl p-10 w-full max-w-2xl space-y-6 border border-white/30">
            <div>
                <label for="email">Introduzca el correo: </label> <br>
                <input type="text" id="email" name="email" placeholder="ejemplo@gmail.com">
            </div>

            <div>
                <label for="topic">Introduzca el asunto si lo desea: </label> <br>
                <input type="text" id="topic" name="topic" placeholder="Esto es un formulario genial">
            </div>

            <div>
                <label for="description">Escribe una descripción: </label>
                <textarea id="description" name="description" rows="4" cols="50" placeholder="Escriba alguna sugerencia de como quieres que sea la formación"></textarea>
            </div>

            <input type="submit" value="ENVIAR">
        </form>
    </main>
</body>
</html>