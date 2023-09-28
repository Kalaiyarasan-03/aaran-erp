@props([
'showFilters'=>false
])
<button wire:click="toggleShowFilters"
        class="w-3 pt-2">
    <x-aaranUi::icons.icon :icon="$showFilters ? 'cog':'adjustments'" class="h-6 w-auto block"/>
</button>
