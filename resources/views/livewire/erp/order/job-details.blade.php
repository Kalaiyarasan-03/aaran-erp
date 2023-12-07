<div>
    <x-slot name="header">Details</x-slot>
    <x-forms.m-panel>

        {{-- Job Card----------------------------------------------------------------------------------------------------}}
        <section>

            <div class="flex flex-row justify-between py-3 px-3">
                <div>
                    <span class="text-gray-800 text-xl">Job Card</span>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Order&nbsp;No&nbsp;:&nbsp;&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{$jobcard->order->vname}}</span>
                </div>

                <div>
                    <span class="text-gray-500 text-sm">Style&nbsp;Name:&nbsp;&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{$jobcard->style->vname}}</span>
                </div>

                <div>
                    <span class="text-gray-500 text-sm">Job&nbsp;Card&nbsp;No&nbsp;:&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{$jobcard->vno}}</span>
                </div>

                <div>
                    <span class="text-gray-500 text-sm">Job&nbsp;Card&nbsp;Date&nbsp;:&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{date('d-m-Y', strtotime($jobcard->vdate))}}</span>
                </div>

                <div>
                    <span class="text-gray-500 text-sm">Time&nbsp;:&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{date('d-m-Y h:i a', strtotime($jobcard->created_at))}}</span>
                </div>
            </div>
            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">

                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">Lot no</th>
                    <th class="px-2 text-center border border-gray-300">Colour</th>
                    <th class="px-2 text-center border border-gray-300">Size</th>
                    <th class="px-2 text-center border border-gray-300">Qty</th>
                </tr>
                </thead>

                <tbody>
                @php $jobQty = 0; @endphp
                @forelse($jobDetails as $index => $job)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            {{$index+1}}
                        </td>

                        <td class="px-2 text-left border border-gray-300">{{$job->fabric_lot_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$job->colour_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$job->size_name}}</td>
                        <td class="px-2 text-right border border-gray-300">{{$job->qty + 0}}</td>
                    </tr>
                    @php
                        $jobQty += $job['qty']+0
                    @endphp
                @empty
                    &nbsp;
                @endforelse
                <tr class="border border-gray-400">
                    <td colspan="4" class="px-2 text-right border border-gray-300">Total</td>
                    <td class="px-2 text-right border border-gray-300">{{$jobQty}}</td>
                </tr>
                </tbody>
            </table>
        </section>

        {{-- cutting----------------------------------------------------------------------------------------------------}}
        <section>

            <div class="py-3 px-3">
                <div>
                    <span class="text-gray-800 text-xl">Cutting Note</span>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Name&nbsp;:&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{ $jobcard->user->name }}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-sm">Time&nbsp;:&nbsp;</span>
                    <span class="text-gray-800 text-xl">{{date('d-m-Y h:i a', strtotime($jobcard->created_at))}}</span>
                </div>


            </div>
            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">Cutting no</th>
                    <th class="px-2 text-center border border-gray-300">Date</th>
                    <th class="px-2 text-center border border-gray-300">Lot no</th>
                    <th class="px-2 text-center border border-gray-300">Colour</th>
                    <th class="px-2 text-center border border-gray-300">Size</th>
                    <th class="px-2 text-center border border-gray-300">Qty</th>
                </tr>
                </thead>

                <tbody>
                @php $cutQty = 0; @endphp
                @forelse($cuttingDetails as $index => $cut)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            {{$index+1}}
                        </td>
                        <td class="px-2 text-left border border-gray-300">{{$cut->cutting_no .' - '}}{{$cut->cutting_master}}</td>
                        <td class="px-2 text-left border border-gray-300">{{date('d-m-Y', strtotime($cut->cutting_date))}}</td>
                        <td class="px-2 text-left border border-gray-300">{{$cut->fabric_lot_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$cut->colour_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$cut->size_name}}</td>
                        <td class="px-2 text-right border border-gray-300">{{$cut->qty + 0}}</td>
                    </tr>
                    @php
                        $cutQty += $cut['qty']+0
                    @endphp
                @empty
                    &nbsp;
                @endforelse
                <tr class="border border-gray-400">
                    <td colspan="6" class="px-2 text-right border border-gray-300">Total</td>
                    <td class="px-2 text-right border border-gray-300">{{$cutQty}}</td>
                </tr>
                </tbody>
            </table>
        </section>

        {{-- Printing & emb Outward ----------------------------------------------------------------------------------------------------}}
        <section>

            <div class="py-3 px-3">
                <div>
                    <span class="text-gray-800 text-xl">Printing & Emb Outward</span>
                </div>
            </div>
            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">Out Dc no</th>
                    <th class="px-2 text-center border border-gray-300">Date</th>
                    <th class="px-2 text-center border border-gray-300">Colour</th>
                    <th class="px-2 text-center border border-gray-300">Size</th>
                    <th class="px-2 text-center border border-gray-300">Qty</th>
                </tr>
                </thead>

                <tbody>
                @php $peOutQty = 0; @endphp
                @forelse($peOutDetails as $index => $pe_out)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            {{$index+1}}
                        </td>
                        <td class="px-2 text-left border border-gray-300">{{$pe_out->pe_out_no}}</td>
                        <td class="px-2 text-left border border-gray-300">{{date('d-m-Y', strtotime($pe_out->pe_out_date))}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$pe_out->colour_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$pe_out->size_name}}</td>
                        <td class="px-2 text-right border border-gray-300">{{$pe_out->qty + 0}}</td>
                    </tr>
                    @php
                        $peOutQty += $cut['qty']+0
                    @endphp
                @empty
                    &nbsp;
                @endforelse
                <tr class="border border-gray-400">
                    <td colspan="5" class="px-2 text-right border border-gray-300">Total</td>
                    <td class="px-2 text-right border border-gray-300">{{$peOutQty}}</td>
                </tr>
                </tbody>
            </table>
        </section>

        {{-- Printing & emb Inward ----------------------------------------------------------------------------------------------------}}
        <section>

            <div class="py-3 px-3">
                <div>
                    <span class="text-gray-800 text-xl">Printing & Emb Inward</span>
                </div>
            </div>
            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">Inward no</th>
                    <th class="px-2 text-center border border-gray-300">Date</th>
                    <th class="px-2 text-center border border-gray-300">Colour</th>
                    <th class="px-2 text-center border border-gray-300">Size</th>
                    <th class="px-2 text-center border border-gray-300">Qty</th>
                </tr>
                </thead>

                <tbody>
                @php $peInQty = 0; @endphp
                @forelse($peInDetails as $index => $pe_in)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            {{$index+1}}
                        </td>
                        <td class="px-2 text-left border border-gray-300">{{$pe_in->pe_in_no}}</td>
                        <td class="px-2 text-left border border-gray-300">{{date('d-m-Y', strtotime($pe_in->pe_in_date))}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$pe_in->colour_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$pe_in->size_name}}</td>
                        <td class="px-2 text-right border border-gray-300">{{$pe_in->qty + 0}}</td>
                    </tr>
                    @php
                        $peInQty += $pe_in['qty']+0
                    @endphp
                @empty
                    &nbsp;
                @endforelse
                <tr class="border border-gray-400">
                    <td colspan="5" class="px-2 text-right border border-gray-300">Total</td>
                    <td class="px-2 text-right border border-gray-300">{{$peInQty}}</td>
                </tr>
                </tbody>
            </table>
        </section>

        {{-- Section Outward ----------------------------------------------------------------------------------------------------}}
        <section>

            <div class="py-3 px-3">
                <div>
                    <span class="text-gray-800 text-xl">Section Outward</span>
                </div>
            </div>
            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">Section Outward no</th>
                    <th class="px-2 text-center border border-gray-300">Date</th>
                    <th class="px-2 text-center border border-gray-300">Colour</th>
                    <th class="px-2 text-center border border-gray-300">Size</th>
                    <th class="px-2 text-center border border-gray-300">Qty</th>
                </tr>
                </thead>

                <tbody>
                @php $seOutQty = 0; @endphp
                @forelse($seOutDetails as $index => $se_out)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            {{$index+1}}
                        </td>
                        <td class="px-2 text-left border border-gray-300">{{$se_out->se_out_no}}</td>
                        <td class="px-2 text-left border border-gray-300">{{date('d-m-Y', strtotime($se_out->se_out_date))}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$se_out->colour_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$se_out->size_name}}</td>
                        <td class="px-2 text-right border border-gray-300">{{$se_out->qty + 0}}</td>
                    </tr>
                    @php
                        $seOutQty += $pe_in['qty']+0
                    @endphp
                @empty
                    &nbsp;
                @endforelse
                <tr class="border border-gray-400">
                    <td colspan="5" class="px-2 text-right border border-gray-300">Total</td>
                    <td class="px-2 text-right border border-gray-300">{{$seOutQty}}</td>
                </tr>
                </tbody>
            </table>
        </section>

        {{-- Section Inward ----------------------------------------------------------------------------------------------------}}
        <section>

            <div class="py-3 px-3">
                <div>
                    <span class="text-gray-800 text-xl">Section Inward</span>
                </div>
            </div>
            <table class="w-full">
                <thead>
                <tr class="h-8 text-xs bg-gray-100 border border-gray-300">
                    <th class="w-12 px-2 text-center border border-gray-300">#</th>
                    <th class="px-2 text-center border border-gray-300">Inward no</th>
                    <th class="px-2 text-center border border-gray-300">Date</th>
                    <th class="px-2 text-center border border-gray-300">Colour</th>
                    <th class="px-2 text-center border border-gray-300">Size</th>
                    <th class="px-2 text-center border border-gray-300">Qty</th>
                </tr>
                </thead>

                <tbody>
                @php $seInQty = 0; @endphp
                @forelse($seInDetails as $index => $se_in)
                    <tr class="border border-gray-400">
                        <td class="text-center border border-gray-300 bg-gray-100">
                            {{$index+1}}
                        </td>
                        <td class="px-2 text-left border border-gray-300">{{$se_in->se_in_no}}</td>
                        <td class="px-2 text-left border border-gray-300">{{date('d-m-Y', strtotime($se_in->se_in_date))}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$se_in->colour_name}}</td>
                        <td class="px-2 text-center border border-gray-300">{{$se_in->size_name}}</td>
                        <td class="px-2 text-right border border-gray-300">{{$se_in->qty + 0}}</td>
                    </tr>
                    @php
                        $seInQty += $se_in['qty']+0
                    @endphp
                @empty
                    &nbsp;
                @endforelse
                <tr class="border border-gray-400">
                    <td colspan="5" class="px-2 text-right border border-gray-300">Total</td>
                    <td class="px-2 text-right border border-gray-300">{{$peInQty}}</td>
                </tr>
                </tbody>
            </table>
        </section>

    </x-forms.m-panel>
</div>
