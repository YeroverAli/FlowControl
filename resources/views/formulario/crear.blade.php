<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar formulario</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[linear-gradient(90deg,#d1f4b6,#66dfbc,#00c2da,#009df2,#476ade)] font-monofont-sans">
    <header class="flex">
        <h1 class="text-2xl text-center">ENVÍANOS TUS DUDAS</h1>
        <div class="flex-1 flex justify-end">
            <button class="rounded-full bg-black text-white hover:bg-white hover:text-black">Ver dudas</button>
        </div>
    </header>
    <form action="{{ route('formulario.store') }}" method="post">
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
</body>
</html>