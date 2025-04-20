<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout};
use App\Models\QCategory ;
new
#[Layout('components.layouts.app-qrcode')]
class extends Component {

    public $qrcodes;
    public function mount(QCategory $qCategory)
    {
        $this->qrcodes = $qCategory->qrcodes;
    }
}; ?>

<div>
    <style>
        .mo-svg-qucode svg{
            width: 100%;
            height: 100%;
        }
        /* .mo-svg-qucode svg rect{
            fill: transparent;
        }
        .mo-svg-qucode svg path{
            fill: white;
        } */
    </style>
    @if(count($qrcodes))
        <div class="flex flex-wrap  gap-0 items-center justify-center">
            
            @foreach ($qrcodes as $qrcode)
                {{-- <div class="w-[472px] h-[413px] relative"> --}}
                <div class="w-[3.9cm] h-[3.5cm] relative">
                    {{-- <img src="{{ asset('assets/print_image2.png') }}" class="w-full h-full"> --}}
                    {{-- <div class="mo-svg-qucode w-[2cm] h-[2cm] absolute left-[.2cm] top-[.4cm] bg-red"> --}}
                    <div class="mo-svg-qucode w-[1.5cm] h-[1.5cm] absolute left-[.5cm] top-[.8cm] bg-red">
                        {!! $qrcode->qrcode_svg !!}
                    </div>
                </div>
                {{-- <div class="inline">
                        {!! $qrcode->qrcode_svg !!}
                </div> --}}
            @endforeach
        </div>
    @endif

    <script>
        onload = ()=>{
            window.print();
        }
    </script>
</div>
