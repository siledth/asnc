function llenar_filtro() {
    var tipo = $("#sltTipoFiltro").val();
    if (tipo == "2") {
        $("#camposIdentificadores").show();
        $("#camposFechas").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "3") {
        $("#camposFechas").show();
        $("#camposIdentificadores").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "4") {
        $("#camposFechas").show();
        $("#camposIdentificadores").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "5") {
        $("#camposTextos").show();
        $("#camposFechas").hide();
        $("#camposIdentificadores").hide();
        $("#camposObjetoContratacion").hide();
    } else if (tipo == "6") {
        $("#camposObjetoContratacion").show();
        $("#camposFechas").hide();
        $("#camposIdentificadores").hide();
        $("#camposTextos").hide();

    } else {
        $("#camposIdentificadores").hide();
        $("#camposFechas").hide();
        $("#camposTextos").hide();
        $("#camposObjetoContratacion").hide();

    }
}
function modal_ver(id){
    var id_exonerado = id;
    var base_url = window.location.origin+'/asnc/index.php/GeneratePdfController/index';
    // var base_url = '/index.php/Certificacion/consulta_b';
    $.ajax({
        url: base_url,
        method:'post',
        data: {id_exonerado: id_exonerado},
        dataType:'json',

        success: function(response){
            $('#id').val(response['id_exonerado']);
            $('#cod_banco_edit').val(response['rif']);
            $('#nombre_banco_edit').val(response['descripcion']);
        }
    });
}