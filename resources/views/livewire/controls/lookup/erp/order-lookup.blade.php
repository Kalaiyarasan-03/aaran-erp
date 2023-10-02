<div>
    <x-controls.lookup.base :placeholder="'Order no'" :class="$class" :label="$label" >
        @if(!empty($list))
            @forelse ($list as $i=> $row)
                <div wire:key="{{ $row->id }}"></div>
                <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                {{ $highlightIndex === $i ? 'bg-yellow-100' : '' }}"
                    wire:click.prevent="setOrder('{{$row->vname}}','{{$row->id}}')"
                    x-on:click="isTyped = false">
                    {{ $row->vname }}
                </li>
            @empty
                @livewire('controls.model.erp.order-model',[$searches])
            @endforelse
        @endif
    </x-controls.lookup.base>
</div>
