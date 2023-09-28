@props(['column','class'=>''])

<th class="text-center whitespace-nowrap border border-gray-300  py-2 w-[2rem] text-gray-500">
    <a class="px-1 w-[2rem] "
    role="button"
       href="#">
        {{ $slot }}
    </a></th>


