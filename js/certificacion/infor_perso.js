function agregar_infor_perso(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_infor_persoToCartTable(cells);

}

function remove_proy_acc() { 
	var row = this.parentNode.parentNode;
    document.querySelector('#target_infor_perso tbody').removeChild(row);
	
	
}

function agregar_infor_persoToCartTable(cells){
	var for_academica = $("#for_academica").val();
	var titulo = $("#titulo").val();
 	var ano = $("#ano").val();
	 var culminacion = $("#culminacion").val();
	var curso = $("#curso").val();
	
	if (for_academica == '' || titulo == '' || ano == ''  || culminacion == '' || curso == ''  ){

		if (for_academica== '') {
			document.getElementById("for_academica").focus();
		}
		else if (titulo =='') {
			document.getElementById("titulo").focus();
		}
		else if (ano == '') {
			document.getElementById("ano").focus();
		}
		else if (culminacion == '') {
			document.getElementById("culminacion").focus();
		}
		else if (curso == '') {
			document.getElementById("curso").focus();
		}
       
		
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${for_academica}<input type="text" name="for_academica[]" id="ins-type-${increment}" hidden value="${for_academica}"></td>
		<td>${titulo}<input type="text" name="titulo[]" id="ins-subtype-${increment}" hidden value="${titulo}"></td>
		<td>${ano}<input type="text" hidden name="ano[]" id="ins-pres-${increment}" value="${ano}"></td>
        <td>${culminacion}<input type="text" name="culminacion[]" id="ins-type-${increment}" hidden value="${culminacion}"></td>
		<td>${curso}<input type="text" name="curso[]" id="ins-type-${increment}" hidden value="${curso}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		`;

		


		
		document.querySelector('#target_infor_perso tbody').appendChild(newRow);
		
		
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
