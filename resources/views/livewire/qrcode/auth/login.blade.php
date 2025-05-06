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

new
#[Layout('components.layouts.blank2')]
class extends Component {

    
    public string $phone = '';

    public bool $remember = true;


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

        $this->redirectIntended(route('dashboard', absolute: false), navigate: false);
    }

 
}; ?>



<div class="bg-transparent text-white w-full max-w-md px-7">

    <h1 class="text-4xl  mb-2  md:text-left">Log in</h1>

    <p class="text-xs mb-6  text-white">
        to get the chance to win iphone 16 & playstation five
    </p>

    <p class="text-lg mb-2 ">
        First time to sign?
        <a href="{{ route('register') }}" wire:navigate class="text-sm text-[#00c5d9] hover:underline font-semibold">Create now.</a>
    </p>

    <x-auth-session-status class="text-center" :status="session('status')" />
    <form wire:submit="login">
        <div class="mb-5">
            <div class="relative">
                <span class="absolute left-0 top-1/2 transform -translate-y-1/2 h-full w-10 bg-[#00c5d9] text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/></svg>
                </span>
                <input
                    wire:model="phone"
                    type="tel"
                    placeholder="Phone"
                    class="w-full p-3 pl-12 rounded-r-lg bg-gray-100 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                    
                >
            </div>
            @error('phone') <span class="error text-red-500" >{{ $message }}</span> @enderror
        </div>




        
        <flux:button type="submit" class="cursor-pointer w-full bg-[#00c5d9] hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200" variant="primary">
            Login
        </flux:button>

    </form>

</div>
