function agregar_exp_10(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_exp_10ToCartTable(cells);

}

function remove_proy_acc() { 
	var row = this.parentNode.parentNode;
    document.querySelector('#target_exp_10 tbody').removeChild(row);
	$("#cedul10").val($("#cedul10").data("default-value"));
	$("#organo10").val($("#organo10").data("default-value"));
	$("#act_adminis_desid").val($("#act_adminis_desid").data("default-value"));
    $("#n_acto").val($("#n_acto").data("default-value"));
	$("#area_10").val($("#area_10").data("default-value"));
	$("#dura_comi").val($("#dura_comi").data("default-value"));
	$("#fecha_act").val($("#fecha_act").data("default-value"));


	
}

function agregar_exp_10ToCartTable(cells){
	var cedul10 = $("#cedul10").val();

	var organo10 = $("#organo10").val();
	var act_adminis_desid = $("#act_adminis_desid").val();
 	var n_acto = $("#n_acto").val();
	 var area_10 = $("#area_10").val();
	var dura_comi = $("#dura_comi").val();
	var fecha_act = $("#fecha_act").val();

     	
	if (cedul10 == '' ||organo10 == '' || act_adminis_desid == '' || n_acto == ''  || area_10 == '' || dura_comi == ''
	|| fecha_act == ''){

		if (cedul10== '') {
			document.getElementById("cedul10").focus();
		}
		else if (organo10 =='') {
			document.getElementById("organo10").focus();
		}
		else if (act_adminis_desid =='') {
			document.getElementById("act_adminis_desid").focus();
		}
		else if (n_acto == '') {
			document.getElementById("n_acto").focus();
		}
		else if (area_10 == '') {
			document.getElementById("area_10").focus();
		}
		else if (dura_comi == '') {
			document.getElementById("dura_comi").focus();
		}
		else if (fecha_act == '') {
			document.getElementById("fecha_act").focus();
		}
      
		
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${cedul10}<input type="text" name="cedul10[]" id="ins-type-${increment}" hidden value="${cedul10}"></td>
		<td>${organo10}<input type="text" name="organo10[]" id="ins-type-${increment}" hidden value="${organo10}"></td>
		<td>${act_adminis_desid}<input type="text" name="act_adminis_desid[]" id="ins-subtype-${increment}" hidden value="${act_adminis_desid}"></td>
		<td>${n_acto}<input type="text" hidden name="n_acto[]" id="ins-pres-${increment}" value="${n_acto}"></td>
		<td>${area_10}<input type="text" hidden name="area_10[]" id="ins-pres-${increment}" value="${area_10}"></td>
		<td>${dura_comi}<input type="text" name="dura_comi[]" id="ins-type-${increment}" hidden value="${dura_comi}"></td>
		<td>${fecha_act}<input type="text" name="fecha_act[]" id="ins-type-${increment}" hidden value="${fecha_act}"></td>
		<td><input type="button" class="borrar" value="Eliminar" /></td>
		`;

		
	
		
		document.querySelector('#target_exp_10 tbody').appendChild(newRow);
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
