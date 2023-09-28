<div>
    <x-slot name="header">Client</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('vname')">Company Name</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('username')">Active</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Payable</x-table.ths>
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
                                <div class="text-gray-500 truncate text-md text-left">
                                    &nbsp;&nbsp;&nbsp;-&nbsp;{{ $row->group }}
                                </div>
                            </a>

                        </x-table.cell>


                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex px-3 text-xl text-left {{$row->active_id == '1' ? 'text-green-400' : 'text-red-400'}} ">
                                {{$row->active_id == '1' ? 'Active' : 'Not Active'}}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->payable == 1 ? 'yes' : 'No' }}
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
            <x-input.model-text wire:model="vname" :label="'company'"/>
            <x-input.model-text wire:model="group" :label="'group'"/>
            <x-input.model-select wire:model="payable" :label="'payable'">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </x-input.model-select>
        </x-forms.create>

    </x-forms.m-panel>
</div>
