<div>
    <x-slot name="header">Order Details</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-forms.table :list="$list">

            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('vname')">Order No</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Description</x-table.ths>
                <x-table.heading class="w-[12rem]">Action</x-table.heading>
            </x-slot>

            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <a href="{{route('orders.style',[$row->id])}}"
                               class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $index + 1 }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                        <a href="{{route('orders.style',[$row->id])}}"
                           class="flex flex-col px-3">
                            <div class="text-gray-600 truncate text-xl text-left">
                                {{ $row->vname }}
                            </div>
                        </a>
                        </x-table.cell>


                        <x-table.cell>
                            <a href="{{route('orders.style',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->desc }}
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
            <x-input.model-text wire:model="vname" :label="'Order No'"/>
            <x-input.model-text wire:model="desc" :label="'Description'"/>
        </x-forms.create>

    </x-forms.m-panel>
</div>
