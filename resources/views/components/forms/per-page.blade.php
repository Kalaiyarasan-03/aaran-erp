<x-input.group borderless paddingless for="perPage" label="Per Page">
    <label for="perPage">&nbsp;</label>
    <select wire:model="perPage" wire:change.debounce="reRender" id="perPage" class="w-20 purple-textbox" >
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</x-input.group>
