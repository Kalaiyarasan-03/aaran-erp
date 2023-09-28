@props(['href', 'route'])
<td class="border border-gray-200">
    <a class="flex py-1"
       href="{{ isset($route) ? ($route) : $href }}">
        {{ $slot }}
    </a>
</td>
