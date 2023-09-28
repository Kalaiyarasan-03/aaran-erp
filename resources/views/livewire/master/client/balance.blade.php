<div>
    <x-slot name="header">Balance</x-slot>

    <x-forms.m-panel>

        <div class="py-5 flex justify-center">
            <label>
                <input wire:model="cdate"  wire:change="reRender"  type="date" class="purple-textbox w-[12rem]"/>
            </label>
        </div>

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('vname')">Company Name</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Balance</x-table.ths>
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
                                    {{ $row->clientBank->vname }}
                                </div>
                            </a>

                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('clients.show',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->balance }}
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

            <x-input.model-select wire:model="client_bank_id" :label="'client'">
                <option class="text-gray-400"> choose ..</option>
                @foreach($clients as $row)
                    <option value="{{$row->id}}">{{$row->vname}}</option>
                @endforeach
            </x-input.model-select>

            <x-input.model-text type="date" wire:model="cdate" :label="'Date'"/>

            <x-input.model-text wire:model="balance" :label="'Balance'"/>

        </x-forms.create>


        <div class="space-x-2 flex items-center justify-end w-full ">
            <x-button.secondary wire:click="generate">
                Generate
            </x-button.secondary>
        </div>

    </x-forms.m-panel>
</div>
