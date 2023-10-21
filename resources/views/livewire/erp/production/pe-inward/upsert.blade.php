<div>
    <x-slot name="header">Printing & Emb Inward Note Details</x-slot>

    <x-forms.m-panel>

        <section class="grid grid-cols-2 gap-12">
            <div class="flex flex-col gap-3">


                <div class="flex flex-col gap-2">
                    <label for="contact_name" class="gray-label">Party Name</label>
                    <div x-data="{isTyped: @entangle('contactTyped')}" @click.away="isTyped = false">
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
                                wire:keydown.arrow-up="decrementContact"
                                wire:keydown.arrow-down="incrementContact"
                                wire:keydown.enter="enterContact"

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
                                            @if($contactCollection)
                                                @forelse ($contactCollection as $i => $contact)
                                                    <div wire:key="{{ $contact->id }}"></div>
                                                    <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                                        {{ $highlightContact === $i ? 'bg-yellow-100' : '' }}"
                                                        wire:click.prevent="setContact('{{$contact->vname}}','{{$contact->id}}')"
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
                    <label for="jobcard_no" class="gray-label">Job No</label>
                    <div x-data="{isTyped: @entangle('jobcardTyped')}" @click.away="isTyped = false">
                        <div class="relative">
                            <input
                                id="jobcard_no"
                                type="search"
                                wire:model.live="jobcard_no"
                                autocomplete="off"
                                placeholder="Job Card.."
                                @focus="isTyped = true"
                                @keydown.escape.window="isTyped = false"
                                @keydown.tab.window="isTyped = false"
                                @keydown.enter.prevent="isTyped = false"
                                wire:keydown.arrow-up="decrementJobcard"
                                wire:keydown.arrow-down="incrementJobcard"
                                wire:keydown.enter="enterJobcard"
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
                                            @if($jobcardCollection)
                                                @forelse ($jobcardCollection as $i => $jobcard)
                                                    <div wire:key="{{ $jobcard->id }}"></div>
                                                    <li class="cursor-pointer px-3 py-1 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                                        {{ $highlightJobcard === $i ? 'bg-yellow-100' : '' }}"
                                                        wire:click.prevent="setJobcard('{{$jobcard->vno}}','{{$jobcard->id}}')"
                                                        x-on:click="isTyped = false">
                                                        {{ $jobcard->vno }}
                                                        &nbsp;&nbsp;-&nbsp;&nbsp;{{ $jobcard->style->vname }}
                                                    </li>
                                                @empty
                                                    <a href="{{route('jobcards.upsert',['0'])}}" role="button"
                                                       class="flex items-center justify-center bg-green-500 w-full h-8 text-white text-center">
                                                        Not found , Want to create new
                                                    </a>
                                                @endforelse
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-2">
                    <label for="vno" class="gray-label">V.NO</label>
                    <input id="vno" wire:model="vno" class="purple-textbox">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="date" class="gray-label">Date</label>
                    <input id="date" wire:model="vdate" type="date" class="purple-textbox">
                </div>
            </div>
        </section>

        <section>
            Add Items
        </section>

        <section class="flex flex-row w-full">

            {{--cutting--------------------------------------------------------------------------------------------}}
            <div class="w-full">
                <label for="pe_outward_no"></label>
                <div x-data="{isTyped: @entangle('outwardTyped')}" @click.away="isTyped = false">
                    <div class="relative">
                        <input
                            id="pe_outward_no"
                            type="search"
                            wire:model.live="pe_outward_no"
                            autocomplete="off"
                            placeholder="Printing & Embroidery Dc Ref.."
                            @focus="isTyped = true"
                            @keydown.escape.window="isTyped = false"
                            @keydown.tab.window="isTyped = false"
                            @keydown.enter.prevent="isTyped = false"
                            wire:keydown.arrow-up="decrementPeOutward"
                            wire:keydown.arrow-down="incrementPeOutward"
                            wire:keydown.enter="enterPeOutward"
                            class="block w-full purple-textbox-no-rounded"
                        />

                        <div x-show="isTyped"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             x-cloak
                        >
                            <div class="absolute z-20 w-full mt-2">
                                <div class="block shadow-md w-full
                rounded-lg border-transparent flex-1 appearance-none border
                                 bg-white text-gray-800 ring-1 ring-purple-600">

                                    <div class="overflow-y-scroll h-96">

                                        <table class="w-full">
                                            <thead>
                                            <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                                                <th class="px-2 text-center border border-gray-300">Outward No</th>
{{--                                                <th class="px-2 text-center border border-gray-300">Lot No</th>--}}
                                                <th class="px-2 text-center border border-gray-300">COLOUR</th>
                                                <th class="px-2 text-center border border-gray-300">SIZE</th>
                                                <th class="px-2 text-center border border-gray-300">QTY</th>
                                            </tr>

                                            </thead>

                                            <tbody>


                                            @if(isset($peOutwardCollection))
                                                @forelse ($peOutwardCollection as $i => $peOutward)
                                                    <div hidden="hidden"
                                                         wire:key="{{ $peOutward['pe_outward_item_id'] }}"></div>
                                                    <tr class="cursor-pointer px-3 hover:font-bold hover:bg-yellow-100 border-b border-gray-300 h-8
                                                        {{ $highlightJobcard === $i ? 'bg-yellow-100' : '' }}"
                                                        wire:click="setPeOutwardItem(
                                                                                '{{$peOutward['jobcard_item_id']}}',
                                                                                '{{$peOutward['pe_outward_item_id']}}','{{$peOutward['pe_outward_no']}}',
                                                                                '{{$peOutward['colour_id']}}','{{$peOutward['colour_name']}}',
                                                                                '{{$peOutward['size_id']}}','{{$peOutward['size_name']}}',
                                                                                '{{$peOutward['qty']}}')"
                                                        x-on:click="isTyped = false">

                                                        <td class="px-2 text-center border border-gray-300">{{$peOutward['pe_outward_no']}}</td>
                                                        <td class="px-2 text-center border border-gray-300">{{$peOutward['colour_name']}}</td>
                                                        <td class="px-2 text-center border border-gray-300">{{$peOutward['size_name']}}</td>
                                                        <td class="px-2 text-center border border-gray-300">{{$peOutward['qty']}}</td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <td>&nbsp;
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5">
                                                            <a href="{{route('cuttings.upsert',['0'])}}" role="button"
                                                               class="flex items-center justify-center bg-green-500 w-full h-8 text-white text-center">
                                                                Not found , Want to create new
                                                            </a>
                                                        </td>
                                                    </tr>
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


            {{--            <div class="w-full">--}}
            {{--                <label for="colour_name"></label>--}}
            {{--                <input id="colour_name" wire:model="colour_name" class="w-full border-gray-200" placeholder="Colour">--}}
            {{--            </div>--}}
            {{--            <div class="w-full">--}}
            {{--                <label for="size_name"></label>--}}
            {{--                <input id="size_name" wire:model="size_name" class="w-full border-gray-200" placeholder="Size">--}}
            {{--            </div>--}}
            <div class="w-full">
                <label for="cutting_qty"></label>
                <input id="cutting_qty" wire:model="qty" class="w-full border-gray-200" placeholder="Qty">
            </div>

            <button wire:click="addItems" class="px-3 bg-green-500 text-white font-semibold tracking-wider ">Add
            </button>
        </section>

        <section>

            <div class="py-2 mt-5">

                <table class="w-full">
                    <thead>
                    <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                        <th class="w-12 px-2 text-center border border-gray-300">#</th>
                        <th class="px-2 text-center border border-gray-300">Outward Dc No</th>
                        <th class="px-2 text-center border border-gray-300">COLOUR</th>
                        <th class="px-2 text-center border border-gray-300">SIZE</th>
                        <th class="px-2 text-center border border-gray-300">QTY</th>
                        <th class="w-12 px-1 text-center border border-gray-300">ACTION</th>
                    </tr>

                    </thead>

                    <tbody>

                    @php
                        $totalQty =0;
                    @endphp

                    @foreach($itemList as $index => $row)
                        <tr class="border border-gray-400">
                            <td class="text-center border border-gray-300 bg-gray-100">
                                <button class="w-full h-full cursor-pointer"
                                        wire:click.prevent="changeItems({{$index}})">
                                    {{$index+1}}
                                </button>
                            </td>
                            <td class="px-2 text-left border border-gray-300">{{$row['pe_outward_no']}}</td>
                            <td class="px-2 text-center border border-gray-300">{{$row['colour_name']}}</td>
                            <td class="px-2 text-center border border-gray-300">{{$row['size_name']}}</td>
                            <td class="px-2 text-center border border-gray-300">{{floatval($row['qty'])}}</td>
                            <td class="text-center border border-gray-300">
                                <button wire:click.prevent="removeItems({{$index}})"
                                        class="py-1.5 w-full text-red-500 items-center ">
                                    <x-aaranUi::icons.icon icon="trash" class="block w-auto h-6"/>
                                </button>
                            </td>
                        </tr>
                        @php
                            $totalQty += $row['qty']+0
                        @endphp

                    @endforeach


                    </tbody>
                    <tfoot class="mt-2">
                    <tr class="h-8 text-sm border border-gray-400 bg-gray-50">
                        <td colspan="4" class="px-2 text-xs text-right border border-gray-300">&nbsp;TOTALS&nbsp;&nbsp;&nbsp;</td>
                        <td class="px-2 text-center border border-gray-300">{{$totalQty}}</td>
                    </tr>
                    </tfoot>

                </table>

            </div>

            <div class="mt-5 flex gap-3">
                <label for="receiver_details" class="gray-label">Receiver Details</label>
                <input id="receiver_details" wire:model="receiver_details" class="purple-textbox w-[32rem]"/>
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
