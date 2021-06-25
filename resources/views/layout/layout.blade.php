<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test 7 - @yield('title')</title>
        <link 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
            rel="stylesheet" 
            integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
            crossorigin="anonymous">
    </head>
    <body>
        <div id="app" class="container">
            <h1>App</h1>
            <router-link to="/categories">Categorias</router-link>
            <router-link to="/attributes">Atributos</router-link>
            <router-link to="/groups">Grupos</router-link>
            <router-link to="/templates">Plantillas</router-link>
            <router-link to="/products">Productos</router-link>
            <router-view></router-view>
        </div>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" 
            crossorigin="anonymous">
        </script>

        <script 
            src="js/app.js"
            type="text/javascript" async>
        </script>
    </body>
</html>