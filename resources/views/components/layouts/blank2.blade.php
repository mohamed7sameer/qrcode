<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        
        @include('partials.head')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        
        <style>
            
        .rubik-400 {
        font-family: "Rubik", sans-serif;
        font-optical-sizing: auto;
        /* font-weight: 400; */
        font-style: normal;
        }
        </style>
    </head>
    <body style="background:url('{{ asset('assets/images/bg.webp') }}') center; background-size: cover;" class="rubik-400  min-h-screen">

        <div class="mt-5 mb-10">
            <img src="{{ asset('assets/images/one.png') }}" class="w-full mb-5">
        </div>
    

        {{ $slot }}


        <div class="pt-10 pb-10">
            <img src="{{ asset('assets/images/raw-chipsy.png') }}" class="w-full mb-5">
        </div>


        @fluxScripts
    </body>
</html>




