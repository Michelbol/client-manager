$(document).ready(function() {
    configMasks();
});
function configMasks(){
    $('.cep').mask('00000-000');
}
function configDataRangePicker(){
    return {
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Do",
                "Se",
                "Te",
                "Qua",
                "Qui",
                "Sex",
                "Sa"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1
        }
    };
}

function notify(message, type){
    $.notify({
        // options
        message: message
    },{
        // settings
        type: type //success, info, warning, danger
    });
}
