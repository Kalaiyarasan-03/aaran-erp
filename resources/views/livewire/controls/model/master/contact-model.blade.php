<div>
    <x-controls.lookup.model :show-model="$showModel" >
        <x-input.lookup-text wire:model="vname"  x-ref="vname" :label="'Contact Name'" :name="'vname'"/>
        <x-input.lookup-text wire:model="contact_person" :label="'Contact Person'" :name="'contact_person'"/>
        <x-input.lookup-text wire:model="mobile" :label="'Mobile'" :name="'mobile'"/>
        <x-input.lookup-text wire:model="whatsapp" :label="'Whatsapp'" :name="'whatsapp'"/>
        <x-input.lookup-text wire:model="landline" :label="'Landline'" :name="'landline'"/>
        <x-input.lookup-text wire:model="gstin" :label="'GSTin'" :name="'gstin'"/>
        <x-input.lookup-text wire:model="pan" :label="'Pan'" :name="'pan'"/>
        <x-input.lookup-text wire:model="email" :label="'Email'" :name="'email'"/>
        <x-input.lookup-text wire:model="website" :label="'Website'" :name="'website'"/>
        <x-input.lookup-text wire:model="address_1" :label="'Street'" :name="'address_street'"/>
        <x-input.lookup-text wire:model="address_2" :label="'Area'" :name="'address_area'"/>
        <x-input.lookup-text wire:model="city_id" :label="'City'" :name="'city_id'"/>
        <x-input.lookup-text wire:model="state_id" :label="'State'" :name="'state_id'"/>
        <x-input.lookup-text wire:model="pincode_id" :label="'Pincode'" :name="'pincode_id'"/>
    </x-controls.lookup.model>
</div>
