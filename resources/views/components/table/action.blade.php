@props([
'id'=>null
])
<x-table.cell>
    <div class="w-full flex justify-center gap-3">
        <x-button.link wire:click="edit({{ $id }})">&nbsp;

            <x-aaranUi::icons.icon :icon="'pencil'"
                                   class="text-blue-500 h-5 w-auto block"/>
        </x-button.link>

        <x-button.link wire:click="getDelete({{ $id }})">&nbsp;
            <x-aaranUi::icons.icon :icon="'trash'"
                                   class="text-red-600 h-5 w-auto block"/>
        </x-button.link>
    </div>
</x-table.cell>
