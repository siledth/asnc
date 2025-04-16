function perfiles(id) {
    var id_perfil = id;
       
        var base_url = '/index.php/User/read_list_p';
        var base_url2 = '/index.php/User/read_list_p2';
        //  var base_url =window.location.origin+'/asnc/index.php/User/read_list_p';
        //   var base_url2 =window.location.origin+'/asnc/index.php/User/read_list_p2';
    $.ajax({
        url: base_url,
        method: "post",
        data: { id_perfil: id_perfil },
        dataType: "json",
        success: function(data) {
            $('#id2').val(id);
            $("#id3").val(id_perfil);
            $("#nombrep1").val(data["nombrep"]);
            $("#menu_rnce1").val(data["menu_rnce"]);
            $("#menu_progr1").val(data["menu_progr"]);
            $("#menu_eval_desem1").val(data["menu_eval_desem"]);
            $("#menu_reg_eval_desem1").val(data["menu_reg_eval_desem"]);
            $("#menu_anulacion1").val(data["menu_anulacion"]);
            $("#menu_soli_anular_eval_desem1").val(data["menu_soli_anular_eval_desem"]);
            $("#menu_proc_anular_eval_desem1").val(data["menu_proc_anular_eval_desem"]);
            $("#menu_comprobante_eval_desem1").val(data["menu_comprobante_eval_desem"]);
            $("#menu_estdi_eval_desem1").val(data["menu_estdi_eval_desem"]);
            $("#menu_noregi_eval_desem1").val(data["menu_noregi_eval_desem"]);
            $("#menu_llamado1").val(data["menu_llamado"]);
            $("#consultar_llamado1").val(data["consultar_llamado"]);
            $("#reg_llamado1").val(data["reg_llamado"]);
            $("#anul_llamado1").val(data["anul_llamado"]);
            $("#ver_anul_llamado1").val(data["ver_anul_llamado"]);
            $("#ver_rnc1").val(data["ver_rnc"]);
            $("#ver_conf1").val(data["ver_conf"]);
            $("#ver_parametro1").val(data["ver_parametro"]);
            $("#ver_conf_publ1").val(data["ver_conf_publ"]);
            $("#ver_user1").val(data["ver_user"]);
            $("#ver_user_exter1").val(data["ver_user_exter"]);
            $("#ver_user_desb1").val(data["ver_user_desb"]);
            $("#ver_user_lista1").val(data["ver_user_lista"]);
            $("#ver_user_perfil1").val(data["ver_user_perfil"]);
            $("#ver_avanzado1").val(data["ver_avanzado"]);
            $("#avanz_rnce1").val(data["avanz_rnce"]);
            $("#avanz_rnc1").val(data["avanz_rnc"]);
            $("#avanz_gne1").val(data["avanz_gne"]);
            $("#resultados_avza1").val(data["resultados_avza"]);
            var id_perfil = data['id_perfil'];
             
            $.ajax({
                url:base_url2,
                method: 'post',
                data: {id_perfil: id_perfil},
                dataType: 'json',
                success: function(data){
                    $("#menu_rnce3").val(data["menu_rnce"]);
                    $("#menu_progr3").val(data["menu_progr"]);
                    $("#menu_eval_desem3").val(data["menu_eval_desem"]);
                    $("#menu_reg_eval_desem3").val(data["menu_reg_eval_desem"]);
                    $("#menu_anulacion3").val(data["menu_anulacion"]);
                    $("#menu_soli_anular_eval_desem3").val(data["menu_soli_anular_eval_desem"]);
                    $("#menu_proc_anular_eval_desem3").val(data["menu_proc_anular_eval_desem"]);
                    $("#menu_comprobante_eval_desem3").val(data["menu_comprobante_eval_desem"]);
                    $("#menu_estdi_eval_desem3").val(data["menu_estdi_eval_desem"]);
                    $("#menu_noregi_eval_desem3").val(data["menu_noregi_eval_desem"]);
                    $("#menu_llamado3").val(data["menu_llamado"]);
                    $("#consultar_llamado3").val(data["consultar_llamado"]);
                    $("#reg_llamado3").val(data["reg_llamado"]);
                    $("#anul_llamado3").val(data["anul_llamado"]);
                    $("#ver_anul_llamado3").val(data["ver_anul_llamado"]);
                    $("#ver_rnc3").val(data["ver_rnc"]);
                    $("#ver_conf3").val(data["ver_conf"]);
                    $("#ver_parametro3").val(data["ver_parametro"]);
                    $("#ver_conf_publ3").val(data["ver_conf_publ"]);
                    $("#ver_user3").val(data["ver_user"]);
                    $("#ver_user_exter3").val(data["ver_user_exter"]);
                    $("#ver_user_desb3").val(data["ver_user_desb"]);
                    $("#ver_user_lista3").val(data["ver_user_lista"]);
                    $("#ver_user_perfil3").val(data["ver_user_perfil"]);
                    $("#ver_avanzado3").val(data["ver_avanzado"]);
                    $("#avanz_rnce3").val(data["avanz_rnce"]);
                    $("#avanz_rnc3").val(data["avanz_rnc"]);
                    $("#avanz_gne3").val(data["avanz_gne"]);
                    $("#resultados_avza3").val(data["resultados_avza"]);

                }
            })





            
        
        },
    });
}

