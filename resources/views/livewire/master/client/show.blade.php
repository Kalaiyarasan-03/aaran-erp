<div>
    <x-slot name="header">Client Details</x-slot>
    <div class="w-full border-t-2 border-purple-400 rounded-md shadow-lg bg-opacity-5">
        <div class="p-6 pt-12 pb-6 bg-white rounded-md">


            <div class="flex flex-row gap-2">
                <div class="w-28 text-xl text-gray-500 py-2">Client Id:</div>
                <div class="w-12 text-2xl bg-amber-200 rounded-full px-2 py-1 flex items-center justify-center" >{{$client->id}}</div>
                <div class="w-full text-center text-3xl font-semibold tracking-widest">{{$client->vname}}</div>
            </div>

            <!-- Table -->
            <div class="flex-col space-y-4 mt-10">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-cool-gray-200">
                        <tbody class="border-none">
                        <x-table.row>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        Contact Person
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$vname}}
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                       Gstin
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left tracking-wider">
                                        {{$gstin}}
                                    </p>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        Mobile
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 text-xl text-left tracking-wider">
                                        {{$mobile}}
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        Address
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left tracking-wider">
                                        {{$address_1}}
                                    </p>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        Whatsapp
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 text-xl text-left tracking-wider">
                                        {{$whatsapp}}
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        &nbsp;
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left tracking-wider">
                                        {{$address_2}}
                                    </p>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        Email
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 text-xl text-left tracking-wider">
                                        {{$email}}
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                       City
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left tracking-wider">
                                        {{$city}}
                                    </p>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        &nbsp;
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 text-xl text-left tracking-wider">
                                      &nbsp;
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                      State & Pincode
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left tracking-wider">
                                        {{$state}}&nbsp;-&nbsp;{{$pincode}}
                                    </p>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                        <x-table.row>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        &nbsp;
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <button class="w-full flex justify-center gap-3 text-xl text-blue-400" wire:click="showDetailModal('contactDetails')">
                                    Edit Details
                                    <x-aaranUi::icons.icon :icon="'pencil'"
                                                           class="text-blue-500 h-5 w-auto block"/>
                                </button>
                            </x-table.cell>
                            <x-table.cell class="w-36">
                                <div class="flex px-3">
                                    <p class="text-gray-400 truncate text-xl text-left">
                                        &nbsp;
                                    </p>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                <button class="w-full flex justify-center gap-3 text-xl text-blue-400" wire:click="showDetailModal('address')">
                                    Edit Address
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                </button>
                            </x-table.cell>
                        </x-table.row>
                        </tbody>
                    </table>
                </div>
            </div>


{{--            <div class="flex flex-row w-full mb-5">--}}

{{--                <div class="w-14 h-10 text-2xl bg-purple-200 rounded-full text-center">--}}
{{--                    {{$client->id}}--}}
{{--                </div>--}}

{{--                <div class="text-3xl text-center w-full font-semibold tracking-wider">--}}

{{--                    <div class="text-sm text-gray-400 tracking-wide font-semibold">--}}
{{--                        {{$client->group}}--}}
{{--                    </div>--}}

{{--                    <div class="text-sm text-gray-400 tracking-wide font-semibold">--}}

{{--                    </div>--}}
{{--                    <div class="flex flex-row justify-center">--}}
{{--                        <div class="text-sm text-gray-400 tracking-wide font-semibold px-5">--}}

