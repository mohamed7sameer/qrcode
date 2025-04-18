<?php

use App\Models\User;
use App\Models\Qrcode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Validation\ValidationException;


new
#[Layout('components.layouts.auth')]
class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';

    

    public function mount(): void
    {

    }



    



    public function register(): void
    {


        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'string', 'lowercase', 'max:255'],
        ]);

        if(User::where('phone', $validated['phone'])->exists())
        {
            $user = User::where('phone', $validated['phone'])->first();
            Auth::login($user,true);
        }else{
            $user = User::create($validated);
            Auth::login($user,true);
        }


       

        

        


        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Phone -->
        <flux:input
            wire:model="phone"
            :label="__(key: 'Phone address')"
            type="text"
            required
            autocomplete="phone"
            placeholder="0XXXXXXXXXX"
        />
        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Add Point') }}
            </flux:button>
        </div>
    </form>
</div>
