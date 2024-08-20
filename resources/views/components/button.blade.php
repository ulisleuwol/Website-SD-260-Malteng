@props([
'type' => 'submit',
'as' => 'button'

])

@php
$clasess = 'btn btn-primary'
@endphp

@if ($as === 'button')

<button type="{{ $type }}" {{ $attributes->merge(['class' => $clasess]) }}>
    {{ $slot }}
</button>

@else

<a {{ $attributes->merge(['class' => $clasess]) }}>
    {{ $slot }}
</a>

@endif