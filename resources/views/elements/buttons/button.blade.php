@if($type == 'link')
    <a href="{{ $url }}" {!! $attributes !!} role="button">
        @if($icon)
            <i class="material-icons {{ $iconPosition }}">{{ $icon }}</i>
            {{ $text }}
        @else
            {{ $text }}
        @endif
    </a>
@else
    <button type="{{ $type }}" {!! $attributes !!}>
        @if($icon)
            <i class="material-icons {{ $iconPosition }}">{{ $icon }}</i>
            {{ $text }}
        @else
            {{ $text }}
        @endif
    </button>
@endif