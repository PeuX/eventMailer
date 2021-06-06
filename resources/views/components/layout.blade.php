<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eventMailer</title>
        
        <!-- tailwind -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>

        </style>
        @livewireStyles
    </head>
    <body class="antialiased bg-gray-400">
        <div class="flex flex-col justify-center items-center mt-12">
            <h1 class="block flex-grow text-2xl text-white">{{ $title }}</h1>
            <p class="block flex-grow text-xl text-gray-200">{{ $commentaire }}</p>
            <p class="block flex-grow text-s text-gray-200" > Principe : vous choisissez une date, celle qui vous co$
            <p class="block flex-grow text-s text-gray-200" > Attention, chaque date ne peut être sélectionnée qu'un$
            <p class="block flex-grow text-s text-gray-200" > PS : N'oubliez pas de cliquer sur "Et on réserve pour $
        </div>

        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            {{ $slot }}
        </div>
        @livewireScripts
        @stack('scripts')
    </body>
</html>