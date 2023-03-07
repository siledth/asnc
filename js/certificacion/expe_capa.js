
function agregar_ff(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ffToCartTable(cells);
}

function remove_ff_acc() {
	var row = this.parentNode.parentNode;
    document.querySelector('#target_acc_ff tbody').removeChild(row);
	
	$("#organo_expe").val($("#organo_expe").data("default-value"));
}

function agregar_ffToCartTable(cells){
	
	var organo_expe = $("#organo_expe").val();
	
	var actividad_exp = $("#actividad_exp").val();
	var desde_exp = $("#desde_exp").val();
	var hasta_exp = $("#hasta_exp").val();



	if (organo_expe == '' || actividad_exp == '' || desde_exp == '' || hasta_exp == ''){
		if (organo_expe== '') {
			document.getElementById("organo_expe").focus();
		}else if (actividad_exp== '') {
			document.getElementById("actividad_exp").focus();
		}
		else if (desde_exp == '') {
			document.getElementById("desde_exp").focus();
		}
		else if (hasta_exp == '') {
			document.getElementById("hasta_exp").focus();
		}
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${organo_expe}<input type="text" name="organo_expe[]" id="ins-type-${increment}" hidden value="${organo_expe}"></td>
		<td>${actividad_exp}<input type="text" name="actividad_exp[]" id="ins-type-${increment}" hidden value="${actividad_exp}"></td>
		<td>${desde_exp}<input type="text" name="desde_exp[]" id="ins-type-${increment}" hidden value="${desde_exp}"></td>
    	<td>${hasta_exp}<input type="text" name="hasta_exp[]" id="ins-type-${increment}" hidden value="${hasta_exp}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		`;

		document.querySelector('#target_acc_ff tbody').appendChild(newRow);
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
