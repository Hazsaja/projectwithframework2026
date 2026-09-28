@props(['color' => 'grey'])


@php

$colorClasses = [
        'red'    => 'bg-red-100 text-red-700',
        'green'  => 'bg-green-100 text-green-700',
        'yellow' => 'bg-yellow-100 text-yellow-700',
        'blue'   => 'bg-blue-100 text-blue-700',
        'gray'   => 'bg-gray-100 text-gray-700',
    ][$color] ?? 'bg-gray-100 text-gray-700';
@endphp


<span class="inline-block text-[11px] px-3 py-1 rounded-full font-medium {{ $colorClasses }}">
  
  {{$slot}}

</span>