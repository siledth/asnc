function modal(id) {
    var numero_proceso = id;

    var base_url =
        window.location.origin + "/asnc/index.php/Publicaciones/consultar_numeropro";

     

    $.ajax({
        url: base_url,
        method: "post",
        data: { numero_proceso: numero_proceso },
        dataType: "json",
        success: function(data) {
            $("#numero_proceso2").val(numero_proceso);
            

            
        },
    });
}
