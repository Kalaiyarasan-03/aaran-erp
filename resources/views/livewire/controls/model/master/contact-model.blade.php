<div>
    <x-controls.lookup.model :show-model="$showModel" :width="'w-1/2'" >
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

        <x-input.model-select wire:model="city_id" :label="'City'">
            <option class="text-gray-400"> choose ..</option>
            @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->vname}}</option>
            @endforeach
        </x-input.model-select>

        <x-input.model-select wire:model="state_id" :label="'State'">
            <option class="text-gray-400"> choose ..</option>
            @foreach($states as $state)
                <option value="{{$state->id}}">{{$state->vname}}</option>
            @endforeach
        </x-input.model-select>

        <x-input.model-select wire:model="pincode_id" :label="'Pincode'">
            <option class="text-gray-400"> choose ..</option>
            @foreach($pincodes as $pincode)
                <option value="{{$pincode->id}}">{{$pincode->vname}}</option>
            @endforeach
        </x-input.model-select>

    </x-controls.lookup.model>
</div>
