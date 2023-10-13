<div>
    <x-slot name="header">Printing & Emb Outward Note</x-slot>

    <x-forms.m-panel>

        <section class="grid grid-cols-2 gap-12">
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-2">

                    <label for="contact_name" class="gray-label">Party Name</label>

                    <div x-data="{isTyped: @entangle('showDropdown')}" @click.away="isTyped = false">
                        <div class="relative">
                            <input
                                id="contact_name"
                                type="search"
                                wire:model.live="contact_name"
                                autocomplete="off"
                                placeholder="Contact.."
                                @focus="isTyped = true"
                                @keydown.escape.window="isTyped = false"
                                @keydown.tab.window="isTyped = false"
                                @keydown.enter.prevent="isTyped = false"
                                wire:keydown.arrow-up="decrementHighlight"
                                wire:keydown.arrow-down="incrementHighlight"
                                wire:keydown.enter="selectObj"
                                class="block w-full purple-textbox"
                            />

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
                                            @if($list)
                                                @forelse ($contacts as $i => $contact)
                                                    <div wire:key="{{ $contact->id }}"></div>
                                                    <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                                        {{ $selectHighlight === $i ? 'bg-yellow-100' : '' }}"
                                                        wire:click.prevent="setObj('{{$contact->vname}}','{{$contact->id}}')"
                                                        x-on:click="isTyped = false">
                                                        {{ $contact->vname }}
                                                    </li>
                                                @empty
                                                    @livewire('controls.model.master.contact-model',[$contact_name])

                                                @endforelse
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex flex-col gap-2">
                    <label for="contact" class="gray-label">Job Card</label>
                    <input id="contact" class="purple-textbox">
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-2">
                    <label for="vno" class="gray-label">VC NO</label>
                    <input id="vno" wire:model="vno" class="purple-textbox">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="date" class="gray-label">Date</label>
                    <input date id="date" class="purple-textbox">
                </div>
            </div>
        </section>

        <section>
            Add Items
        </section>

        <section class="flex flex-row w-full">
            <label class="w-full">
                <input class="w-full border-gray-300" placeholder="Cutting Ref">
            </label>
            <label class="w-full">
                <input class="w-full border-gray-300 " placeholder="Colour">
            </label>
            <label class="w-full">
                <input class="w-full border-gray-300" placeholder="Size">
            </label>
            <label class="w-full">
                <input class="w-full border-gray-300" placeholder="Qty">
            </label>
            <button class="px-3 bg-green-500 text-white font-semibold tracking-wider ">Add</button>
        </section>

        <section>

            <div class="py-2 mt-5">

                <table class="w-full">
                    <thead>
                    <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                        <th class="w-12 px-2 text-center border border-gray-300">#</th>
                        <th class="px-2 text-center border border-gray-300">LOT</th>
                        <th class="px-2 text-center border border-gray-300">COLOUR</th>
                        <th class="px-2 text-center border border-gray-300">SIZE</th>
                        <th class="px-2 text-center border border-gray-300">QTY</th>
                        <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                    </tr>

                    </thead>

                    <tbody>

                    {{--                    @foreach($list as $index => $row)--}}
                    {{--                        <tr class="border border-gray-400">--}}
                    {{--                            <td class="text-center border border-gray-300 bg-gray-100">--}}
                    {{--                                <button class="w-full h-full cursor-pointer"--}}
                    {{--                                        wire:click.prevent="changeItems({{$index}})">--}}
                    {{--                                    {{$index+1}}--}}
                    {{--                                </button>--}}
                    {{--                            </td>--}}
                    {{--                            <td class="px-2 text-left border border-gray-300">{{$row['fabric_lot_name']}}</td>--}}
                    {{--                            <td class="px-2 text-center border border-gray-300">{{$row['colour_name']}}</td>--}}
                    {{--                            <td class="px-2 text-center border border-gray-300">{{$row['size_name']}}</td>--}}
                    {{--                            <td class="px-2 text-center border border-gray-300">{{floatval($row['qty'])}}</td>--}}
                    {{--                            <td class="text-center border border-gray-300">--}}
                    {{--                                <button wire:click.prevent="removeItems({{$index}})"--}}
                    {{--                                        class="py-1.5 w-full text-red-500 items-center ">--}}
                    {{--                                    <x-aaranUi::icons.icon icon="trash" class="block w-auto h-6"/>--}}
                    {{--                                </button>--}}
                    {{--                            </td>--}}
                    {{--                        </tr>--}}
                    {{--                        @php--}}
                    {{--                            $total_qty += $row['qty']+0--}}
                    {{--                        @endphp--}}

                    {{--                    @endforeach--}}


                    </tbody>
                    <tfoot class="mt-2">
                    <tr class="h-8 text-sm border border-gray-400 bg-gray-50">
                        <td colspan="4" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                        <td class="px-2 text-center border border-gray-300">{{$total_qty}}</td>
                    </tr>
                    </tfoot>

                </table>

            </div>
        </section>
    </x-forms.m-panel>

    <section>
        <div class="px-8 py-6 gap-4 bg-gray-100 rounded-b-md shadow-lg w-full ">
            <div class="flex flex-col md:flex-row justify-between gap-3">
                <div class="flex gap-3">
                    <x-button.save/>
                    <x-button.back/>
                </div>
                <div>
                    <x-button.print/>
                </div>
                <div>
                    <x-button.delete/>
                </div>
            </div>
        </div>
    </section>

</div>
