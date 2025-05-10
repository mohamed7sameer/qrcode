<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Illuminate\Http\UploadedFile;

use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

new
#[Layout('components.layouts.app2')]
class extends Component {
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $points = '';
    public  $age;
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
        $this->avatar = Auth::user()->avatar_url;
        $this->avatarURL = $this->avatar;
        $this->age = Auth::user()->age;
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
            'age' => ['required', 'numeric'],
            
        ],[
            
            'name.required' => __('validation.required', ['attribute' => 'الإسم']),
            'name.string' => __('validation.string', ['attribute' => 'الإسم']),
            'name.max' => __('validation.max.string', ['attribute' => 'الإسم', 'max' => 255]),
            'avatar.required' => __('validation.required', ['attribute' => 'الصورة']), // << أضفت الرسالة هنا
            'age.required' => __('validation.required', ['attribute' => 'العمر']),
            'age.numeric' => __('validation.numeric', ['attribute' => 'العمر']),

        ]
    );

        
        if ($this->avatar instanceof UploadedFile) {

            $validated['avatar'] = $this->avatar->store('avatars', 'public');
        }


        $user->update($validated);


        

        $this->dispatch('profile-updated', name: $user->name);
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





    <div class="px-6 py-4 bg-white rounded-xl mx-4 my-6 p-4 shadow-lg mb-2">

        @include('partials.settings-heading')
    <x-settings.layout >
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">

            <flux:input wire:model="points" :label="__('Points')"  readonly  />

            <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus autocomplete="name" />

            <flux:input wire:model="age" :label="__('Age')" type="text" required autofocus autocomplete="Age" />

            <flux:input wire:model="email" :label="__('Email')" type="email" readonly/>

            <flux:input wire:model="phone" :label="__('Phone')" readonly  />

            <div>
                <flux:input wire:model="avatar" :label="__('avatar')" type="file" name="avatar"   />
                <img src="{{ $avatarURL }}" alt="avatar" class="w-50 my-5  drop-shadow-xl drop-shadow-black" />
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>
            </div>
            <x-action-message class="me-3" on="profile-updated">
                <p class=" bg-green-600 text-white p-5" >__('saved')</p>
            </x-action-message>
        </form>

        
    </x-settings.layout>

    </div>



    
    
</section>
