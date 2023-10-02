<div>
    <x-controls.lookup.base :placeholder="'Color'" :class="$class">
        @if(!empty($list))
            @forelse ($list as $i=> $row)
                <div wire:key="{{ $row->id }}"></div>
                <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                {{ $highlightIndex === $i ? 'bg-yellow-100' : '' }}"
                    wire:click.prevent="setColour('{{$row->vname}}','{{$row->id}}')"
                    x-on:click="isTyped = false">
                    {{ $row->vname }}
                </li>
            @empty
                @livewire('controls.model.common.colour-model',[$searches])
            @endforelse
        @endif
    </x-controls.lookup.base>
</div>
