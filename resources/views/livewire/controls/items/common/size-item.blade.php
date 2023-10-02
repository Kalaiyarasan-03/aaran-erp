<div>
    <div x-data="{isTyped: false}" @click.away="isTyped = false">
        <div class="relative">
            <label><input
                    type="search"
                    wire:model.live="searches"
                    autocomplete="off"
                    placeholder="Size.."
                    @focus="isTyped = true"
                    @keydown.escape.window="isTyped = false"
                    @keydown.tab.window="isTyped = false"
                    @keydown.enter.prevent="isTyped = false"
                    wire:keydown.arrow-up="decrementHighlight"
                    wire:keydown.arrow-down="incrementHighlight"
                    wire:keydown.enter="selectObj"
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
                            @forelse ($list as $i => $row)
                                <div wire:key="{{ $row->id }}"></div>
                                <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                {{ $selectHighlight === $i ? 'bg-yellow-100' : '' }}"
                                    wire:click.prevent="setObj('{{$row->vname}}','{{$row->id}}')"
                                    x-on:click="isTyped = false">
                                    {{ $row->vname }}
                                </li>
                            @empty
                                @livewire('controls.model.common.size-model',[$searches])
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