{{--                        </div>--}}
{{--                        <x-button.link wire:click="showDetailModal('email')">&nbsp;--}}
{{--                            <x-aaranUi::icons.icon :icon="'pencil_outline'"--}}
{{--                                                   class="text-gray-400 hover:text-blue-400 h-5 w-auto block"/>--}}
{{--                        </x-button.link>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="text-2xl text-center w-full font-semibold tracking-wider">--}}
{{--                    {{$gstin}}--}}
{{--                    <x-button.link wire:click="showDetailModal('gstin')">&nbsp;--}}
{{--                        <x-aaranUi::icons.icon :icon="'pencil_outline'"--}}
{{--                                               class="text-gray-400 hover:text-blue-400 h-5 w-auto block"/>--}}
{{--                    </x-button.link>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="w-full flex justify-end">--}}
{{--                <div class="text-lg text-gray-400 flex flex-col shrink-0">--}}
{{--                    <div class="text-sm text-blue-400">Address&nbsp;:</div>--}}
{{--                    <div>{{$address_1}}</div>--}}
{{--                    <div>{{$address_2}}</div>--}}
{{--                    <div>{{$city}}</div>--}}
{{--                    <div>{{$state}}</div>--}}
{{--                    <div>{{$pincode}}</div>--}}
{{--                </div>--}}

