$(document).ready(function() {
    //para consultar y crear el numero de nro_comprobante
    //   var base_url =   window.location.origin + "/asnc/index.php/Certificacion/nro_comprobante";
   var base_url = '/index.php/Certificacion/nro_comprobante';
    $.ajax({
        url: base_url,
        method: "post",
        dataType: "json",

        success: function(response) {
            if (response === null) {
                numero = "1";
            } else {
                numero_c = response["id_comprobante"];
                numero = Number(numero_c) + 1;
                
            }

            function zeroFill(number, width) {
                width -= number.toString().length;
                if (width > 0) {
                    return (
                        new Array(width + (/\./.test(number) ? 2 : 1)).join("0") + number
                    );
                }
                return  number + ""; // siempre devuelve tipo cadena
            }
            
             $("#nro_comprobante").val(zeroFill(numero, 20));
             
             var ret = $('#nro_comprobante').val();
            var pj="PJ-";
            var joined = pj + ret;
            
            $('#nro_comprobantes').val(joined);
            
            //console.log(zeroFill(numero, 5));
        },
    });
});










function guardar_registro(){
    event.preventDefault();
    swal.fire({
        title: '¿Registrar?',
        text: '¿Esta seguro de Registrar ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, guardar!'
    }).then((result) => {

        if (document.reg_bien.objetivo.value.length==0){
            alert("No Puede dejar el campo Objetivo vacio, Ingrese un Objetivo en el menu Programa del curso o taller")
            document.reg_bien.objetivo.focus()
            return 0;
     }
     if (document.reg_bien.acepto.value.length==0){
        alert("Debe aceptar La Declaración Para Continuar con el Registro, en el menu Declaración")
        document.reg_bien.acepto.focus()
        return 0;
 }
 if (document.reg_bien.n_ref.value.length==0){
    alert("No Puede dejar el campo referencia bancaria vacio, Ingrese un dato")
    document.reg_bien.n_ref.focus()
    return 0;
}
 if (document.reg_bien.fecha_trans.value.length==0){
    alert("No Puede dejar el campo fecha de trasferencia vacio, Ingrese una fecha de trasferencia")
    document.reg_bien.fecha_trans.focus()
    return 0;
    }
if (document.reg_bien.monto_trans.value.length==0){
    alert("No Puede dejar el campo Monto de trasferencia vacio")
    document.reg_bien.monto_trans.focus()
    return 0;
}
//  if (document.reg_bien.ubicacion.value.length==0){
//     alert("No Puede dejar el campo ubicacion vacio, Ingrese una ubicacion")
//     document.reg_bien.ubicacion.focus()
//     return 0;
// }
// if (document.reg_bien.pies.value.length==0){
//     alert("No Puede dejar el campo Pie vacio, Ingrese un Pie")
//     document.reg_bien.pies.focus()
//     return 0;
// }
// if (document.reg_bien.canon.value.length==0){
//     alert("No Puede dejar el campo canon vacio, Ingrese un canon")
//     document.reg_bien.canon.focus()
//     return 0;
// }
// if (document.reg_bien.fecha_pago.value.length==0){
//     alert("No Puede dejar el campo  fecha Pago, Ingrese un fecha Pago")
//     document.reg_bien.fecha_pago.focus()
//     return 0;
// }


        if (result.value == true) {

            event.preventDefault();
            var datos = new FormData($("#reg_bien")[0]);
        //    var base_url  = window.location.origin+'/asnc/index.php/Certificacion/registrar_certificacion';
            var base_url = '/index.php/Certificacion/registrar_certificacion';
            $.ajax({
                url:base_url,
                method: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response == 'true') {
                        swal.fire({
                            title: 'Registro Exitoso, En espera Aprobación por Parte del SNC',
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
