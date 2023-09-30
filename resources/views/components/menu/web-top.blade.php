<nav class="px-2 sm:px-4 py-2.5 bg-white sticky inset-0 z-10 border-b-2 border-gray-200">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{route('home')}}" class="flex items-center">
            <div class="bg-white p-1 rounded py-2">
                <x-aaranUi::assets.logo.cxlogo :icon="'light'"  class="h-7 w-auto block"/>
            </div>
            <span
                class="self-center text-2xl font-semibold whitespace-nowrap px-2 tracking-wider">CODEXSUN</span>
        </a>

        <div class="flex items-center">
            <div class="top-0 right-0 mr-8">
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{route('dashboard')}}" role="button"
                               class="font-semibold text-xl hover:text-white hover:bg-green-600  px-3 py-1 rounded-xl focus:outline-none focus:underline  transition ease-in-out duration-150">
                                Dashboard
                            </a>

                            <a
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="font-semibold text-xl hover:text-white hover:bg-red-600 px-3 py-1 rounded-xl
                                 focus:outline-none focus:underline transition ease-in-out duration-150"
                            >
                                Log out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>

                        @else
                            <a href="{{ route('login') }}"
                               class="font-semibold text-xl hover:text-white hover:bg-blue-600 px-3 py-1 rounded-xl
                                   focus:outline-none focus:underline transition ease-in-out duration-150">
                                Log in
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
