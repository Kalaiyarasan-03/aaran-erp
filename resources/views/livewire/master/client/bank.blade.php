<div>
    <x-slot name="header">Bank</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('vname')">Company Name</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Bank</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Acno</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">IFSC</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Active</x-table.ths>
            </x-slot>
            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $index + 1 }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex flex-col px-3">
                                <div class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->vname }}
                                </div>
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->bank }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->acno }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->ifsc }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex px-3 text-xl text-left {{$row->active_id == '1' ? 'text-green-400' : 'text-red-400'}} ">
                                {{$row->active_id == '1' ? 'Active' : 'Not Active'}}
                            </a>
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

            <x-input.model-select wire:model="client_id" :label="'client'">
                <option class="text-gray-400"> choose ..</option>
                @foreach($clients as $row)
                    <option value="{{$row->id}}">{{$row->vname}}</option>
                @endforeach
            </x-input.model-select>
            <x-input.model-text wire:model="vname" :label="'company'"/>
            <x-input.model-text wire:model="acno" :label="'Ac No'"/>
            <x-input.model-text wire:model="ifsc" :label="'IFSC Code'"/>
            <x-input.model-text wire:model="bank" :label="'Bank'"/>
            <x-input.model-text wire:model="branch" :label="'Branch'"/>
            <x-input.model-text wire:model="customer_id" :label="'Customer Id'"/>
            <x-input.model-text wire:model="customer_id2" :label="'User Id'"/>
            <x-input.model-text wire:model="pks" :label="'Pks'"/>
            <x-input.model-text wire:model="trs" :label="'Trs'"/>
            <x-input.model-text wire:model="profileps" :label="'Profile'"/>
            <x-input.model-text wire:model="mobile" :label="'Mobile'"/>
            <x-input.model-text wire:model="email" :label="'Email'"/>
            <x-input.model-text wire:model="dvcatm" :label="'dvcatm'"/>
        </x-forms.create>

    </x-forms.m-panel>
</div>
