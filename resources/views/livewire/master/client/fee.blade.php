<div>
    <x-slot name="header">Fee</x-slot>

    <x-forms.m-panel>

        <div class="flex flex-row gap-3 py-3">

            <div class="flex flex-row gap-3 py-3 w-full">
                <label for="month" class="w-[8rem] text-zinc-500 tracking-wide py-2">Month</label>
                <select wire:model="month" wire:change="reRender" class="w-full purple-textbox" id="month">
                    <option class="text-zinc-500 px-1">Choose Month...</option>
                    @foreach(\App\Enums\Months::cases() as $month)
                        <option value="{{$month->value}}">{{$month->getName()}}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-row gap-3 py-3 w-full">
                <label for="year" class="w-[8rem] text-zinc-500 tracking-wide px-3 py-2">Year</label>
                <select wire:model="year" wire:change="reRender" class="w-full purple-textbox" id="year">
                    <option class="text-zinc-500 px-1">Choose Year...</option>
                    @foreach(\App\Enums\Years::cases() as $year)
                        <option value="{{$year->value}}">{{$year->getName()}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('client_id')">SL.NO</x-table.ths-slno>
                <x-table.ths wire:click.prevent="sortBy('client_id')">Client</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('client_id')">Invoice</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('client_id')">Amount</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('client_id')">Receipt</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('client_id')">Reference</x-table.ths>
                <x-table.ths wire:click.prevent="sortBy('client_id')">Status</x-table.ths>
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
                            <div class="flex px-3 text-gray-600 truncate text-xl text-left">
                                    {{ $row->client->vname }}
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <div class="flex flex-col px-3">
                                <div class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->invoice_no }} -{{$row->invoice_date ?  date('d-m-Y',strtotime($row->invoice_date )) : '' }}
                                </div>
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <div class="flex px-3 justify-between gap-3">
                                <p class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->amount }}
                                </p>
                                <p class="text-gray-400 truncate text-sm flex items-center  px-3 text-left">
                                    {{ $row->taxable }} - {{ $row->gst }}
                                </p>
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <div class="flex px-3 justify-between gap-3">
                                <p class="text-gray-600 truncate text-xl text-left">
                                    {{ $row->receipt }}
                                </p>
                                <p class="text-gray-400 truncate text-sm flex items-center  px-3 text-left">
                                    {{$row->receipt_date ?  date('d-m-Y',strtotime($row->receipt_date)) : '' }}
                                </p>
                                <p class="text-gray-400 truncate text-sm flex items-center  px-3 text-left">
                                    {{$row->receipt_ref}}
                                </p>
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="text-gray-400 truncate text-sm flex items-center  px-3 text-left">
                                {{$row->receipt_ref}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <div
                                class="flex w-full items-center justify-center  text-center {{  \App\Enums\Status::tryFrom($row->status_id)->getStyle()}}">
                                <p class="flex w-full text-xl text-center  items-center justify-center p-1">
                                    {{ \App\Enums\Status::tryFrom($row->status_id)->getName()}}
                                </p>
                            </div>
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
            <x-input.model-text wire:model="invoice_no" autofocus :label="'invoice_no'"/>
            <x-input.model-text wire:model="invoice_date" type="date" :label="'invoice_date'"/>
            <x-input.model-text wire:model="taxable" :label="'taxable'"/>
            <x-input.model-text wire:model="gst" :label="'gst'"/>
            <x-input.model-text wire:model="receipt" :label="'receipt'"/>
            <x-input.model-text wire:model="receipt_date" type="date" :label="'receipt_date'"/>
            <x-input.model-text wire:model="receipt_ref" :label="'receipt_ref'"/>
        </x-forms.create>

    </x-forms.m-panel>
</div>
