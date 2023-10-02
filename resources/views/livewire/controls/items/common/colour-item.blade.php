<div>
    <div x-data="{isTyped: false}" @click.away="isTyped = false">
        <div class="relative">
            <label><input
                    type="search"
                    wire:model.live="colour_name"
                    autocomplete="off"
                    placeholder="Colour.."
                    @focus="isTyped = true"
                    @keydown.escape.window="isTyped = false"
                    @keydown.tab.window="isTyped = false"
                    @keydown.enter.prevent="isTyped = false"
                    wire:keydown.arrow-up="decrementColour"
                    wire:keydown.arrow-down="incrementColour"
                    wire:keydown.enter="selectColours"
                    class="block w-full purple-textbox-no-rounded"
                />
            </label>
            <div x-show="isTyped"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 x-cloak
            >
                <div class="absolute z-20 w-full mt-2">
                    <div class="block py-1 shadow-md w-full
                rounded-lg border-transparent flex-1 appearance-none border
                                 bg-white text-gray-800 ring-1 ring-purple-600">
                        <ul class="overflow-y-scroll h-96">
                            @forelse ($colours as $i => $colour)
                                <div wire:key="{{ $colour->id }}"></div>
                                <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                {{ $colourHighlight === $i ? 'bg-yellow-100' : '' }}"
                                    wire:click.prevent="setColour('{{$colour->vname}}','{{$colour->id}}')"
                                    x-on:click="isTyped = false">
                                    {{ $colour->vname }}
                                </li>
                            @empty
                                @livewire('controls.model.common.colour-model',[$colour_name])
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
