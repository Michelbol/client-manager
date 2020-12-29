<label
    for="{{ isset($id) ? $id : 'gender' }}"
    class="form-label">
    {{ isset($label) ? $label : 'Sexo' }} {{ isset($required) && $required ? '*' : '' }}
</label>
<select {{ isset($required) && $required ? 'required' : '' }} name="{{ isset($name) ? $name : 'gender' }}" id="{{ isset($id) ? $id : 'gender' }}" class="form-select">
    @foreach(\App\Enums\GenderEnum::getAllValues() as $enum)
        <option {{ isset($selected) && $selected === $enum ? 'selected': '' }} value="{{ $enum }}">{{ __("enums.gender.$enum") }}</option>
    @endforeach
</select>
