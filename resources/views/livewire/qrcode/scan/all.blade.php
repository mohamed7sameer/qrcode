<?php
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\Qrcode;


new
#[Layout('components.layouts.blank')]

class extends Component {




    
    public $qrcode;
    public $uuid ;

    public function mount($uuid)
    {

        $this->uuid = $uuid ;
        $existQrcode = Qrcode::where([
            'uuid'=> $uuid,
            'status' => true
        ])->exists();

        if(!$existQrcode){
             return $this->redirectIntended(route('dashboard', absolute: true), navigate: false);
        }
        
        
        $this->qrcode = Qrcode::where([
            'uuid'=> $uuid,
            'status' => true
        ])->first();

        

        if(auth()->check())
        {
            $this->handleQrcode($this->qrcode);
            $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
        }
    }

 

    public function handleQrcode($qrcode)
    {
        
        DB::transaction(function () use ($qrcode) {
            auth()->user()->increment('points', $qrcode->qCategory->points);
        });

        auth()->user()->qrcodes()->sync([$qrcode->id]);
        
        Qrcode::find($qrcode->id)->update([
            'status' => false
        ]);
    
        
    }



    








    
    public $mode = 'login';
    
    public function handleMode($mode){
        $this->mode = $mode ;
    }


}


?>

<div class="w-full min-h-screen  bg-gray-200 px-5 pb-10" dir="rtl">
    
        <div class="pt-8 pb-4 px-6 text-center">
            {{-- <div class="w-50 m-auto text-shadow-lg" >
                <img src="{{ asset('assets/images/raw2.png') }}" class="w-full  drop-shadow-sm drop-shadow-black" >
            </div> --}}
            <div class="w-70 max-w-full flex justify-center m-auto text-shadow-lg " >
                <img src="{{ asset('assets/images/chips.png') }}" class="w-full  drop-shadow-xl drop-shadow-black" >
            </div>
            
            <p class="text-cyan-600 my-5 text-3xl text-shadow-sm text-shadow-cyan-300 font-bold">الذكرى السنوية الثامنة</p>
        </div>

        


        <div class="px-6 py-4 bg-white rounded-xl mx-4 my-6 p-4 shadow-lg mb-2">
            <div class="flex border-b mb-6">
                @if($mode === 'login')
                    <button wire:click="handleMode('login')" class="flex-1 cursor-pointer py-2 text-center text-cyan-600 border-b-2 border-cyan-600 font-semibold">تسجيل الدخول</button>
                    <button wire:click="handleMode('register')" class="flex-1 cursor-pointer py-2 text-center text-gray-400 hover:text-gray-600">حساب جديد</button>
                @else
                    <button wire:click="handleMode('login')" class="flex-1 cursor-pointer py-2 text-center text-gray-400 hover:text-gray-600">تسجيل الدخول</button>
                    <button wire:click="handleMode('register')" class="flex-1 cursor-pointer py-2 text-center text-cyan-600 border-b-2 border-cyan-600 font-semibold">حساب جديد</button>
                @endif
                
            </div>


            @if($mode === 'login')
                <livewire:qrcode.scan.login  uuid="{{$uuid}}"/>
            @else
                <livewire:qrcode.scan.register uuid="{{$uuid}}" />
            @endif

            
        </div>


        
        <div class="bg-cyan-600 text-white rounded-xl mx-4 my-6 p-4 shadow-lg mb-2">
            <h2 class="text-center font-semibold text-xl mb-5">الجوائز المتوفرة</h2>
            <div class="flex justify-around items-center text-center">
                <div class="flex flex-col items-center">
                    <img src="{{ asset('assets/images/playstition5.png') }} " class="w-25">    
                    <p class="mt-5 text-2md font-medium">بلايستيشن 5</p>
                </div>
                <div class="flex flex-col items-center">
                    <img src="{{ asset('assets/images/iphone.png') }}" class="w-25">    
                    <p class="mt-5 text-2md font-medium">آيفون 16</p>
                </div>
            </div>
        </div>
    
</div>