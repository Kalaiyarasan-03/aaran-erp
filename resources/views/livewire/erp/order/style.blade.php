<div>
    <x-slot name="header">Details</x-slot>

    <x-forms.m-panel>


        <div class="font-semibold text-3xl mb-2">
            {{$order->vname}}
        </div>

        <x-forms.table>
            <x-slot name="table_header">
                <x-table.ths wire:click.prevent="sortBy('vname')">Sl.No</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Style</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Job No</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Date</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Total Qty</x-table.ths>
            </x-slot>
            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <a href="{{route('peoutwards.upsert',[$row->id])}}"
                               class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $index+1 }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('peoutwards.upsert',[$row->id])}}"
                               class="flex flex-col px-3">
                                <div class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->style_name }}
                                </div>
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('peoutwards.upsert',[$row->id])}}"
                               class="flex flex-col px-3">
                                <div class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->vno }}
                                </div>
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('peoutwards.upsert',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{date('d-m-Y', strtotime($row->vdate))}}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('peoutwards.upsert',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-right">
                                {{ $row->total_qty }}
                            </a>
                        </x-table.cell>

                    </x-table.row>
                @empty
                    <x-table.empty/>
                @endforelse
            </x-slot>
        </x-forms.table>
    </x-forms.m-panel>
</div>
