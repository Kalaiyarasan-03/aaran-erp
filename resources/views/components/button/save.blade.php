<button type="submit" wire:click.prevent="save"
        class='inline-flex items-center px-4 py-2 border border-transparent
                               rounded-md font-semibold text-xs text-white uppercase tracking-widest
                               focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150
                               focus:ring-indigo-500 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 border-indigo-600'>
    <x-aaranUi::icons.icon :icon="'save'" class="h-5 w-auto block px-1.5"/>
    SAVE
</button>
