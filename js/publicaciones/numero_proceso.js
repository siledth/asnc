function modal(id){
    var numero_proceso = id;
    // var base_url = window.location.origin+'/asnc/index.php/Certificacion/consulta_facilitadores';
    var base_url = '/index.php/Publicaciones/consulta_facilitadores';
    $.ajax({
        url: base_url,
        method:'post',
        data: {numero_proceso: numero_proceso},
        dataType:'json',

        success: function(response){
            $('#numero_proceso').val(response['numero_proceso']);
            
           
        }
    });
}