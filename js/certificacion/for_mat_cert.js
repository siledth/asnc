function agregar_for_mat_cert(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_for_mat_certToCartTable(cells);

}

function remove_proy_acc() { 
	var row = this.parentNode.parentNode;
    document.querySelector('#target_for_mat_cer tbody').removeChild(row);
	$("#taller").val($("#taller").data("default-value"));
	$("#institucion").val($("#institucion").data("default-value"));
    $("#hor_dura").val($("#hor_dura").data("default-value"));
	$("#certi").val($("#certi").data("default-value"));
	$("#fech_cert").val($("#fech_cert").data("default-value"));
	$("#vigencia").val($("#vigencia").data("default-value"));


	
}

function agregar_for_mat_certToCartTable(cells){
	var taller = $("#taller").val();
	var institucion = $("#institucion").val();
 	var hor_dura = $("#hor_dura").val();
	 var certi = $("#certi").val();
	var fech_cert = $("#fech_cert").val();
	var vigencia = $("#vigencia").val();

     	
	if (taller == '' || institucion == '' || hor_dura == ''  || certi == ''
	|| fech_cert == '' ){

		if (taller== '') {
			document.getElementById("taller").focus();
		}
		else if (institucion =='') {
			document.getElementById("institucion").focus();
		}
		else if (hor_dura == '') {
			document.getElementById("hor_dura").focus();
		}
		else if (certi == '') {
			document.getElementById("certi").focus();
		}
		else if (fech_cert == '') {
			document.getElementById("fech_cert").focus();
		}
        
		
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${taller}<input type="text" name="taller[]" id="ins-type-${increment}" hidden value="${taller}"></td>
		<td>${institucion}<input type="text" name="institucion[]" id="ins-subtype-${increment}" hidden value="${institucion}"></td>
		<td>${hor_dura}<input type="text" hidden name="hor_dura[]" id="ins-pres-${increment}" value="${hor_dura}"></td>
		<td>${certi}<input type="text" hidden name="certi[]" id="ins-pres-${increment}" value="${certi}"></td>
		<td>${fech_cert}<input type="text" name="fech_cert[]" id="ins-type-${increment}" hidden value="${fech_cert}"></td>
		<td>${vigencia}<input type="text" name="vigencia[]" id="ins-type-${increment}" hidden value="${vigencia}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		`;

		
		
		document.querySelector('#target_for_mat_cer tbody').appendChild(newRow);
		$(document).on('click', '.borrar', function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		  });
		
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