{{--                <x-button.link wire:click="showDetailModal('address')">&nbsp;--}}
{{--                    <x-aaranUi::icons.icon :icon="'pencil_outline'"--}}
{{--                                           class="text-gray-400 hover:text-blue-400 h-5 w-auto block"/>--}}
{{--                </x-button.link>--}}
{{--            </div>--}}

            <!-- Table -->
            <div class="flex-col space-y-4 mt-10">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-cool-gray-200">

                        <tbody class="bg-white divide-y divide-cool-gray-200">
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        Gst User Pass
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$gst_user}}
                                    </p>

                                    <div>
                                        <button class="text-gray-300 hover:text-blue-600" value="copy"
                                                onclick="copyToClipboard('{{ $gst_user }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{ $gst_pass }}
                                    </p>
                                </div>
                            </x-table.cell>


                            <x-table.cell>
                                <div class="w-full flex justify-center gap-3">
                                    <x-button.link wire:click="showDetailModal('gstPass')">&nbsp;
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                    </x-button.link>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        E-Invoice User Pass
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$einvoice_user}}
                                    </p>

                                    <div>
                                        <button class="text-gray-300 hover:text-blue-600" value="copy"
                                                onclick="copyToClipboard(' {{$einvoice_user}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$einvoice_pass}}
                                    </p>
                                </div>
                            </x-table.cell>


                            <x-table.cell>
                                <div class="w-full flex justify-center gap-3">
                                    <x-button.link wire:click="showDetailModal('einvoice')">&nbsp;
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                    </x-button.link>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        E-Way User Pass
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$eway_user}}
                                    </p>

                                    <div>
                                        <button class="text-gray-300 hover:text-blue-600" value="copy"
                                                onclick="copyToClipboard('{{ $eway_user }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{ $eway_pass }}
                                    </p>
                                </div>
                            </x-table.cell>


                            <x-table.cell>
                                <div class="w-full flex justify-center gap-3">
                                    <x-button.link wire:click="showDetailModal('eway')">&nbsp;
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                    </x-button.link>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        E-Invoice API
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$einvoice_api}}
                                    </p>

                                    <div>
                                        <button class="text-gray-300 hover:text-blue-600" value="copy"
                                                onclick="copyToClipboard('{{ $einvoice_api }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{ $einvoice_api_pass }}
                                    </p>
                                </div>
                            </x-table.cell>


                            <x-table.cell>
                                <div class="w-full flex justify-center gap-3">
                                    <x-button.link wire:click="showDetailModal('einvoiceApi')">&nbsp;
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                    </x-button.link>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        E-Way API
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$eway_api}}
                                    </p>

                                    <div>
                                        <button class="text-gray-300 hover:text-blue-600" value="copy"
                                                onclick="copyToClipboard('{{ $eway_api }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{ $eway_api_pass }}
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="w-full flex justify-center gap-3">
                                    <x-button.link wire:click="showDetailModal('ewayApi')">&nbsp;
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                    </x-button.link>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        E-mail Acc
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3 justify-between gap-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{$acc_email}}
                                    </p>

                                    <div>
                                        <button class="text-gray-300 hover:text-blue-600" value="copy"
                                                onclick="copyToClipboard('{{ $acc_email }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/>
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="flex px-3">
                                    <p class="text-gray-600 truncate text-xl text-left">
                                        {{ $acc_email_pass }}
                                    </p>
                                </div>
                            </x-table.cell>

                            <x-table.cell>
                                <div class="w-full flex justify-center gap-3">
                                    <x-button.link wire:click="showDetailModal('accEmail')">&nbsp;
                                        <x-aaranUi::icons.icon :icon="'pencil'"
                                                               class="text-blue-500 h-5 w-auto block"/>
                                    </x-button.link>
                                </div>
                            </x-table.cell>

                        </x-table.row>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table -->
            <div class="flex-col space-y-4 mt-4">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-cool-gray-200">
                        <div class="w-full py-2 flex flex-row gap-3">
                            Biller
                            <button wire:click.prevent="showBillPlan"
                                    class="font-semibold tracking-wider text-blue-400">
                                Add
                            </button>
                        </div>

                        <thead>
                        <tr>
                            <x-table.ths-slno wire:click.prevent="sortBy('client')">Sl.no</x-table.ths-slno>
                            <x-table.ths-center wire:click.prevent="sortBy('client')">SALES</x-table.ths-center>
                            <x-table.ths-center wire:click.prevent="sortBy('client')">PURCHASE</x-table.ths-center>
                            <x-table.ths-slno wire:click.prevent="sortBy('client')">Action</x-table.ths-slno>
                        </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-cool-gray-200">
                        @if($list)
                            @forelse ($list as $index =>  $row)
                                <x-table.row>
                                    <x-table.cell>
                                        <div class="flex px-3">
                                            <p class="text-gray-600 truncate text-xl text-left">
                                                {{ $index + 1 }}
                                            </p>
                                        </div>
                                    </x-table.cell>

                                    <x-table.cell>
                                        <div class="flex px-3 justify-center">
                                            <p class="text-gray-600 truncate text-xl text-center">
                                                @if($row->mode ==='sales')
                                                    {{ $row->vname }}
                                                @endif
                                            </p>
                                        </div>
                                    </x-table.cell>

                                    <x-table.cell>
                                        <div class="flex px-3 justify-center">
                                            <p class="text-gray-600 truncate text-xl text-center">
                                                @if($row->mode ==='purchase')
                                                    {{ $row->vname }}
                                                @endif
                                            </p>
                                        </div>
                                    </x-table.cell>

                                    <td>
                                        <div class="w-[8rem]">
                                            <x-button.link wire:click="deleteBillPlan({{$row->id}})">&nbsp;
                                                <x-aaranUi::icons.icon :icon="'trash'"
                                                                       class="text-red-500 h-5 w-auto block"/>
                                            </x-button.link>
                                        </div>
                                    </td>

                                </x-table.row>
                            @empty
                                <x-table.row>
                                    <x-table.cell colspan="13">
                                        <div class="flex justify-center items-center space-x-2">
                                            <x-aaranUi::icons.inbox class="h-8 w-8 text-cool-gray-400"/>
                                            <span
                                                class="font-medium py-8 text-cool-gray-400 text-xl">No Entry found...</span>
                                        </div>
                                    </x-table.cell>
                                </x-table.row>
                            @endforelse
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pt-6">
                <x-button.secondary
                    wire:click.prevent="redirectTo">Back
                </x-button.secondary>
            </div>
        </div>

        <!-- showModel -->
        <form wire:submit.prevent="upsertDetails">
            <div>
                <x-modal.dialog wire:model.defer="showModal">
                    <x-slot name="title">Edit
                        <x-forms.section-border class="py-2"/>
                    </x-slot>

                    <x-slot name="content">
                        @switch($modalName)
                            @case('contactDetails')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="vname" class="w-[10rem] text-zinc-500 tracking-wide py-2">Contact Person</label>
                                    <input wire:model="vname" id="vname" autocomplete="off"
                                           value="{{ old('vname') }}"
                                           autofocus
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="mobile" class="w-[10rem] text-zinc-500 tracking-wide py-2">Mobile</label>
                                    <input wire:model="mobile" id="mobile" autocomplete="off"
                                           value="{{ old('mobile') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="whatsapp" class="w-[10rem] text-zinc-500 tracking-wide py-2">Whatsapp</label>
                                    <input wire:model="whatsapp" id="whatsapp" autocomplete="off"
                                           value="{{ old('whatsapp') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="email" class="w-[10rem] text-zinc-500 tracking-wide py-2">Email</label>
                                    <input wire:model="email" id="email" autocomplete="off"
                                           value="{{ old('email') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="gstin" class="w-[10rem] text-zinc-500 tracking-wide py-2">GST no</label>
                                    <input wire:model="gstin" id="gstin" autocomplete="off"
                                                  value="{{ old('gstin') }}"
                                                  class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                @break

                            @case('address')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="address_1" class="w-[10rem] text-zinc-500 tracking-wide py-2">Address</label>
                                    <input wire:model="address_1" id="address_1" autocomplete="off"
                                                  value="{{ old('address_1') }}"
                                                  autofocus
                                                  class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="address_2" class="w-[10rem] text-zinc-500 tracking-wide py-2">Address 2</label>
                                    <input wire:model="address_2" id="address_2" autocomplete="off"
                                           value="{{ old('address_2') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="city" class="w-[10rem] text-zinc-500 tracking-wide py-2">City</label>
                                    <input wire:model="city" id="city" autocomplete="off"
                                           value="{{ old('city') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="state" class="w-[10rem] text-zinc-500 tracking-wide py-2">State</label>
                                    <input wire:model="state" id="state" autocomplete="off"
                                           value="{{ old('state') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="pincode" class="w-[10rem] text-zinc-500 tracking-wide py-2">Pincode</label>
                                    <input wire:model="pincode" id="state" autocomplete="off"
                                           value="{{ old('pincode') }}"
                                           class="w-full purple-textbox tracking-wider"
                                    />
                                </div>
                                @break

                            @case('gstPass')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="gst_user" class="w-[10rem] text-zinc-500 tracking-wide py-2">GST User</label>
                                    <input wire:model="gst_user" id="gst_user" autocomplete="off"
                                                  value="{{ old('gst_user') }}"
                                                  autofocus
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="gst_pass" class="w-[10rem] text-zinc-500 tracking-wide py-2">GST Pass</label>
                                    <input wire:model="gst_pass" id="gst_pass" autocomplete="off"
                                                  value="{{ old('gst_pass') }}"
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                @break

                            @case('einvoice')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="einvoice_user" class="w-[10rem] text-zinc-500 tracking-wide py-2">Einvoice User</label>
                                    <input wire:model="einvoice_user" id="einvoice_user" autocomplete="off"
                                                  value="{{ old('einvoice_user') }}" autofocus
                                                  class="w-full  purple-textbox"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="einvoice_pass" class="w-[10rem] text-zinc-500 tracking-wide py-2">Einvoice Pass</label>
                                    <input  wire:model="einvoice_pass" id="einvoice_pass" autocomplete="off"
                                                  value="{{ old('einvoice_pass') }}"
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                @break

                            @case('eway')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="eway_user" class="w-[10rem] text-zinc-500 tracking-wide py-2">EWay User</label>
                                    <input wire:model="eway_user" id="eway_user" autocomplete="off"
                                                  value="{{ old('eway_user') }}" autofocus
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="eway_pass" class="w-[10rem] text-zinc-500 tracking-wide py-2">EWay Pass</label>
                                    <input wire:model="eway_pass" id="eway_pass" autocomplete="off"
                                                  value="{{ old('eway_pass') }}"
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                @break

                            @case('einvoiceApi')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="einvoice_api" class="w-[10rem] text-zinc-500 tracking-wide py-2">EInvoice API User</label>
                                    <input wire:model="einvoice_api" id="einvoice_api" autocomplete="off"
                                                  value="{{ old('einvoice_api') }}" autofocus
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="einvoice_api_pass" class="w-[10rem] text-zinc-500 tracking-wide py-2">EInvoice API Pass</label>
                                    <input wire:model="einvoice_api_pass" id="einvoice_api_pass"
                                                  autocomplete="off"
                                                  value="{{ old('einvoice_api_pass') }}"
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                @break

                            @case('ewayApi')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="eway_api" class="w-[10rem] text-zinc-500 tracking-wide py-2">EWay API User</label>
                                    <input wire:model="eway_api" id="eway_api" autocomplete="off"
                                                  value="{{ old('eway_api') }}" autofocus
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="eway_api_pass" class="w-[10rem] text-zinc-500 tracking-wide py-2">EWay API Pass</label>
                                    <input wire:model="eway_api_pass" id="eway_api_pass" autocomplete="off"
                                                  value="{{ old('eway_api_pass') }}"
                                                  class="w-full purple-textbox"
                                    />
                                </div>
                                @break

                            @case('accEmail')
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="acc_email" class="w-[10rem] text-zinc-500 tracking-wide py-2">Acc Email</label>
                                    <input wire:model="acc_email" id="acc_email" autocomplete="off"
                                           value="{{ old('acc_email') }}" autofocus
                                           class="w-full purple-textbox"
                                    />
                                </div>
                                <div class="flex flex-row gap-3 py-3">
                                    <label for="acc_email_pass" class="w-[10rem] text-zinc-500 tracking-wide py-2">Acc Email pass</label>
                                    <input wire:model="acc_email_pass" id="acc_email_pass" autocomplete="off"
                                           value="{{ old('acc_email_pass') }}"
                                           class="w-full purple-textbox"
                                    />
                                </div>
                                @break

                        @endswitch

                        <div class="mb-3">&nbsp;</div>

                    </x-slot>

                    <x-slot name="footer">
                        <div class="w-full flex justify-between gap-3">
                            <div class="flex gap-3">
                                <x-button.secondary
                                    wire:click.prevent="$set('showModal', false)">Cancel
                                </x-button.secondary>

                                <x-button.primary type="submit" wire:click.prevent="upsertDetails">Save
                                </x-button.primary>
                            </div>

                        </div>

                    </x-slot>
                </x-modal.dialog>
            </div>
        </form>

        <!-- BillerModel -->
        <form wire:submit.prevent="createBillPlan">
            <div>
                <x-modal.dialog wire:model.defer="billPlanModal">
                    <x-slot name="title">
                        @if($vid === "")
                            New Entry
                        @else
                            Edit Entry
                        @endif

                        <x-forms.section-border class="py-2"/>
                    </x-slot>

                    <x-slot name="content">

                        <div class="flex flex-row gap-3 py-3">
                            <label for="companyx" class="gray-label">Company</label>
                            <select wire:model="companyx" id="companyx" type="text"
                                    class="purple-textbox w-full">
                                <option class="text-gray-400"> choose ..</option>
                                @foreach($clients as $row)
                                    <option value="{{$row->vname}}">{{$row->vname}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-row gap-3 py-3">
                            <div class="w-[10rem] text-zinc-500 tracking-wide py-2">Mode</div>

                            <label>
                                <input type="radio" wire:model="modex" value="sales">
                                Sales
                            </label>

                            <label>
                                <input type="radio" wire:model="modex" value="purchase">
                                Purchase
                            </label>


                        </div>

                        <div class="mb-3">&nbsp;</div>

                    </x-slot>

                    <x-slot name="footer">
                        <div class="w-full flex justify-between gap-3">
                            <div class="flex gap-3">
                                <x-button.secondary
                                    wire:click.prevent="$set('billPlanModal', false)">Cancel
                                </x-button.secondary>

                                <x-button.primary type="submit" wire:click.prevent="createBillPlan">Save
                                </x-button.primary>
                            </div>

                        </div>

                    </x-slot>
                </x-modal.dialog>
            </div>
        </form>

    </div>
</div>
