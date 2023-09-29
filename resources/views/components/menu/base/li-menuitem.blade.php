@props(['routes','label'])

<li class="bg-gray-900 mt-0.5 ">
    <a href="{{ route($routes) }}"
       class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-700
                                   text-gray-500 hover:text-gray-200 border-l-4 border-transparent hover:border-green-500 pr-6 pl-6">
        <x-aaranUi::icons.menu icon="cube"/>
        <x-menu.link>{{\Livewire\str($label)->ucfirst()}}</x-menu.link>
    </a>
</li>
