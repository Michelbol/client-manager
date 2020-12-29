@php
    $cities = [];
    $id = $id ?? 'city_id';
    $parentId = $parentId ?? 'state_id';
    $label = $label ?? 'Cidade';
    $required = isset($required) && $required ? '*' : '';
    $name = $name ?? 'city_id';
@endphp
<label
    for="{{ $id }}"
    class="form-label">
    {{ $label ?? 'Cidade' }} {{ $required }}
</label>
<select name="{{ $name }}" id="{{ $id }}" class="form-select">
    @foreach($cities as $city)
        <option
            {{ isset($selected) && $selected === $city->id ? 'selected': '' }}
            value="{{ $city->id }}"
        >
            {{ $city->name }}
        </option>
    @endforeach
</select>

@push('js')
    <script>
        let $SELECT_PARENT = $('#{{ $parentId }}');
        let $SELECT_CITY = $('#{{ $id }}');
        $SELECT_PARENT.on('change', function(){
            changeParent();
        });
        let globalCities;

        function changeParent(){
            clearOptions();
            $.ajax(`/cities/${$SELECT_PARENT.val()}`).done(function (cities){
                fillCities(cities);
            });
        }

        function fillCities(cities){
            globalCities = cities;
            for (let i = 0; i < cities.length; i++){
                $SELECT_CITY.append(`<option value="${cities[i].id}">${cities[i].name}</option>`);
            }
            if(citySelected !== undefined){
                let findCity = globalCities.filter(function(city){
                    if(city.name === citySelected){
                        return city;
                    }
                });
                console.log(findCity);
                if(findCity !== undefined && findCity.length > 0){
                    $('#city_id').val(findCity[0].id);
                }
            }
        }

        function clearOptions(){
            $SELECT_CITY.find('option').remove();
        }

        $(document).ready(function(){
            if($SELECT_PARENT.val() !== undefined && $SELECT_PARENT.val().length > 0){
                changeParent();
            }
        });
    </script>
@endpush
