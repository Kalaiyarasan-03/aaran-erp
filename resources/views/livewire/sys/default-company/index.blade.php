<div>
    <div class="flex justify-between w-full mb-3">
        <div>
            @if(isset($company))
                {{$company}}
            @endif
        </div>

        <button wire:click.prevent="switchCompany">
            Select Company
        </button>
    </div>
    @if($showCompanies === true)
        <table class="w-full">
            @forelse ($tenants as $index =>  $row)
                <x-table.row>
                    <x-table.cell>
                        <p class="flex px-3 text-gray-600 truncate text-xl text-left">
                            {{ $row->vname}}
                        </p>
                    </x-table.cell>

                    <x-table.cell>
                        <button wire:click.prevent="setDefault({{$row->id}})"
                                class="flex px-2 text-gray-600 text-xl justify-end w-full">
                            Set as Default
                        </button>
                    </x-table.cell>

                </x-table.row>
            @empty
                <x-table.empty/>
            @endforelse
        </table>
    @endif
</div>
