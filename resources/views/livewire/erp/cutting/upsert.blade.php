<div>
    <x-slot name="header">Cutting Note</x-slot>

    <x-forms.m-panel>

        <div class="grid gap-4 sm:grid-cols-4">

            <div class="flex flex-col col-span-2 gap-1">
                <label for="order_id" class="gray-label">Order&nbsp;No</label>
                @livewire('controls.lookup.erp.order-lookup',[$order_id,'purple-textbox'])
                <label for="style_ref" class="gray-label">Style Ref</label>
                <input type="text" wire:model="style_ref" id="style_ref"
                       class="w-full purple-textbox"
                       placeholder="Style Reference"/>

            </div>
            <div class="flex flex-col col-span-2 gap-1">
                <x-input.text-new wire:model="cutting_date" :name="'cutting_date'"/>

                <label for="cutting_date" class="gray-label">Date</label>
                <input type="date" wire:model="cutting_date" id="cutting_date"
                       class="w-full purple-textbox"
                       placeholder="Date"/>

                <label for="style_ref" class="gray-label">Style Ref</label>
                <input type="text" wire:model="style_ref" id="style_ref"
                       class="w-full purple-textbox"
                       placeholder="Style Reference"/>

            </div>

        </div>

        <!--  Add items ----------------------------------------------------------------------------------------- -->
        <div class="mt-5 ">
            <span class="px-6 text-lg font-extrabold"> Add Items</span>
            <table class="w-full mt-3 border border-blue-600">
                <tr class="border border-gray-400">
                    <!--  Items ----------------------------------------------------------------------------------------- -->

                    <td class="border border-gray-300">
                        @livewire('controls.lookup.common.colour-lookup',['','purple-textbox-no-rounded'])
                    </td>

                    <td class="border border-gray-300">
                        @livewire('controls.lookup.common.size-lookup',['','purple-textbox-no-rounded'])
                    </td>

                    <!--  items ----------------------------------------------------------------------------------------- -->

                    <td class="border border-gray-300 ">

                        <label>
                            <input wire:model="dc_no" type="text" placeholder="Cutting Qty"
                                   class="purple-textbox-no-rounded w-full"/>
                        </label>
                    </td>

                    <!--  Add button ----------------------------------------------------------------------------------------- -->
                    <td class="w-16 text-center border border-gray-300">
                        <button wire:click="addItems"
                                class="w-full h-10 font-bold text-white bg-green-500 text-md">add
                        </button>
                    </td>
                </tr>
            </table>
        </div>


        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('vname')">Order No</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Cutting Date</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Cutting Master</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Cutting Qty</x-table.ths>
            </x-slot>
            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <a href="{{route('cuttings.upsert',[$row->id])}}"
                               class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $index + 1 }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('cuttings.upsert',[$row->id])}}"
                               class="flex flex-col px-3">
                                <div class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->order->vname }}
                                </div>
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('cuttings.upsert',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->cutting_date }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('cuttings.upsert',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->cutting_master }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('cuttings.upsert',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->cutting_qty }}
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
    </x-forms.m-panel>
</div>
