<div>
    <x-slot name="header">Dashboard</x-slot>
    {{--    <livewire:aaahelper.colour.index/>--}}

    <x-forms.m-panel>
        <div class="w-full h-screen">

<div class="text-3xl py-5">{{$order_id}}</div>
            @livewire('controls.lookup.erp.order-lookup')




        </div>
    </x-forms.m-panel>
</div>
