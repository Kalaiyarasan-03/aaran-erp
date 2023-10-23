<button wire:click="setDelete"  wire:confirm="Are you sure you want to delete this ?"
        class='inline-flex items-center px-4 py-2 border border-transparent
                               rounded-md font-semibold text-xs text-white uppercase tracking-widest
                               focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150
                               focus:ring-red-500 bg-red-600 hover:bg-red-500 active:bg-red-700 border-red-600'>
    <x-icons.icon :icon="'trash'" class="h-5 w-auto block px-1.5"/>
    Delete
</button>

