<header class="flex items-center px-4 py-3 text-semibold text-gray-800 bg-white border-b shadow-md print:hidden">

    <div class="w-full px-2 flex justify-between items-center">

        <div class="p-1 mr-4 "
             @click="sidebarOpen = !sidebarOpen">

            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': sidebarOpen, 'inline-flex': ! sidebarOpen }" class="inline-flex"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': ! sidebarOpen, 'inline-flex': sidebarOpen }" class="hidden"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>

        </div>

        <div class="w-full flex justify-between items-center">

            <!-- Page Heading -->
            <div class="font-semibold text-xl text-gray-800 leading-tight justify-start shrink-0 ">
                {{$slot}}
            </div>

            <div class="flex gap-3 w-full px-12">
                {{-- @livewire('controls.searchbars.topsearch')--}}
                {{-- @livewire('controls.searchbars.searchbar')--}}
                {{-- @livewire('controls.searchbars.filters')--}}

            </div>

            {{-- login menu--}}
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet.dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @auth
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             src="{{ Auth::user()->profile_photo_url }}"
                                             alt="{{ Auth::user()->name }}"/>
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </span>
                                @endif
                            @endauth
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet.dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet.dropdown-link>

{{--                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())--}}
{{--                                <x-jet.dropdown-link href="{{ route('api-tokens.index') }}">--}}
{{--                                    {{ __('API Tokens') }}--}}
{{--                                </x-jet.dropdown-link>--}}
{{--                            @endif--}}

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet.dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet.dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet.dropdown>
                </div>
            </div>

            {{-- login menu--}}

        </div>

    </div>
</header>
