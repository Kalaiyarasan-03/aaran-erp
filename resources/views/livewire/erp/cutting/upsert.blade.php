<div>
    <x-slot name="header">Cutting Note</x-slot>

    <x-forms.m-panel>

        <div class="grid gap-4 sm:grid-cols-4">

            <div class="flex flex-col col-span-2 gap-2">
                @livewire('controls.lookup.erp.order-lookup',[$order_id,'purple-textbox mt-2','Order No'])


            </div>
            <div class="flex flex-col col-span-2 gap-2">
                <x-input.text-new wire:model="cutting_date" :name="'cutting_date'" :type="'date'" :label="'Date'"/>
                <x-input.text-new wire:model="cutting_master" :name="'cutting_master'" :label="'Cutting Master'"/>
            </div>
        </div>

        <div class="flex gap-2">
            <div>
                order id :{{$order_id}}
            </div>
            <div>
                colour id :{{$colour_id}}
            </div>
            <div>
                size id :{{$size_id}}
            </div>
        </div>
        <!--  Add items ----------------------------------------------------------------------------------------- -->
        <div class="mt-5 ">
            <span class="px-6 text-lg font-extrabold"> Add Items</span>
            <table class="w-full mt-3 border border-blue-600">
                <tr class="border border-gray-400">
                    <!--  Items ----------------------------------------------------------------------------------------- -->

                    <td class="border border-gray-300">
                        <div x-data="{isTyped: false}" @click.away="isTyped = false">
                            <div class="relative">
                                <label><input
                                        type="search"
                                        wire:model.live="colour_name"
                                        autocomplete="off"
                                        placeholder="Colour.."
                                        @focus="isTyped = true"
                                        @keydown.escape.window="isTyped = false"
                                        @keydown.tab.window="isTyped = false"
                                        @keydown.enter.prevent="isTyped = false"
                                        wire:keydown.arrow-up="decrementColour"
                                        wire:keydown.arrow-down="incrementColour"
                                        wire:keydown.enter="selectColours"
                                        class="block w-full purple-textbox-no-rounded"
                                    />
                                </label>
                                <div x-show="isTyped"
                                     x-transition:leave="transition ease-in duration-100"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     x-cloak
                                >
                                    <div class="absolute z-20 w-full mt-2">
                                        <div class="block py-1 shadow-md w-full
                rounded-lg border-transparent flex-1 appearance-none border
                                 bg-white text-gray-800 ring-1 ring-purple-600">
                                            <ul class="overflow-y-scroll h-96">
                                                @forelse ($colours as $i => $colour)
                                                    <div wire:key="{{ $colour->id }}"></div>
                                                    <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                {{ $colourHighlight === $i ? 'bg-yellow-100' : '' }}"
                                                        wire:click.prevent="setColour('{{$colour->vname}}','{{$colour->id}}')"
                                                        x-on:click="isTyped = false">
                                                        {{ $colour->vname }}
                                                    </li>
                                                @empty
                                                    @livewire('controls.model.common.colour-model',[$colour_name])
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="border border-gray-300">
                        @livewire('controls.lookup.common.size-lookup',[$size_id,'purple-textbox-no-rounded'])
                    </td>

                    <!--  items ----------------------------------------------------------------------------------------- -->

                    <td class="border border-gray-300 ">

                        <label>
                            <input wire:model="qty" type="text" placeholder="Cutting Qty"
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

        <!--  table ----------------------------------------------------------------------------------------- -->
        <div class="py-2 mt-5">

            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">COLOUR</th>
                    <th class="px-2 text-center border border-gray-300">SIZE</th>
                    <th class="px-2 text-center border border-gray-300">QTY</th>
                    <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                </tr>

                </thead>

                <tbody>

                @foreach($list as $index => $row)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            <button class="w-full h-full cursor-pointer" wire:click.prevent="changeItems({{$index}})">
                                {{$index+1}}
                            </button>
                        </td>
                        <td class="px-2 text-left border border-gray-300">{{$row['colour_name']}}</td>
                        <td class="px-2 text-left border border-gray-300">{{$row['size_name']}}</td>
                        <td class="px-2 text-center border border-gray-300">{{floatval($row['qty'])}}</td>
                        <td class="text-center border border-gray-300">
                            <button wire:click.prevent="removeItems({{$index}})"
                                    class="py-1.5 w-full text-red-500 items-center ">
                                <x-aaranUi::icons.icon icon="trash" class="block w-auto h-6"/>
                            </button>
                        </td>
                    </tr>
                @endforeach


                </tbody>
                <tfoot class="mt-2">
                <tr class="h-8 text-sm border border-gray-400 bg-gray-50">
                    <td colspan="2" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                    <td class="px-2 text-center border border-gray-300">{{$cutting_qty}}</td>
                    <td class="px-2 text-center border border-gray-300">&nbsp;</td>
                </tr>
                </tfoot>

            </table>

        </div>
        <!--  end of table ----------------------------------------------------------------------------------------- -->


    </x-forms.m-panel>
</div>
