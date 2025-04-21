<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Qrcode</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="text-center">

    <h1 class="text-center text-7xl mb-10 no-print">
        @if (request()->has('page'))
            Page : {{ request()->page }}
        @else
            Page : 1
        @endif
    </h1>
    
    <style>
        .mo-svg-qucode svg {
            width: 100%;
            height: 100%;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>

    @if(count($qrcodes))
        <div class="flex flex-wrap gap-0 items-center justify-center">
            @foreach ($qrcodes as $qrcode)
                <div class="w-[3.9cm] h-[3.5cm] relative">
                    <img src="{{ asset('assets/print_image2.png') }}" class="w-full h-full">
                    <div class="mo-svg-qucode w-[1.5cm] h-[1.5cm] absolute left-[.5cm] top-[.8cm] bg-red">
                        {!! $qrcode->qrcode_svg !!}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="no-print">
            {{-- {{ $qrcodes->links()->with($paginate) }} --}}
            {{-- {{ $qrcodes->withPath($paginate)->links() }} --}}
            {{ $qrcodes->appends(['paginate' => $paginate])->links() }}


        </div>
    @endif

    <script>
        window.onload = () => {
            window.print();
        };
    </script>



</body>
</html>