<?php

use Livewire\Volt\Component;
use Livewire\Attributes\{Layout};
use App\Models\QCategory ;
use Livewire\WithPagination;
use Illuminate\Http\Request;

new
#[Layout('components.layouts.app-qrcode')]
class extends Component {


    use WithPagination;


    // public $qrcodes;
    public $qrcodes_id;
    public $paginate = 5000;
    // public function mount(QCategory $qCategory)
    public function mount($qCategory, Request $request)
    {
        
        // $this->qrcodes = $qCategory->qrcodes;
        $this->qrcodes_id = $qCategory;

        if($request->has('paginate')){
            $this->paginate = $request->paginate ;
        }

        $this->js(
<<<"JAVASCRIPT"
onload = ()=>{
    window.print();
}
JAVASCRIPT
);


    }

    public function hydrate()
    {
$this->js(
<<<"JAVASCRIPT"
onload = ()=>{
    setTimeout(() => {
        window.print();    
    }, 1000);
    
}
JAVASCRIPT
);
    }


    public function with(): array
    {

        return [
            'qrcodes' => QCategory::findOrFail($this->qrcodes_id)?->qrcodes()?->paginate($this->paginate)
        ];
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

        @media print {    
            .no-print{
                display: none !important;
            }
        }

    </style>
    @if(count($qrcodes))
        <div class="flex flex-wrap  gap-0 items-center justify-center">
            
            @foreach ($qrcodes as $qrcode)
                {{-- <h1>{{$qrcode->id}}</h1> --}}
                {{-- <div class="w-[472px] h-[413px] relative"> --}}
                <div class="w-[3.9cm] h-[3.5cm] relative">
                    <img src="{{ asset('assets/print_image2.png') }}" class="w-full h-full">
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
        <div class="no-print">
            {{ $qrcodes->links() }}

        </div>
    @endif

    <script>
        
    </script>
</div>
