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

    
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $age = '';

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

        // auth()->user()->qrcodes()->sync([$qrcode->id]);
        auth()->user()->qrcodes()->syncWithoutDetaching([$qrcode->id]);
        
        Qrcode::find($qrcode->id)->update([
            'status' => false
        ]);
    
        
    }


















    /**
     * Handle an incoming authentication request.
     */
    public function regiter(): void
    {


        
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'age' => ['required', 'numeric'],
            'phone' => ['required', 'string','unique:' . User::class,'regex:/^0\d{10}$/'],
        ],[
            'phone.required' => __('validation.required', ['attribute' => 'رقم الهاتف']),
            'name.required' => __('validation.required', ['attribute' => 'الإسم']),
            'name.string' => __('validation.string', ['attribute' => 'الإسم']),
            'name.max' => __('validation.max.string', ['attribute' => 'الإسم', 'max' => 255]),
            'phone.unique' => __('validation.unique', ['attribute' => 'رقم الهاتف']),
            'phone.regex' =>__('validation.regex', ['attribute' => 'رقم الهاتف']),

            'email.required' => __('validation.required', ['attribute' => 'البريد الإلكتروني']),
            'email.string' => __('validation.string', ['attribute' => 'البريد الإلكتروني']),
            'email.lowercase' => __('validation.lowercase', ['attribute' => 'البريد الإلكتروني']),
            'email.email' => __('validation.email', ['attribute' => 'البريد الإلكتروني']),
            'email.max' => __('validation.max.string', ['attribute' => 'البريد الإلكتروني', 'max' => 255]),
            'email.unique' => __('validation.unique', ['attribute' => 'البريد الإلكتروني']),

            'age.required' => __('validation.required', ['attribute' => 'العمر']),
            'age.numeric' => __('validation.numeric', ['attribute' => 'العمر']),

        ]
    );

    
    

    $user = User::create($validated);
    Auth::login($user,true);

    if(auth()->check()){
        $this->handleQrcode($this->qrcode);
    }

    $this->redirectIntended(route('dashboard', absolute: false), navigate: false);
    }

 
}; ?>

<div class="flex flex-col gap-6">
    


    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="regiter" class="flex flex-col gap-6"  >

        <p class="text-black mb-5">قم بالاشتراك للمشاركة في السحب</p>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">الإسم</label>
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden rtl-input-group " >
                <span class="px-3 py-2 bg-gray-100 text-gray-600 text-sm border-l border-gray-300">
                    <flux:icon.user />
                </span>
                <input wire:model="name" type="text" id="name" name="name" placeholder="اكتب اسمك" class="w-full px-3 py-2 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500  text-black">
            </div>
            @error('name') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>
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
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden rtl-input-group " dir="ltr">
                <span class="px-3 py-2 bg-gray-100 text-gray-600 text-sm border-l border-gray-300">
                    <flux:icon.envelope />
                </span>
                <input wire:model="email" type="email" id="email" name="email" placeholder="email@domain.com" class="w-full px-3 py-2 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500  text-black">
            </div>
            @error('email') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700 mb-1">العمر</label>
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden rtl-input-group " dir="rtl">
                <span class="px-3 py-2 bg-gray-100 text-gray-600 text-sm border-l border-gray-300">
                    <flux:icon.calendar />
                </span>
                <input wire:model="age" type="number" id="age" name="age" placeholder="اكتب العمر" class="w-full px-3 py-2 focus:outline-none focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500  text-black">
            </div>
            @error('age') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>

        <flux:button type="submit" class="cursor-pointer" variant="primary">
            إشترك
        </flux:button>

        

    </form>

</div>
