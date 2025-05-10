<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new
#[Layout('components.layouts.app2')]
class extends Component {

    public $users;

    public function mount()
    {
        $this->users = User::orderBy('points','DESC')->take(value: 8)->get();
    }
    
    
}; ?>

<section>
    <div>
        <h1 class="text-white text-lg">{{ __('Top 8 Winners') }}</h1>
        <p class="text-white text-xs mb-5">HERE ARE THE TOP 8 USERS WITH THE HIGHEST NUMBER OF POINTS. KEEP COLLECTING AND MAKING YOUR WAY UP THE LEADERBOARD!</p>
    
        <div class=" ">
            <ul class="">
    
                @if(count($users))
                    @foreach ($users as $key=>$user)
                        <li class="px-4 py-2 bg-[#ededed] rounded-xl mb-1  overflow-hidden">
                            <div class="flex items-center space-x-4">
                            {{-- <span class="text-gray-500">{{ $key+1 }}</span> --}}
                            <div class="flex-shrink-0">
                                <img class="h-5 w-5 rounded-full" src="{{ $user->avatar_url }}" alt="User 1 Avatar">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium  truncate">
                                {{ $user->name }}
                                </p>
                            </div>
                            
                            </div>
                        </li>          
                    @endforeach
                @endif
              
    
              
            </ul>
          </div>
    </div>

    <div>

        <div class="mt-20 bg-[#ededed] shadow rounded-lg px-5 pt-[60px] pb-5 relative">
            <div class="">
                <div class="flex items-center flex-col space-x-4">
                    <img class="w-9 h-9 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="User Avatar">
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
                      <p class="mt-2  flex gap-1">
                          <flux:icon.trophy /> {{auth()->user()->points}}
                      </p>
                    </div>
                  </div>
                  <div class="flex flex-col justify-center items-center absolute w-25 h-25 bg-[#ededed] rounded-full drop-shadow-lg top-[0%] left-[50%]" 
                    style="transform: translate(-50%, -50%);"
                  >
                    {{-- <flux:icon.trophy class="size-12" />  --}}
                    <img src="{{ asset('assets/images/trophy.png') }}" class="w-20" alt="">
                    {{-- <h1 class="font-bold text-lg">{{auth()->user()->points}}</h1> --}}
                  </div>
                  
            </div>
            
          </div>
          {{-- hello  world--}}

    </div>
    
</section>