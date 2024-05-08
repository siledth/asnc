
function agregar_experi_empre_capa(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_experi_empre_capaToCartTable(cells);
}

function remove_ff_acc() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_es_5a tbody').removeChild(row);
	
	$("#organo_experi_empre_capa").val($("#organo_experi_empre_capa").data("default-value"));
}

function agregar_experi_empre_capaToCartTable(cells){
	
	var organo_experi_empre_capa = $("#organo_experi_empre_capa").val();
	var actividad_experi_empre_capa = $("#actividad_experi_empre_capa").val();
	var desde_experi_empre_capa = $("#desde_experi_empre_capa").val();
	var hasta_experi_empre_capa = $("#hasta_experi_empre_capa").val();
	 


	if (organo_experi_empre_capa == '' || actividad_experi_empre_capa == '' || desde_experi_empre_capa == '' || hasta_experi_empre_capa == '' ){
		if (organo_experi_empre_capa== '') {
			document.getElementById("organo_experi_empre_capa").focus();
		}else if (actividad_experi_empre_capa== '') {
			document.getElementById("actividad_experi_empre_capa").focus();
		}
		else if (desde_experi_empre_capa == '') {
			document.getElementById("desde_experi_empre_capa").focus();
		}
		else if (hasta_experi_empre_capa == '') {
			document.getElementById("hasta_experi_empre_capa").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${organo_experi_empre_capa}<input type="text" name="organo_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${organo_experi_empre_capa}"></td>
		<td>${actividad_experi_empre_capa}<input type="text" name="actividad_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${actividad_experi_empre_capa}"></td>
		<td>${desde_experi_empre_capa}<input type="text" name="desde_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${desde_experi_empre_capa}"></td>
    	<td>${hasta_experi_empre_capa}<input type="text" name="hasta_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${hasta_experi_empre_capa}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		`;

		
		document.querySelector('#target_es_5a tbody').appendChild(newRow);
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
