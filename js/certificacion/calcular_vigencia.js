$('#fech_cert').on('change', function(){
    $('#vigencia').val(calcular_edad());
});

vigencia

function calcular_edad()
{
    var fecha_seleccionada = $("#fech_cert").val();
    var fehca_nacimiento = new Date (fecha_seleccionada);
    var fecha_actual = new Date();
    var vigencia = (parseInt((fecha_actual- fehca_nacimiento)/(1000*60*60*24*365)));
    return vigencia;
}