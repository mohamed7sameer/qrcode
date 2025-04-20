<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Illuminate\Http\UploadedFile;

use Livewire\WithFileUploads;


new class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $points = '';
    public  $avatarURL;
    public  $avatar;

    use WithFileUploads;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone =  Auth::user()->phone;
        $this->points =  Auth::user()->points;
        $this->avatar = Auth::user()->avatar;
        $this->avatarURL = $this->avatar;
    }   


    public function updatedAvatar($value)
    {
        $this->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        $this->avatarURL = $value->temporaryUrl();

    }
    

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'avatar' => ['required'],
            // 'email' => [
            //     'required',
            //     'string',
            //     'lowercase',
            //     'email',
            //     'max:255',
            // ],
        ]);

        // $user->fill($validated);

        // if ($user->isDirty('email')) {
        //     $user->email_verified_at = null;
        // }

        
        if ($this->avatar instanceof UploadedFile) {

            $validated['avatar'] = $this->avatar->store('avatars', 'public');
        }


        $user->update($validated);


        // $user->save();

        // $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')
    <style>
        /* body{
            background: url('{{ asset('assets/bg.png') }}') center center;
        } */
    </style>
    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">

            <flux:input wire:model="points" :label="__('Points')"  readonly  />

            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <div>
                {{-- <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" /> --}}
                <flux:input wire:model="email" :label="__('Email')" type="email" readonly/>

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <flux:input wire:model="phone" :label="__('Phone')" readonly  />

            <div>
                <flux:input wire:model="avatar" :label="__('avatar')" type="file" name="avatar"   />
                <img src="{{ $avatarURL }}" alt="avatar" class="w-50" />
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        
    </x-settings.layout>
</section>
