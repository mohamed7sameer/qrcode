<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" >
    <head>
        @include('partials.head')

        <Style>

            

            [data-flux-main] {
                margin: 0 !important;
                padding: 0 !important;
                
            }
        </Style>
=
    </head>
    <body   style="background:url('{{ asset('assets/images/bg.webp') }}') center; background-size: cover; display: block;" class="rubik-400  min-h-screen ">
        





        <flux:sidebar sticky stashable class="border-e border-red-800 bg-[#A22929] dark ">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="/" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
                {{-- RAWANNIVERSARY --}}
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="trophy" :href="route('home')" :current="request()->routeIs('home')" wire:navigate>{{ __('Top Users') }}</flux:navlist.item>
                    <flux:navlist.item icon="adjustments-horizontal" :href="route('q.setting')" :current="request()->routeIs('q.setting')" wire:navigate>{{ __('Setting') }}</flux:navlist.item>
                </flux:navlist.group>
                
            </flux:navlist>

            <flux:spacer />



        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()?->user()?->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()?->user()?->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()?->user()?->name }}</span>
                                    <span class="truncate text-xs">{{ auth()?->user()?->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    





                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>






                    

                </flux:menu>
            </flux:dropdown>
        </flux:header>









    <flux:main>



        <div class="mt-5 mb-2 w-70 mx-w-full m-auto">
            <img src="{{ asset('assets/images/top-2.png') }}" class="w-full">
        </div>
        <p class="text-lg text-bold text-center text-white mb-5">8 YEARS ANNIVERSARY</p>


    



        <div class="px-5">
            {{ $slot }}
        </div>





        <div class="pt-10 pb-5">
            <img src="{{ asset('assets/images/bottom2.png') }}" class="w-full mb-5">
        </div>

        <div class="bg-[#ffdddd] flex justify-center items-center gap-2 py-2" >
            <a href="#"><img class="w-[30px]"  src="{{ asset('assets/images/call/telephone.svg') }}" alt=""></a>
            <a href="#"><img class="w-[30px]"  src="{{ asset('assets/images/call/linkedin.svg') }}" alt=""></a>
            <a href="#"><img class="w-[30px]"  src="{{ asset('assets/images/call/facebook.svg') }}" alt=""></a>
            <a href="#"><img class="w-[30px]"  src="{{ asset('assets/images/call/instagram.svg') }}" alt=""></a>
            
        </div>

        <div class="pt-10 pb-5 w-50 m-auto max-w-full ">
            <img src="{{ asset('assets/images/prisma2.png') }}" class="w-full ">
        </div>


        



    </flux:main>






        






        @fluxScripts
    </body>
</html>