function edit_perfil(){////////////////////////////////
    event.preventDefault();

    swal.fire({
        title: '¿Seguro desea Modificar? ',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, Modificar!'
    }).then((result) => {
        if (result.value == true) {
            var id_perfil = $('#id2').val();
            var menu_rnce = $('#menu_rnce3').val();
            var camb_menu_rnce = $('#menu_rnce2').val();
            var menu_progr = $('#menu_progr3').val();
            var camb_menu_progr = $('#menu_progr2').val();

            var menu_eval_desem = $('#menu_eval_desem3').val();
            var cam_menu_eval_desem = $('#menu_eval_desem2').val();

            var menu_reg_eval_desem = $('#menu_reg_eval_desem3').val();
            var camb_menu_reg_eval_desem = $('#menu_reg_eval_desem2').val();

            var menu_anulacion = $('#menu_anulacion3').val();
            var camb_menu_anulacion = $('#menu_anulacion2').val();

            var menu_soli_anular_eval_desem = $('#menu_soli_anular_eval_desem3').val();
            var camb_menu_soli_anular_eval_desem = $('#menu_soli_anular_eval_desem2').val();
           
            var menu_proc_anular_eval_desem = $('#menu_proc_anular_eval_desem3').val();
            var camb_menu_proc_anular_eval_desem = $('#menu_proc_anular_eval_desem2').val();
            
            var menu_comprobante_eval_desem = $('#menu_comprobante_eval_desem3').val();
            var camb_menu_comprobante_eval_desem = $('#menu_comprobante_eval_desem2').val();
           
            var menu_estdi_eval_desem = $('#menu_estdi_eval_desem3').val();
            var camb_menu_estdi_eval_desem = $('#menu_estdi_eval_desem2').val();
            
            var menu_noregi_eval_desem = $('#menu_noregi_eval_desem3').val();
            var camb_menu_noregi_eval_desem = $('#menu_noregi_eval_desem2').val();
            
            var menu_llamado = $('#menu_llamado3').val();
            var camb_menu_llamado = $('#menu_llamado2').val();
            
            var consultar_llamado = $('#consultar_llamado3').val();
            var camb_consultar_llamado = $('#consultar_llamado2').val();

            var reg_llamado = $('#reg_llamado3').val();
            var camb_reg_llamado = $('#reg_llamado2').val();
            
            var anul_llamado = $('#anul_llamado3').val();
            var camb_anul_llamado = $('#anul_llamado2').val();
           
            var ver_anul_llamado = $('#ver_anul_llamado3').val();
            var camb_ver_anul_llamado = $('#ver_anul_llamado2').val();
            
            var ver_rnc = $('#ver_rnc3').val();
            var camb_ver_rnc = $('#ver_rnc2').val();

            var ver_ver_avanzado= $('#ver_avanzado3').val();
            var camb_ver_avanzado = $('#ver_avanzado2').val();
            var ver_avanz_rnce= $('#avanz_rnce3').val();
            var camb_avanz_rnce = $('#avanz_rnce2').val();
            var ver_avanz_rnc= $('#avanz_rnc3').val();
            var camb_avanz_rnc = $('#avanz_rnc2').val();
            var ver_avanz_gne= $('#avanz_gne3').val();
            var camb_avanz_gne = $('#avanz_gne2').val();
            var ver_resultados_avza= $('#resultados_avza3').val();
            var camb_resultados_avza = $('#resultados_avza2').val();

            var ver_conf = $('#ver_conf3').val();
            var camb_ver_conf = $('#ver_conf2').val(); var ver_rnc = $('#ver_rnc3').val();
           
            var ver_parametro = $('#ver_parametro3').val(); var ver_rnc = $('#ver_rnc3').val();
            var camb_ver_parametro = $('#ver_parametro2').val(); var ver_rnc = $('#ver_rnc3').val();
           
            var ver_conf_publ = $('#ver_conf_publ3').val();
            var camb_ver_conf_publ = $('#ver_conf_publ2').val();
            
            var ver_user = $('#ver_user3').val();
            var camb_ver_user = $('#ver_user2').val();

            var ver_user_exter = $('#ver_user_exter3').val();
            var camb_ver_user_exter = $('#ver_user_exter2').val();
            
            var ver_user_desb = $('#ver_user_desb3').val();
            var camb_ver_user_desb = $('#ver_user_desb2').val();
           
            var ver_user_lista = $('#ver_user_lista3').val();
            var camb_ver_user_lista = $('#ver_user_lista2').val();
           
            var ver_user_perfil = $('#ver_user_perfil3').val();
            var camb_ver_user_perfil = $('#ver_user_perfil2').val();
   
            var base_url = '/index.php/User/save_modif_perfil'; 
        //   var base_url =window.location.origin+'/asnc/index.php/User/save_modif_perfil';


            $.ajax({
                url:base_url,
                method: 'post',
                data:{
                    id_perfil: id_perfil,
                    menu_rnce: menu_rnce, 
                    camb_menu_rnce: camb_menu_rnce, 
                    menu_progr: menu_progr,
                    camb_menu_progr: camb_menu_progr,
                    menu_eval_desem: menu_eval_desem,
                    cam_menu_eval_desem: cam_menu_eval_desem,
                    menu_reg_eval_desem: menu_reg_eval_desem,
                    camb_menu_reg_eval_desem: camb_menu_reg_eval_desem,
                    menu_anulacion: menu_anulacion,
                    camb_menu_anulacion: camb_menu_anulacion,

                    menu_soli_anular_eval_desem: menu_soli_anular_eval_desem,
                    camb_menu_soli_anular_eval_desem: camb_menu_soli_anular_eval_desem,
                    menu_proc_anular_eval_desem: menu_proc_anular_eval_desem,
                    camb_menu_proc_anular_eval_desem: camb_menu_proc_anular_eval_desem,
                    menu_comprobante_eval_desem: menu_comprobante_eval_desem,
                    camb_menu_comprobante_eval_desem: camb_menu_comprobante_eval_desem,
                   
                    menu_estdi_eval_desem: menu_estdi_eval_desem,
                    camb_menu_estdi_eval_desem: camb_menu_estdi_eval_desem,                   
                    menu_noregi_eval_desem: menu_noregi_eval_desem,                   
                    camb_menu_noregi_eval_desem: camb_menu_noregi_eval_desem,                   
                    menu_llamado: menu_llamado,                   
                    camb_menu_llamado: camb_menu_llamado,                   
                    consultar_llamado: consultar_llamado,                   
                    camb_consultar_llamado: camb_consultar_llamado,                   
                   
                    reg_llamado: reg_llamado,                   
                    camb_reg_llamado: camb_reg_llamado,                   
                    anul_llamado: anul_llamado,                   
                    camb_anul_llamado: camb_anul_llamado,                   
                    ver_anul_llamado: ver_anul_llamado,                   
                    camb_ver_anul_llamado: camb_ver_anul_llamado,

                    ver_rnc: ver_rnc,                   
                    camb_ver_rnc: camb_ver_rnc,     
                    ver_ver_avanzado: ver_ver_avanzado,                   
                    camb_ver_avanzado: camb_ver_avanzado, 
                    ver_avanz_rnce: ver_avanz_rnce,                   
                    camb_avanz_rnce: camb_avanz_rnce,                    
                    ver_avanz_rnc: ver_avanz_rnc,                   
                    camb_avanz_rnc: camb_avanz_rnc, 
                    ver_avanz_gne: ver_avanz_gne,                   
                    camb_avanz_gne: camb_avanz_gne,        

                    ver_resultados_avza: ver_resultados_avza,                   
                    camb_resultados_avza: camb_resultados_avza,  

                    ver_conf: ver_conf,  
                    camb_ver_conf: camb_ver_conf,                   
                    ver_parametro: ver_parametro,                   
                    camb_ver_parametro: camb_ver_parametro,                   
                    ver_conf_publ: ver_conf_publ,                   
                    camb_ver_conf_publ: camb_ver_conf_publ,                   
                    ver_user: ver_user,                   
                    camb_ver_user: camb_ver_user, 

                    ver_user_exter: ver_user_exter,                   
                    camb_ver_user_exter: camb_ver_user_exter,                   
                    ver_user_desb: ver_user_desb,                   
                    camb_ver_user_desb: camb_ver_user_desb, 

                    ver_user_lista: ver_user_lista,                   
                    camb_ver_user_lista: camb_ver_user_lista,                   
                    ver_user_perfil: ver_user_perfil,                   
                    ver_user_lista: ver_user_lista,                   
                    camb_ver_user_perfil: camb_ver_user_perfil,                   
                                     





                },
                dataType: 'json',
                success: function(response){
                    if(response == 1) {
                        swal.fire({
                            title: 'Se Modifico la información con exito.',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value == true) {
                                location.reload();
                            }
                        });
                    }
                }
            })
        }
    });
}