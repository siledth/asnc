// var nuevaFecha = getSinFestivosNiFinDeSemana();
// console.log('Nueva fecha: ' + vigencia);

function getSinFestivosNiFinDeSemana(fecha, diasAdd) {
    var fecha =$("#fecha_fin_llamado").val();
    var fecha2 =$("#fecha_fin_llamado").val();
    var fecha3 =$("#fecha_fin_llamado").val();
    var diasAdd = 1;
    var arrFecha = fecha.split('-');
    var fecha = new Date(arrFecha[0], arrFecha[1] - 1, arrFecha[2]);
    var festivos = [ // Agregamos los festivos (dia, mes)
    [19, 04], 
    [01, 05], 
    [24, 06],  
    [05, 07],  
    [24, 07], 
    [12, 10],  
    [25, 12],
        [1, 1]
    ];

    for (var i = 0; i < diasAdd; i++) {
        var diaInvalido = false;
        fecha.setDate(fecha.getDate() - 1); // restamos un dia Sumamos de dia en dia
        for (var j = 0; j < festivos.length; j++) { // Verificamos si el dia + 1 es festivo
            var mesDia = festivos[j];
            if (fecha.getMonth() + 1 == mesDia[1] && fecha.getDate() == mesDia[0]) {
                console.log(fecha.getDate() + ' es dia festivo (Sumamos un dia)');
                diaInvalido = true;
                break;
            }
        }
        if (fecha.getDay() == 0 || fecha.getDay() == 6) { // Verificamos si es sábado o domingo
            console.log(fecha.getDate() + ' es sábado o domingo (Sumamos un dia)');
            diaInvalido = true;
        }
        if (diaInvalido)
            diasAdd++; // Si es fin de semana o festivo le sumamos un dia
    }
    vigencia = fecha.getFullYear() + '-' + (fecha.getMonth() + 1).toString().padStart(2, '0') + '-' + fecha.getDate().toString().padStart(2, '0');
    $('#fecha_tope').val(vigencia);
    $('#fecha_entrega_sobre').val(fecha2)
    $('#fecha').val(fecha3)
    
    //return vigencia;


    var fecha4 =$("#fecha_entrega_sobre").val();
    const fechaComoCadena = fecha4; // día lunes
        const dias = [
          
          'lunes',
          'martes',
          'miércoles',
          'jueves',
          'viernes',
          'sabado',
          'domingo',
        ];
        const numeroDia = new Date(fechaComoCadena).getDay();
        const nombreDia = dias[numeroDia];
        $('#fecha').val(nombreDia)
        //console.log("Nombre de día de la semana: ", nombreDia);
        if ((nombreDia == 'domingo')) {
            $('#result-finde').fadeIn(1600).html(
                '<div class="alert alert-danger"><strong>No puede selecionar un finde semana,ingrese otra fecha</strong> .</div>'
                );
            $("#guardar").prop('disabled', true)

        } else if (nombreDia == 'sabado'){
            
            $('#result-finde').fadeIn(1600).html(
                '<div class="alert alert-danger"><strong>No puede selecionar un finde semana</strong> .</div>'
                );
            $("#guardar").prop('disabled', true)
               
        } 
        else {
            $('#result-finde').fadeIn(1600).html(
                '<div ></div>'
                );
            $("#guardar").prop('disabled', false)
        }
       // console.log("Nombre de día de la semana: ", nombreDia);
}
// function getSinfindesemana() {
//     var fecha3 =$("#fecha").val();
// const fechaComoCadena = fecha3; // día lunes
//     const dias = [
      
//       'lunes',
//       'martes',
//       'miércoles',
//       'jueves',
//       'viernes',
//       'sábado',
//       'domingo',
//     ];
//     const numeroDia = new Date(fechaComoCadena).getDay();
//     const nombreDia = dias[numeroDia];
//     $('#fecha').val(nombreDia)
//     console.log("Nombre de día de la semana: ", nombreDia);
// }
// // Array con los días festivos de cada mes (ejemplo de muestra)
// // Nótese que si un mes no tiene festivos debemos incluir igualmente un array vacío, (ejemplo: Noviembre)
// const festivos = [[1, 7, 8],[27, 28],[1],[6, 9],[1],[15],[9],[17, 18, 19],[10],[12, 23],[],[25]];

// // JavaScript usa como estándar el formato de fecha ISO (YYYY-MM-DD)
// // const diaPedido = new Date('2019-01-04');
// // Leyendo un poco tu comentario con más atención veo que la fecha de pedido
// // es la fecha actual, por lo tanto edito para que la respuesta se ajuste a tu pregunta

