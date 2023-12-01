<div>
    <x-slot name="header">Product</x-slot>

    <x-forms.m-panel>
        <x-forms.top-controls :show-filters="$showFilters"/>

        <x-forms.table :list="$list">
            <x-slot name="table_header">
                <x-table.ths-slno wire:click.prevent="sortBy('vname')">Sl.no</x-table.ths-slno>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Product Name</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Product type</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Unit of Measure</x-table.ths-center>
                <x-table.ths-center wire:click.prevent="sortBy('vname')">Gst Percent</x-table.ths-center>
            </x-slot>

            <x-slot name="table_body">
                @forelse ($list as $index =>  $row)
                    <x-table.row>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $index + 1 }}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-left">
                                {{ $row->vname}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <div class="flex px-3 text-gray-600 truncate text-xl text-center justify-center">
                                {{\App\Enums\ProductType::tryFrom($row->product_type)->getName()}}
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-center justify-center">
                                {{\App\Enums\Units::tryFrom($row->units)->getName()}}
                            </p>
                        </x-table.cell>

                        <x-table.cell>
                            <p class="flex px-3 text-gray-600 truncate text-xl text-center justify-center">
                                {{\App\Enums\GstPercent::tryFrom($row->gst_percent)->getName()}}
                            </p>
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
            <x-input.model-text wire:model="vname" :label="'Name'"/>

            <x-input.model-select wire:model="product_type" :label="'Product Type'">
                <option class="text-gray-400"> choose ..</option>
                @foreach(\App\Enums\ProductType::cases() as $product_type)
                    <option value="{{$product_type->value}}">{{$product_type->getName()}}</option>
                @endforeach
            </x-input.model-select>

            <x-input.model-select wire:model="units" :label="'Units'">
                <option class="text-gray-400"> choose ..</option>
                @foreach(\App\Enums\Units::cases() as $units)
                    <option value="{{$units->value}}">{{$units->getName()}}</option>
                @endforeach
            </x-input.model-select>

            <x-input.model-select wire:model="gst_percent" :label="'Gst Percent'">
                <option class="text-gray-400"> choose ..</option>
                @foreach(\App\Enums\GstPercent::cases() as $gst_percent)
                    <option value="{{$gst_percent->value}}">{{$gst_percent->getName()}}</option>
                @endforeach
            </x-input.model-select>

        </x-forms.create>

    </x-forms.m-panel>
</div>
