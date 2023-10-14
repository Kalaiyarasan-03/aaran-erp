@props([
'showFilters'=>false
])

<div class="flex justify-between pb-5">
    <div class="w-2/4 flex space-x-2">

        <x-input.search-box/>
        <x-input.toggle-filter :show-filters="$showFilters"/>

    </div>

    <div class="space-x-2 flex items-center">
        <x-forms.per-page/>
        <x-button.new/>
    </div>
</div>

<x-input.advance-search :show-filters="$showFilters" />
