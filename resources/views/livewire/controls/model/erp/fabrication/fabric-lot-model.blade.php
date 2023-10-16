<div>
    <x-controls.lookup.model :show-model="$showModel" >
        <x-input.lookup-text wire:model="vname"  x-ref="vname" :label="'Lot No'" :name="'vname'"/>
        <x-input.lookup-text wire:model="desc" :label="'Description'" :name="'desc'"/>
    </x-controls.lookup.model>
</div>
