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
    
        <div class="bg-zinc-900 bg-opacity-50 rounded-lg shadow-md overflow-hidden">
            <ul class="divide-y divide-gray-800">
    
                @if(count($users))
                    @foreach ($users as $key=>$user)
                        <li class="px-4 py-3 hover:bg-gray-800 transition duration-150 ease-in-out">
                            <div class="flex items-center space-x-4">
                            <span class="text-gray-500">{{ $key+1 }}</span>
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" src="{{ $user->avatar }}" alt="User 1 Avatar">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-white truncate">
                                {{ $user->name }}
                                </p>
                            </div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-800 text-white">
                                {{ $user->points }} Points
                                </span>
                            </div>
                            </div>
                        </li>          
                    @endforeach
                @endif
              
    
              
            </ul>
          </div>
    </div>

    <div>

        <div class="mt-10 bg-zinc-900 shadow rounded-lg p-6 ">
            <div class="flex justify-between">
                <div class="flex items-center space-x-4 flex-1">
                    <img class="w-16 h-16 rounded-full" src="{{ auth()->user()->avatar }}" alt="User Avatar">
                    <div>
                      <h3 class="text-lg font-semibold text-white dark:text-gray-100">{{ auth()->user()->name }}</h3>
                      <p class="mt-2 text-gray-400 dark:text-gray-500 flex gap-1">
                          <flux:icon.inbox /> {{ auth()->user()->email }}
                      </p>
                      <p class="mt-2 text-gray-400 dark:text-gray-500 flex gap-1">
                          <flux:icon.device-phone-mobile/> {{ auth()->user()->phone }}
                      </p>
                    </div>
                  </div>
                  <div class="flex flex-col justify-center items-center">
                    <flux:icon.trophy class="size-12" /> 
                    <h1>{{auth()->user()->points}}</h1>
                  </div>
            </div>
            
          </div>
          {{-- hello  world--}}

    </div>
    
</section>