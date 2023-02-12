<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body style="background-color: #fbfafe;">
        @inertia
        <noscript>
            <h1
                style="display: flex;
                justify-content: center;
                margin-top: 7vw;
                margin-left: 3vw;
                margin-right: 3vw;
                color: #504e4e;"
            >
                Упс... Здається ваш пристрій застарілий для використання цього сайту.
            </h1>
        </noscript>
    </body>
</html>

