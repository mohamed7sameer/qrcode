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
#[Layout('components.layouts.blank2')]
class extends Component {

    
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $age = '';

    public bool $remember = true;

















    
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

{{-- <div class="flex flex-col gap-6">
    


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

</div> --}}








<div class="bg-transparent text-white w-full max-w-md px-7">

    <h1 class="text-4xl  mb-2  md:text-left">Register</h1>

    <p class="text-xs mb-6  text-white">
        to get the chance to win iphone 16 & playstation five
    </p>

    <p class="text-lg mb-2 ">
        Are you have Account ?
        <a href="{{ route('qrcode.scan-qrcode',$uuid) }}" wire:navigate class="text-sm text-[#00c5d9] hover:underline font-semibold">Login now.</a>
    </p>

    <form wire:submit="regiter">
        <div class="mb-5">
            <div class="relative">
                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 h-full w-10 bg-[#00c5d9] text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </span>
                <input
                    type="text"
                    wire:model="name"
                    placeholder="Name"
                    class="w-full p-3 pl-12 rounded-r-lg bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                    
                >
            </div>
            @error('name') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>
        <div class="mb-5">
            <div class="relative">
                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 h-full w-10 bg-[#00c5d9] text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                </span>
                <input
                    type="tel"
                    wire:model="phone"
                    placeholder="Phone"
                    class="w-full p-3 pl-12 rounded-r-lg bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"        
                >
            </div>
            @error('phone') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>
        <div class="mb-5">
            <div class="relative">
                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 h-full w-10 bg-[#00c5d9] text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                </span>
                <input
                    type="email"
                    wire:model="email"
                    placeholder="Email"
                    class="w-full p-3 pl-12 rounded-r-lg bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"        
                >
            </div>
            @error('email') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>
        <div class="mb-5">
            <div class="relative">
                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 h-full w-10 bg-[#00c5d9] text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 448 512"><path d="M128 0c17.7 0 32 14.3 32 32l0 32 128 0 0-32c0-17.7 14.3-32 32-32s32 14.3 32 32l0 32 48 0c26.5 0 48 21.5 48 48l0 48L0 160l0-48C0 85.5 21.5 64 48 64l48 0 0-32c0-17.7 14.3-32 32-32zM0 192l448 0 0 272c0 26.5-21.5 48-48 48L48 512c-26.5 0-48-21.5-48-48L0 192zm64 80l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm128 0l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zM64 400l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0zm112 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16l0-32c0-8.8-7.2-16-16-16l-32 0c-8.8 0-16 7.2-16 16z"/></svg>
                </span>
                <input
                    type="text"
                    type="number"
                    placeholder="Age"
                    wire:model="age"
                    class="w-full p-3 pl-12 rounded-r-lg bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"        
                >
            </div>
            @error('age') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>


        <flux:button type="submit" class="cursor-pointer w-full bg-[#00c5d9] hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200" variant="primary">
            Create
        </flux:button>

        

    </form>

</div>