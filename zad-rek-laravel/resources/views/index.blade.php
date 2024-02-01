<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <title>Zadanie rekrutacyjne - dogs api</title>
    
        <!-- Styles -->
        @vite('resources/css/app.css')

    </head>
    
    <body>
        <div id="page">
            @yield('content')
        </div>
    </body>
</html>
