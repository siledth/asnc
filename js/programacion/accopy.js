    function control(){
        var acc_cargar_acc = $('#cambiar').val();

        if (acc_cargar_acc === '1') {
            $("#acc_acc").hide();
            $("#proyecto_acc").show();
        }else if (acc_cargar_acc === '2') {
            $("#proyecto_acc").hide();
            $("#acc_acc").show();
        }
    }

    function llenar_() {
        var tipo_pago = $("#acc_cargar").val();
        if (tipo_pago == "2") {
            $("#acc_s").show();
            $("#campos").hide();
        } else {
            $("#campos").show();
            $("#acc_s").hide();
        }
    }


    function bienes(id) {
    var id_programacion = id;
    
      //  var base_url6 =window.location.origin+'/asnc/index.php/Programacion/consultar_acc14'; 
          var base_url6 = '/index.php/Programacion/consultar_acc14';
        //var base_url7 =window.location.origin+'/asnc/index.php/Programacion/consultar_obto'; 
          var base_url7 = '/index.php/Programacion/consultar_obto';
        var rifced = 1;       
        $("#id_programacion1").val(id_programacion);
        
        
        
        $.ajax({
            url:base_url6,
            method: 'post',
            data: {rifced: rifced},
            dataType: 'json',
            success: function(data){
                $.each(data, function(index, data){
                    $('#selec_acc').append('<option value="'+data['id_accion_centralizada']+'">'+data['desc_accion_centralizada']+'</option>');
                });
            }
        })
        $.ajax({
            url:base_url7,
            method: 'post',
            data: {rifced: rifced},
            dataType: 'json',
            success: function(data){
                $.each(data, function(index, data){
                    $('#selec_obj').append('<option value="'+data['id_objeto_contrata']+'">'+data['desc_objeto_contrata']+'</option>');
                });
            }
        })
    
    
    }

    ///////////////////////
    function save_(){

        event.preventDefault();
        swal
            .fire({
                title: "¿Registrar?",
                text: "¿Esta seguro de registrar",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "¡Si, guardar!",
            })
            .then((result) => {
         
            
                if (result.value == true) {
                    event.preventDefault();
                    var datos = new FormData($("#save")[0]);
                           //     var base_url =window.location.origin+'/asnc/index.php/Programacion/nuevo_registro_acc_py';
                     var base_url = '/index.php/Programacion/nuevo_registro_acc_py';
                    
                    $.ajax({
                        url: base_url,
                        method: "POST",
                        data: datos,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var menj = 'Guardado';
                           
                           if (response != '') {
                            swal.fire({
                                title: 'Registro Exitoso ',
                                text: menj ,
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value == true){
                                    location.reload();
                                }
                            });
                            }
                            
                        },
                    });
                }
            });
        
    }
        ////////////////cal partida presupuestaria
    // function bienes(id) {
    //     var id_programacion = id;
    
    //    // var base_url6 =window.location.origin+'/asnc/index.php/Programacion/consultar_acc14'; 
    //       var base_url6 = '/index.php/Programacion/consultar_acc14';
       
    //     var rifced = 1;       
    //     $("#id_programacion1").val(id_programacion);
    //     $.ajax({ 
    //     url: base_url6,
    //     method: "post",
    //     data: { id_p_items: id_p_items },
    //     dataType: "json",
    //     success: function(data) {
    //         $('#id_items_b9').val(id);
    //         $("#id_p_items9").val(id_p_items);
        
    //         $("#id_enlace9").val(data["id_enlace"]); }
        
       
    //     });
    // }
