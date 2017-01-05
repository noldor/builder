<div {!! $wrapperAttributes !!}>
        <input type="checkbox" name="{{ $name }}" value="{{ $value }}" {!! $fieldAttributes !!}>
        <label {!! $labelAttributes !!} for="form-field-{{ $name }}">{{ $label }}</label>
        @if($errors->has($name))
            <span class="help is-danger">{{ $errors->first($name) }}</span>
        @endif
</div>