<a href="{{ $url }}" {!! $attributes !!}>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $text }}
</a>