// const diaPedido = new Date(Date.now());
// // Construimos la fecha usando como parámetro el valor devuelto por Date.now().

// // La siguiente función recibe como parámetros:
// // diaPedido: Es el día inicial, (cuando se recibe un pedido), tipo: Date
// // diasPactados: Es la cantidad de días laborales que han sido pactados para entrega, tipo: Number
// // festivos: Es el Array que hemos inicializado anteriormente y contiene los días festivos del año, tipo: Array
// //      Se espera que los días festivos sean fijos de año en año, pero pudieran modificarse.
// //      Así que sólo hay que asegurarse de pasar el array de festivos mas actualizado a la función.

// function calculaEntrega(diaPedido, diasPactados, festivos) {
//     // diaPropuesto: almacena el mismo valor de diaPedido, en caso que diasPactados = 0, la función 
//     // devolverá el valor de diaPedido (para mi tiene lógica)
//     let diaPropuesto = new Date(diaPedido.getFullYear(), diaPedido.getMonth(), diaPedido.getDate());

//     // iniciamos un contador en 1 para calcular la fecha de diaPropuesto.
//     let i = 1;
    
//     // El siguiente bucle se ejecutará hasta que se consuman los diasPactados
//     while (diasPactados > 0 ) {
//         // En cada iteración asumimos que el día no es festivo
//         let festivo = false;
//         // incrementamos en 1 el diaPropuesto para efectuar las verificaciones
//         diaPropuesto = new Date(diaPedido.getFullYear(), diaPedido.getMonth(), diaPedido.getDate() + i);
//         // Nótese que usamos formato ISO y solo incrementamos el día, dejando el mes y el año iguales
//         // Alguien preguntará: ¿Y que pasa si la fecha es, digamos, 31 de Enero y le aumentamos 1 día?
//         // Pues la respuesta lógica es que daría 32 de Enero, lo cual no es una fecha válida.
//         // Sin embargo, JavaScript es un poco mas atento que nosotros y simplemente realiza la aritmética
//         // necesaria para convertir el 32 de Enero en 01 de Febrero, y así nos salva el pellejo.
//         // Véase bien que usamos los métodos getFullYear(), getMonth() y getDate().
//         // Esto funciona siempre y cuando hagamos la construcción del objeto Date de esta manera.
//         // Ya irá alguno de avispado y pondrá: fecha = new Date('2019-01-32'); lo cual le dará 'fecha inválida'
//         // Alguien un poco mas versado puede aclarar este asunto, pero no es el objetivo en este momento.

//         if (diaPropuesto.getDay() > 0 && diaPropuesto.getDay() < 6) {
//             // Aquí hemos usado el método getDay() del objeto Date, este método devuelve un valor entero entre 0 y 6,
//             // donde 0: Domingo, 1: Lunes, ... , 6: Sabado.
//             // Los días laborables van del 1 al 5 (ambos inclusive)
            
//             // Si el día es laborable debemos entonces verificar si es festivo
            
//             // Aquí es importante que entendamos lo siguiente:
//             //  * Por cada iteración debemos obtener el mes en el que estamos comprobando el festivo
//             //  * Vamos a comparar el día propuesto con el Array de festivos, usando el mes correspondiente

//             let m = diaPropuesto.getMonth();
//             let dia = diaPropuesto.getDate();

//             // Felizmente para nosotros el método getMonth() devuelve un entero entre 0 y 11, que se
//             // corresponde con cada mes del año, y digo felizmente, porque los índices de nuestro Array
//             // van de 0 a 11 también.

//             for (let d in festivos[m]) {
//                 if (dia === festivos[m][d]) {
//                     festivo = true;
//                     //Aquí no hay mucho que aclarar, si es festivo ya no sigo comprobando el resto del mes.
//                     break;
//                 }
//             } // Fin bucle for

//             if (!festivo) {
//                 // Si las condiciones son: Laborable y No Festivo, descuento el diaPactado.
//                 diasPactados--;
//             }
//         }

//         // Por último, debemos incrementar el número de días que sumaremos al diaPropuesto
//         // en cada iteración
//         i++;
//     } // Fin de bucle while

//     // Devolvemos el resultado
//     return diaPropuesto;

// } // Fin función



// // Finalmente asignamos nuestra variable diaEntrega, la cual contendra un Objeto Date valido indicando
// // la fecha en que el pedido sera entregado.

// const diaEntrega = calculaEntrega(diaPedido, 10, festivos);

// console.log(`Dia de pedido: ${diaPedido.toString()}`);
// console.log(`Dia de entrega calculado: ${diaEntrega.toString()}`);