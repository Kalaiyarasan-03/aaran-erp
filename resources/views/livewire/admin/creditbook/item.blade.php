<div>
    <x-slot name="header">Credit Book</x-slot>

    <x-forms.m-panel>

        <div class="w-full pb-3 flex justify-between text-3xl">
            <div>&nbsp;</div>
            <div>{{$creditBook->vname}}</div>
            <div class="px-5">Closing : {{$creditBook->closing}}</div>
        </div>

        @editor
        <x-button.new/>
        @endeditor

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('vname')">Date</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Purpose</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Credit</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Debit</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('vname')">Interest</x-table.ths>
            </x-slot>
            <x-slot name="table_body">
                @php
                    $totalCredit = 0;
                    $totalDebit = 0;
                    $totalInterest = 0;
                    $totalBalance = 0;
                @endphp

                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <a href="{{route('creditbooks.items',[$row->id])}}"
                               class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $index + 1 }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('creditbooks.items',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{$row->vdate ?  date('d-m-Y',strtotime($row->vdate)) : '' }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('creditbooks.items',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->purpose }}
                            </a>
                        </x-table.cell>


                        <x-table.cell>
                            <a href="{{route('creditbooks.items',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-right">
                                {{ $row->credit }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('creditbooks.items',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-right">
                                {{ $row->debit }}
                            </a>
                        </x-table.cell>

                        <x-table.cell>
                            <a href="{{route('creditbooks.items',[$row->id])}}"
                               class="flex flex-col px-3 text-gray-600 truncate text-xl text-right">
                                {{ $row->interest }}
                            </a>
                        </x-table.cell>

                        <x-table.action :id="$row->id"/>
                    </x-table.row>

                    @php
                        $totalCredit += floatval($row->credit);
                        $totalDebit += floatval($row->debit);
                        $totalInterest += floatval($row->interest);
                    @endphp
                @empty
                    <x-table.empty/>
                @endforelse

                <tr>
                    <td colspan="3" class="py-4 text-right  text-xl font-semibold px-5  text-gray-400">Total</td>
                    <td class="py-4 text-right px-5 text-xl font-semibold  text-blue-500">{{$totalCredit}}</td>
                    <td class="py-4 text-right px-5 text-xl font-semibold  text-blue-500">{{$totalDebit}}</td>
                    <td class="py-4 text-right px-5 text-xl font-semibold  text-blue-500">{{$totalInterest}}</td>
                </tr>
                <tr>
                    <td colspan="3" class="py-4 text-right  text-xl font-semibold px-5  text-gray-500">&nbsp;</td>
                    <td class="py-4 text-right px-3 text-xl font-semibold  text-blue-500">Balance</td>
                    <td class="py-4 text-right px-5 text-xl font-semibold  text-orange-500">
                        {{$totalCredit - $totalDebit}}
                    </td>
                </tr>

            </x-slot>
            <x-slot name="table_pagination">
                {{ $list->links() }}
            </x-slot>
        </x-forms.table>

        <x-modal.delete/>

        <x-forms.create :id="$vid">
            <x-input.model-text type="date" wire:model="vdate" :label="'Date'"/>
            <x-input.model-text wire:model="purpose" :label="'Purpose'"/>
            <x-input.model-text wire:model="credit" :label="'Credit'"/>
            <x-input.model-text wire:model="debit" :label="'Debit'"/>
            <x-input.model-text wire:model="interest" :label="'Interest'"/>
        </x-forms.create>

    </x-forms.m-panel>
</div>
