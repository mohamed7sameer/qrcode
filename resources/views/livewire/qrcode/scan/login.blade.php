<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\User ;
use App\Models\Qrcode;

new
#[Layout('components.layouts.blank')]
class extends Component {

    
    public string $phone = '';

    public bool $remember = true;
















    

    public $qrcode;

    public function mount($uuid)
    {
        $existQrcode = Qrcode::where([
            'uuid'=> $uuid,
            'status' => true
        ])->exists();

        if(!$existQrcode){
             return $this->redirectIntended(route('login', absolute: true), navigate: false);
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






    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate([
            'phone' => 'required',
        ], [
            'phone.required' => __('validation.required', ['attribute' => 'رقم الهاتف']),
        ]);


        $user = User::where('phone', $this->phone)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'phone' => __('auth.failed'),
            ]);
        }

        Auth::login($user, $this->remember);

        if(auth()->check()){
            $this->handleQrcode($this->qrcode);
        }

        $this->redirectIntended(route('dashboard', absolute: false), navigate: false);
    }

 
}; ?>

<div class="flex flex-col gap-6">
    


    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6"  >

        <p class="text-black mb-5">قم بتسجيل الدخول باستخدام رقم الهاتف للمشاركة في السحب</p>
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden rtl-input-group " dir="ltr">
                <span class="px-3 py-2 bg-gray-100 text-gray-600 text-sm border-l border-gray-300">
                    <flux:icon.phone />
                </span>
                <input wire:model="phone" type="tel" id="phone" name="phone" placeholder="01xxxxxxxxx" class="w-full px-3 py-2 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500  text-black">
            </div>
            @error('phone') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>

        <flux:button type="submit" class="cursor-pointer" variant="primary">
            تسجيل الدخول
        </flux:button>

        

    </form>

</div>
