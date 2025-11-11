<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body class="bg-[linear-gradient(90deg,#d1f4b6,#66dfbc,#00c2da,#009df2,#476ade)] font-monofont-sans">
    <header class= "flex justify-between bg-blue-600 p-4 shadow-xl">
      <h1 class="text-5xl text-white font-bold ml-4 text-shadow-lg">
        Flow Control
      </h1>
      <button class="rounded-full p-2 bg-black text-white hover:bg-white hover:text-black mr-6 cursor-pointer">
        Iniciar Sesión
      </button>
    </header>

    <div class="zoom w-11/12 my-10 flex rounded-2xl items-center m-auto pl-10 bg-white rounded-r-lg">
      <div class="w-3/5 shrink-0 mr-20"> 
        <p class="text-gray-700 text-xl leading-8">
          <span class="text-6xl font-extrabold text-amber-300 mr-2 text-shadow-lg">Flow Control</span> es la 
          plataforma de gestión de proyectos más intuitiva y visual 
          diseñada para transformar el caos en claridad operativa. Utilizando la 
          metodología Kanban, nuestra aplicación permite a equipos de todos los tamaños 
          visualizar instantáneamente el progreso de sus tareas mediante tableros dinámicos 
          de arrastrar y soltar. Olvídese de las cadenas de correos y los archivos perdidos; 
          con funcionalidades de asignación directa, checklists detalladas y colaboración en 
          tiempo real, ofrecemos un ecosistema centralizado donde cada proyecto avanza sin 
          fricciones, asegurando que su equipo se mantenga enfocado en lo que realmente 
          importa: entregar resultados.
        </p>
      </div>
      <div class="w-2/5 rounded-r-lg"> 
        <img src="{{ asset('img/equipo.jpg') }}" alt="Tablero Kanban de gestión de proyectos" class="w-full h-auto rounded-lg shadow-xl ">
      </div>
    </div>

    <div class="zoom flex flex-col items-center justify-center w-5xl bg-white m-auto p-8 mb-20 rounded-2xl shadow-2xl">
        <div class="flex flex-col items-center mb-5">
          <h2 class="text-5xl font-bold mb-2">¿Sabes qué necesita para mejorar?</h2>
          <h3>Envíanos tus propuestas de mejora</h3>
        </div>
        <a href="{{ route('formulario.create') }}" 
          class="m-1 flex rounded-3xl p-6 bg-blue-600 text-white hover:bg-black">
          Enviar Propuesta
        </a> 
    </div>
  </body>
</html>