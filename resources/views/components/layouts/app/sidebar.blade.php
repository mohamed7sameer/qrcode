<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" >
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gray-200 rubik-400">
        





        <flux:sidebar sticky stashable class="border-e border-cyan-600 bg-cyan-700 dark ">
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









        {{ $slot }}






        






        @fluxScripts
    </body>
</html>
