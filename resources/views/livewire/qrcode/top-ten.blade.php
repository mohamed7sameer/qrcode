<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;


new class extends Component {

    public $users;

    public function mount()
    {
        $this->users = User::orderBy('points','DESC')->take(value: 8)->get();
    }
    
    
}; ?>

<section>
    <div>
        <flux:heading size="xl" level="1">{{ __('Top 8 Users') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            {{ __('Here are the top 10 users with the highest coin earnings. Stay engaged and make your way to the top of the leaderboard!') }}
        </flux:subheading>
    
        <div class=" bg-white rounded-lg shadow-md overflow-hidden">
            <ul class="divide-y ">
    
                @if(count($users))
                    @foreach ($users as $key=>$user)
                        <li class="px-4 py-3 ">
                            <div class="flex items-center space-x-4">
                            <span class="text-gray-500">{{ $key+1 }}</span>
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" src="{{ $user->avatar_url }}" alt="User 1 Avatar">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium  truncate">
                                {{ $user->name }}
                                </p>
                            </div>
                            {{-- <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-800 text-white">
                                {{ $user->points }} Points
                                </span>
                            </div> --}}
                            </div>
                        </li>          
                    @endforeach
                @endif
              
    
              
            </ul>
          </div>
    </div>

    <div>

        <div class="mt-20 bg-white shadow rounded-lg px-5 pt-[60px] pb-5 relative">
            <div class="">
                <div class="flex items-center space-x-4">
                    <img class="w-16 h-16 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="User Avatar">
                    <div>
                      <h3 class="text-lg font-semibold ">{{ auth()->user()->name }}</h3>
                      <p class="mt-2  flex gap-1">
                          <flux:icon.inbox /> {{ auth()->user()->email }}
                      </p>
                      <p class="mt-2  flex gap-1">
                          <flux:icon.device-phone-mobile/> {{ auth()->user()->phone }}
                      </p>
                      <p class="mt-2  flex gap-1">
                          <flux:icon.calendar/> {{ auth()->user()->age }}
                      </p>
                    </div>
                  </div>
                  <div class="flex flex-col justify-center items-center absolute w-25 h-25 bg-white rounded-full drop-shadow-lg top-[0%] left-[50%]" 
                    style="transform: translate(-50%, -50%);"
                  >
                    <flux:icon.trophy class="size-12" /> 
                    <h1 class="font-bold text-lg">{{auth()->user()->points}}</h1>
                  </div>
                  
            </div>
            
          </div>
          {{-- hello  world--}}

    </div>
    
</section>