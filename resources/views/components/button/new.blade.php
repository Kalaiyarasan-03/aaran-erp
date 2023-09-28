<button wire:click="create" {{ $attributes->merge(['type' => 'submit',
                               'class' => 'inline-flex items-center px-4 py-2 border border-transparent
                               rounded-md font-semibold text-xs text-white uppercase tracking-widest
                               focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150
                               focus:ring-green-500 bg-green-600 hover:bg-green-500 active:bg-green-500 border-green-600  print:hidden
                               ']) }}>
        <x-aaranUi::icons.plus/>
        NEW
</button>

