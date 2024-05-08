
function agregar_ex3a(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ex3aToCartTable(cells);
}

function remove_ff_acc() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_es_3a tbody').removeChild(row);
	
	$("#organo3").val($("#organo3").data("default-value"));
}

function agregar_ex3aToCartTable(cells){
	
	var organo3 = $("#organo3").val();
	var actividad3 = $("#actividad3").val();
	var desde3 = $("#desde3").val();
	var hasta3 = $("#hasta3").val();
	 


	if (organo3 == '' || actividad3 == '' || desde3 == '' || hasta3 == '' ){
		if (organo3== '') {
			document.getElementById("organo3").focus();
		}else if (actividad3== '') {
			document.getElementById("actividad3").focus();
		}
		else if (desde3 == '') {
			document.getElementById("desde3").focus();
		}
		else if (hasta3 == '') {
			document.getElementById("hasta3").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${organo3}<input type="text" name="organo3[]" id="ins-type-${increment}" hidden value="${organo3}"></td>
		<td>${actividad3}<input type="text" name="actividad3[]" id="ins-type-${increment}" hidden value="${actividad3}"></td>
		<td>${desde3}<input type="text" name="desde3[]" id="ins-type-${increment}" hidden value="${desde3}"></td>
    	<td>${hasta3}<input type="text" name="hasta3[]" id="ins-type-${increment}" hidden value="${hasta3}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		`;

		
		document.querySelector('#target_es_3a tbody').appendChild(newRow);
		$(document).on('click', '.borrar', function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		  });
		
		
		$("#btn_guar_2").prop('disabled', false);
	}
}



function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
