<div {!! $wrapperAttributes !!}>
    @if($icon)
        <i class="material-icons prefix">{{ $icon }}</i>
    @endif
    <input type="{{ $type }}" name="{{ $name }}"
           value="{{ old($name) ? old($name) : $value }}" {!! $fieldAttributes !!}>
    @if($label)
        <label {!! $labelAttributes !!} for="form-field-{{ $name }}">{{ $label }}</label>
    @endif
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
