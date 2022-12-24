@props(['value'])

<label {{ $attributes->merge(['class' => 'label']) }}>
    @if($value)
        <span class="label-text">{{ $value }}</span>
    @endif
    {{ $slot }}
</label>
