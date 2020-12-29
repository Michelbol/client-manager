{{ csrf_field() }}
<div class="row">
    <div class="col-4">
        <div class="mb-3">
            <label for="name" class="form-label">Nome *</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Data de Nascimento *</label>
            <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" required>
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            @component(
'components.sex',
[
    'required' => true,
    'selected' => null
])
            @endcomponent
        </div>
    </div>
</div>
<div class="row">
    <div class="col-2">
        <div class="mb-3">
            <label for="zip_code" class="form-label">Cep</label>
            <div class="input-group flex-nowrap">
                <input type="text" class="form-control cep" name="zip_code" id="zip_code">
                <button class="btn btn-outline-primary" type="button" id="search-zip-code"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" class="form-control" name="address" id="address">
        </div>
    </div>
    <div class="col-2">
        <div class="mb-3">
            <label for="number" class="form-label">Número</label>
            <input type="text" class="form-control" name="number" id="number">
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="complement" class="form-label">Complemento</label>
            <input type="text" class="form-control" name="complement" id="complement">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="mb-3">
            <label for="neighborhood" class="form-label">Bairro</label>
            <input type="text" class="form-control" name="neighborhood" id="neighborhood">
        </div>
    </div>
    <div class="col-4">
        @component('components.state')
        @endcomponent
    </div>
    <div class="col-4">
        @component('components.city')
        @endcomponent
    </div>
</div>
<a href="{{ route('clients.index') }}" class="btn btn-danger">Cancelar</a>
<button type="submit" class="btn btn-primary">Salvar</button>

@push('js')
    <script>
        let configPicker = configDataRangePicker();
        configPicker.singleDatePicker = true;
        configPicker.showDropdowns = true;
        var citySelected;
        $('input[name="date_of_birth"]').daterangepicker(configPicker);

        $('#search-zip-code').on('click', function(){
            let zipCode = $('#zip_code').val();
            $.ajax(`https://viacep.com.br/ws/${zipCode}/json/`)
            .done(function(response){
                citySelected = response.localidade;
                $('#address').val(response.logradouro);
                $('#complement').val(response.complemento);
                $('#neighborhood').val(response.bairro);
                let findState = globalStates.filter(function(state){
                    if(state.acronym === response.uf){
                        return state;
                    }
                });
                if(findState !== undefined){
                    $('#state_id').val(findState[0].id).change();
                }
            });
        });
    </script>
@endpush
