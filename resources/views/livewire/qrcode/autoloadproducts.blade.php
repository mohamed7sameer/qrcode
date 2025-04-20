<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\QCategory;

new
#[Layout('components.layouts.app-qrcode')]
class extends Component {

    public $qrcodes;

    public function mount()
    {
        $this->qrcodes = collect(); // مبدئيًا فاضية
    }

    public function loadQRCodes(QCategory $qCategory)
    {
        // $this->qrcodes = $qCategory->qrcodes;
        // $this->qrcodes = $qCategory->qrcodes;
        // dd($qCategory->qrcodes);
    }
};
?>

<div wire:init="loadQRCodes">
    <style>
        .mo-svg-qucode svg {
            width: 100%;
            height: 100%;
        }
    </style>

    @if($qrcodes->count())
        <div class="flex flex-wrap gap-0 items-center justify-center">
            @foreach ($qrcodes as $qrcode)
                <div class="w-[3.9cm] h-[3.5cm] relative">
                    <div class="mo-svg-qucode w-[1.5cm] h-[1.5cm] absolute left-[.5cm] top-[.8cm] bg-red">
                        {!! $qrcode->qrcode_svg !!}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div>Loading...</div>
    @endif

    <script>
        // onload = () => {
        //     // window.print();
        // }
    </script>
</div>
