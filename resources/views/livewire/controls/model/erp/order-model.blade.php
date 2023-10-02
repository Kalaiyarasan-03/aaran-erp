<div>
    <x-controls.lookup.model :show-model="$showModel" >

        <x-input.lookup-text wire:model="vname"  x-ref="vname" :label="'Contact Name'" :name="'vname'"/>
        <x-input.lookup-text wire:model="desc" :label="'Description'" :name="'desc'"/>


{{--        <div class="grid grid-cols-1 gap-2">--}}
{{--            <label for="order_name" class="gray-label">Order Name</label>--}}
{{--            <input type="text" wire:model="order_name" id="order_name"--}}
{{--                   class="purple-textbox w-full @error('order_name') ? purple-textbox  : red-textbox @enderror"--}}
{{--                   placeholder="Order Name"/>--}}
{{--            @error('order_name') <span class="error-label">{{ $message }}</span> @enderror--}}
{{--        </div>--}}

    </x-controls.lookup.model>
</div>
