@php
    $states = \App\Models\State::all();
@endphp
<label
    for="{{ isset($id) ? $id : 'state_id' }}"
    class="form-label">
    {{ isset($label) ? $label : 'Estado' }} {{ isset($required) && $required ? '*' : '' }}
</label>
<select name="{{ isset($name) ? $name : 'state_id' }}" id="{{ isset($id) ? $id : 'state_id' }}" class="form-select">
    @foreach($states as $state)
        <option
            {{ isset($selected) && $selected === $state->id ? 'selected': '' }}
            value="{{ $state->id }}">
            {{ $state->name }}</option>
    @endforeach
</select>

@push('js')
    <script>
        let globalStates = {!! $states !!};
    </script>
@endpush
