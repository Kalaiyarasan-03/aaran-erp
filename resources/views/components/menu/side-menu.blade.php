<div x-show="sidebarOpen" x-transition.opacity.duration.600ms @click="sidebarOpen = false"
     class="fixed inset-0 bg-black bg-opacity-30 z-10"></div>
<nav x-cloak
     class="absolute inset-0 transform duration-500 z-30 w-80 bg-gray-900 text-white h-auto print:hidden"
     :class="{'translate-x-0 ease-in opacity-100':open === true, '-translate-x-full ease-out opacity-0': sidebarOpen === false}">
    <div class="flex justify-between px-5 py-6">
        <a href="{{route('dashboard')}}" class="flex gap-2">
{{--            <span class="p-1 rounded bg-white">--}}
{{--            <x-aaranUi::assets.logo.aaran class="h-7 w-auto block"/>--}}
{{--            </span>--}}
            <span class="font-bold text-2xl sm:text-3xl tracking-widest">Amal Tex</span>
        </a>

        <button
            class="focus:outline-none focus:bg-gray-700 hover:bg-gray-800 rounded-md text-gray-300"
            @click="sidebarOpen = false"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
    </div>

    <!-- menu overflow-y-scroll overflow-x-hidden flex-grow h-full-->
    <div class=" bg-gray-900 text-white h-full overflow-y-scroll">
        <ul class="flex flex-col py-6 space-y-1"
            x-data="{selected:null}">

            <x-menu.sub.erp/>
            <x-menu.sub.logout/>

        </ul>
    </div>
</nav>
