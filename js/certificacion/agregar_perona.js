function agregar_persona(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_personaToCartTable(cells);

}

function remove_proy_acc() { 
	var row = this.parentNode.parentNode;
    document.querySelector('#target_persona tbody').removeChild(row);
	$("#nombre_ape").val($("#nombre_ape").data("default-value"));
	$("#cedula").val($("#cedula").data("default-value"));
    $("#rif").val($("#rif").data("default-value"));
	$("#id_alicuota_iva").val($("#id_alicuota_iva").data("default-value"));
	$("#iva_estimado").val($("#iva_estimado").data("default-value"));
	$("#monto_estimado").val($("#monto_estimado").data("default-value"));

	
}

function agregar_personaToCartTable(cells){
	var nombre_ape = $("#nombre_ape").val();
	var cedula = $("#cedula").val();
 	var rif = $("#rif").val();
	 var id_alicuota_iva = $("#id_alicuota_iva").val();
	 
	var bolivar_estimado = $("#bolivar_estimado").val();
	var iva_estimado = $("#iva_estimado").val();
	var monto_estimado = $("#monto_estimado").val();
     	
	if (nombre_ape == '' || cedula == '' || rif == '' || id_alicuota_iva == ''  ){

		if (nombre_ape== '') {
			document.getElementById("nombre_ape").focus();
		}
		else if (cedula =='') {
			document.getElementById("cedula").focus();
		}
		else if (rif == '') {
			document.getElementById("rif").focus();
		}
        else if (bolivar_estimado == '') {
			document.getElementById("bolivar_estimado").focus();
		}
		else if (id_alicuota_iva == '') {
			document.getElementById("id_alicuota_iva").focus();
		}
		
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${nombre_ape}<input type="text" name="nombre_ape[]" id="ins-type-${increment}" hidden value="${nombre_ape}"></td>
		<td>${cedula}<input type="text" name="cedula[]" id="ins-subtype-${increment}" hidden value="${cedula}"></td>
		<td>${rif}<input type="text" hidden name="rif[]" id="ins-pres-${increment}" value="${rif}"></td>
        <td>${bolivar_estimado}<input type="text" name="bolivar_estimado[]" id="ins-type-${increment}" hidden value="${bolivar_estimado}"></td>
		<td>${iva_estimado}<input type="text" name="iva_estimado[]" id="ins-type-${increment}" hidden value="${iva_estimado}"></td>
		<td>${monto_estimado}<input type="text" name="monto_estimado[]" id="ins-type-${increment}" hidden value="${monto_estimado}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		
		`;

		var pj = $("#pj").val();
		var newstr = pj.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var iv_pj = newstr4.replace(',', ".");
		
	

		var montopj = 0.16 * iv_pj;
		var total_pj = parseFloat(montopj).toFixed(2);
		var total_pj = Intl.NumberFormat("de-DE").format(total_pj);
		$('#total_pj').val(total_pj);

		var iva_estimados = $("#iva_estimado").val();
		var newstr = iva_estimados.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var iva_estimado = newstr4.replace(',', ".");

		var total_ivas = $("#total_iva").val();
		var newstr = total_ivas.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var total_iva = newstr4.replace(',', ".");

		var total_f_1 = Number(iva_estimado) + Number(total_iva);
		var total_f_2 = parseFloat(total_f_1).toFixed(2);
	    var total_f = Intl.NumberFormat("de-DE").format(total_f_2);
		$('#total_iva').val(total_f);



		var tot = $("#total_iva").val();
		var newstr = tot.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var to = newstr4.replace(',', ".");





		var tot2 = $("#total_pj").val();
		var newstr = tot2.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var t = newstr4.replace(',', ".");
		
		var total1 = Number(to) + Number(t);
		var total2 = parseFloat(total1).toFixed(2);
	    var total3 = Intl.NumberFormat("de-DE").format(total2);
		$('#total_final').val(total3);
		////////////////////

		////////////////////////////
		var bolivar_estimados = $("#bolivar_estimado").val();
		var newstr = bolivar_estimados.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var bolivar_estimados1 = newstr4.replace(',', ".");

		var total_iv = $("#total_bs").val();
		var newstr = total_iv.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var total_i = newstr4.replace(',', ".");
		
		
		
		
		
        var totaliva= Number(bolivar_estimados1) + Number(total_i);
		var totalivas = parseFloat(totaliva).toFixed(2);
	    var totalivass = Intl.NumberFormat("de-DE").format(totalivas);
		$('#total_bs').val(totalivass);

		var total_bs = $("#total_bs").val();
		var newstr = total_bs.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var total_bss = newstr4.replace(',', ".");

		var pj3 = $("#pj").val();
		var newstr = pj3.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var pj4 = newstr4.replace(',', ".");

		var total_final2 = $("#total_final").val();
		var newstr = total_final2.replace('.', "");
	    var newstr2 = newstr.replace('.', "");
	    var newstr3 = newstr2.replace('.', "");
	    var newstr4 = newstr3.replace('.', "");
	    var total_final4 = newstr4.replace(',', ".");
		
		
		var exitte  = $("#cedula").val();
		if (exitte == 'V6429731'){ 
			var finalss = 0;
			$('#total_bss').val(finalss);
			var finalsss = 0;
			$('#sub_total').val(finalsss);
			var total3 = 0;
			$('#total_final').val(total3);
			
          }else{
			var final= Number(total_bss) + Number(pj4) + Number(total_final4);
			var finals = parseFloat(final).toFixed(2);
			var finalss = Intl.NumberFormat("de-DE").format(finals);
			$('#total_bss').val(finalss);
			
			var finals= Number(total_bss) + Number(pj4) ;
			var finalss = parseFloat(finals).toFixed(2);
			var finalsss = Intl.NumberFormat("de-DE").format(finalss);
			$('#sub_total').val(finalsss);
			

		  }
		
        




		  var cellremove_medBtn = createCell();
		  cellremove_medBtn.appendChild(createremove_medBtn())
		  newRow.appendChild(cellremove_medBtn);

		  document.querySelector('#target_persona tbody').appendChild(newRow);
		
		   $("#nombre_ape").val(''); // me resfresca los input
	
			
	

		  function remove_med() {
				 var row = this.parentNode.parentNode;
				 document.querySelector('#target_persona tbody')
				 .removeChild(row);
			
		  }

		  function createremove_medBtn() {
			  var btnremove_med = document.createElement('button');
			  btnremove_med.className = 'btn btn-xs btn-danger';
			  btnremove_med.onclick = remove_med;
			  btnremove_med.innerText = 'Descartar';
			  return btnremove_med;
		  }
		
		$("#btn_guar_2").prop('disabled', true);
	}
}



function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
