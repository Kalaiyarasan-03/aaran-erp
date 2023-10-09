<div>
    <div x-data="{isTyped: false}" @click.away="isTyped = false">
        <div class="relative">
            <label><input
                    type="search"
                    wire:model.live="searches"
                    autocomplete="off"
                    placeholder="Job No.."
                    @focus="isTyped = true"
                    @keydown.escape.window="isTyped = false"
                    @keydown.tab.window="isTyped = false"
                    @keydown.enter.prevent="isTyped = false"
                    wire:keydown.arrow-up="decrementHighlight"
                    wire:keydown.arrow-down="incrementHighlight"
                    wire:keydown.enter="selectObj"
                    class="block w-full purple-textbox-no-rounded"
                />
            </label>
            <div x-show="isTyped"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 x-cloak
            >
                <div class="absolute z-20 w-full">
                    <div class="block shadow-md w-full
                rounded-lg border-transparent flex-1 appearance-none border
                                 bg-white text-gray-800 ring-1 ring-purple-600">

                        <!--  table ----------------------------------------------------------------------------------------- -->
                        <div class="overflow-y-scroll h-96">

                            <table class="w-full">
                                <thead>
                                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                                    <th class="px-2 text-center border border-gray-300">COLOUR</th>
                                    <th class="px-2 text-center border border-gray-300">SIZE</th>
                                    <th class="px-2 text-center border border-gray-300">QTY</th>
                                </tr>

                                </thead>

                                <tbody>
                                @if($list)
                                    @forelse ($list as $i => $row)

                                        <tr class="border border-gray-400 hover:bg-blue-300 cursor-pointer">
                                            <td class="px-2 text-left border border-gray-300 "
                                                wire:click="sendItem(
                                                '{{$row['colour_name']}}','{{$row['colour_id']}}',
                                                '{{$row['size_name']}}','{{$row['size_id']}}',
                                                '{{$row['qty']}}'
                                                )"
                                                x-on:click="isTyped = false"
                                            >

                                                {{$row['colour_name']}}

                                            </td>

                                            <td class="px-2 text-left border border-gray-300"
                                                wire:click="sendItem(
                                                '{{$row['colour_name']}}','{{$row['colour_id']}}',
                                                '{{$row['size_name']}}','{{$row['size_id']}}',
                                                '{{$row['qty']}}'
                                                )"
                                                x-on:click="isTyped = false"
                                            >

                                                {{$row['size_name']}}
                                            </td>

                                            <td class="px-2 text-left border border-gray-300"
                                                wire:click="sendItem(
                                                '{{$row['colour_name']}}','{{$row['colour_id']}}',
                                                '{{$row['size_name']}}','{{$row['size_id']}}',
                                                '{{$row['qty']}}'
                                                )"
                                                x-on:click="isTyped = false"
                                            >
                                                {{floatval($row['qty'])}}
                                            </td>

                                        </tr>
                                    @empty
                                        no record
                                    @endforelse
                                @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
