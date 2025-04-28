<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="icon" type="image/x-icon" href="{{ asset('/assets/images/icon.ico') }}">


<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        
        <style>
            
        .rubik-400 {
        font-family: "Rubik", sans-serif;
        font-optical-sizing: auto;
        /* font-weight: 400; */
        font-style: normal;
        }
        </style>





@vite(['resources/css/app.css', 'resources/js/app.js'])
{{-- @fluxAppearance --}}
