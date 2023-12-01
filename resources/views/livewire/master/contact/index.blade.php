<div>
    <x-slot name="header">Contacts</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Contact Name</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Mobile</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Whatsapp</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Email</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Gst</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Contact Type</x-table.ths-center>
            </x-slot>

            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-center">
                                {{ $index + 1 }}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->vname}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-center">
                                {{ $row->mobile}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-center">
                                {{ $row->whatsapp}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->email}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->gstin}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-center">
                                {{App\Enums\ContactType::tryFrom($row->contact_type)->getName()}}
                            </p>
                        </x-table.cell>

                        <x-table.action :id="$row->id"/>
                    </x-table.row>
                @empty
                    <x-table.empty/>
                @endforelse
            </x-slot>
            <x-slot name="table_pagination">
                {{ $list->links() }}
            </x-slot>
        </x-forms.table>

        <x-modal.delete/>

        <x-forms.create :id="$vid">
            <x-input.model-text wire:model="vname" :label="'Name'"/>
            <x-input.model-text wire:model="mobile" :label="'Mobile'"/>
            <x-input.model-text wire:model="whatsapp" :label="'Whatsapp'"/>
            <x-input.model-text wire:model="email" :label="'Email'"/>
            <x-input.model-text wire:model="gstin" :label="'GSTin'"/>
            <x-input.model-text wire:model="address_1" :label="'Address'"/>
            <x-input.model-text wire:model="address_2" :label="'Area-Road'"/>

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

            <x-input.model-select wire:model="contact_type" :label="'Contact Type'">
                <option class="text-gray-400"> choose ..</option>
                @foreach(\App\Enums\ContactType::cases() as $contact_type)
                    <option value="{{$contact_type->value}}">{{$contact_type->getName()}}</option>
                @endforeach
            </x-input.model-select>
        </x-forms.create>

    </x-forms.m-panel>
</div>
