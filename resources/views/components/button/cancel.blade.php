<button wire:click="$set('showEditModal', false)"
        class='inline-flex items-center px-4 py-2 border border-transparent
                               rounded-md font-semibold text-xs text-white uppercase tracking-widest
                               focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150
                               focus:ring-gray-500 bg-gray-600 hover:bg-gray-500 active:bg-gray-700 border-gray-600'>
    <x-aaranUi::icons.icon :icon="'chevrons-left'" class="h-5 w-auto block px-1.5"/>
    Cancel
</button>
