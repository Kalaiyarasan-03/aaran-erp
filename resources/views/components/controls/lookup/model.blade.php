@props([
    'showModel' =>false,
    'width' => 'w-1/3'
])
<div>
    <button wire:click="$set('showModel',true); "
            class="bg-green-500 w-full h-8 text-white">
        Not found , Want to create new
    </button>

    @if($showModel)
        <div x-data x-init="$refs.vname.focus()">

            <div wire:click="clearAll"
                 class="fixed inset-0 bg-gray-900 bg-opacity-90 cursor-pointer"></div>

            <div
                class="bg-white shadow-md m-auto rounded-md fixed inset-0 inline-block h-80 overflow-y-auto {{$width}}">

                <div class="flex flex-col h-full justify-between">

                    <header class="p-2">
                        <h3 class="font-bold text-lg border-b border-gray-400 text-gray-500">
                            Create new
                        </h3>
                    </header>

                    <main class="px-5 mb-2">
                        {{$slot}}
                    </main>

                    <footer class="flex justify-end px-2 py-4 mt-3 bg-gray-200 rounded-b-md gap-3">

                        <button
                            wire:click="clearAll"
                            class='w-36 bg-blue-600 hover:bg-blue-500  border-b-4 border-blue-700 hover:border-blue-700
                                   focus:outline-none text-white  uppercase font-bold shadow-md rounded-lg p-1'>
                            <div class="flex gap-3 justify-center">
                                <x-aaranUi::icons.icon icon="chevrons-left" class="h-4 w-auto block"/>
                                <div class="pt-1.0">Back</div>
                            </div>
                        </button>

                        <button wire:click="save"
                                class='w-36 bg-green-600 hover:bg-green-500  border-b-4 border-green-700 hover:border-green-700
                                    focus:outline-none text-white  uppercase font-bold shadow-md rounded-lg p-1'>
                            <div class="flex gap-3  justify-center">
                                <x-aaranUi::icons.icon icon="save" class="h-4 w-auto block"/>
                                <div class="pt-1.0">
                                    SAVE
                                </div>
                            </div>
                        </button>
                    </footer>
                </div>
            </div>
        </div>
    @endif
</div>
