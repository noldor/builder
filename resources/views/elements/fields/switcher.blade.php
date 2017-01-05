<div {!! $wrapperAttributes !!}>
    <div class="switch">
        <span class="switcher-label">{{ $label }}</span>
        <label {!! $labelAttributes !!}>
            {{ $textLeft }}
            <input type="checkbox" name="{{ $name }}" {!! $fieldAttributes !!}>
            <span class="lever"></span>
            {{ $textRight }}
        </label>
        @if($errors->has($name))
            <span class="help is-danger">{{ $errors->first($name) }}</span>
        @endif
    </div>
</div>