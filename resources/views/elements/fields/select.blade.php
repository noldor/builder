<div {!! $wrapperAttributes !!}>
    <select name="{{ $name }}" {!! $fieldAttributes !!} >
        @foreach($options as $option)
            <option value="{{ $option['value'] }}" @if((old($name) == $option) || ($value == $option)) selected @endif>{{ $option['label'] }}</option>
        @endforeach
    </select>
    @if($label)
        <label {!! $labelAttributes !!} for="form-field-{{ $name }}">{{ $label }}</label>
    @endif
    @if($errors->has($name))
        <span class="help is-danger">{{ $errors->first($name) }}</span>
    @endif
</div>