function agregar_ccnu_acc(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ccnu_accToCartTable(cells);

}

function remove_proy_acc() { 
	var row = this.parentNode.parentNode;
    document.querySelector('#target_req_acc tbody').removeChild(row);
	$("#organo_experi_empre_capa").val($("#organo_experi_empre_capa").data("default-value"));
	$("#actividad_experi_empre_capa").val($("#actividad_experi_empre_capa").data("default-value"));
    $("#desde_experi_empre_capa").val($("#desde_experi_empre_capa").data("default-value"));
    $("#hasta_experi_empre_capa").val($("#hasta_experi_empre_capa").data("default-value"));

	
}

function agregar_ccnu_accToCartTable(cells){
	var organo_experi_empre_capa = $("#organo_experi_empre_capa").val();
	var actividad_experi_empre_capa = $("#actividad_experi_empre_capa").val();
 	var desde_experi_empre_capa = $("#desde_experi_empre_capa").val();
	var hasta_experi_empre_capa = $("#hasta_experi_empre_capa").val();
     	
	if (organo_experi_empre_capa == '' || actividad_experi_empre_capa == '' || desde_experi_empre_capa == '' || hasta_experi_empre_capa == '' ){
		
		if (organo_experi_empre_capa== '') {
			document.getElementById("organo_experi_empre_capa").focus();
		}
		else if (actividad_experi_empre_capa =='') {
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
		<td>${actividad_experi_empre_capa}<input type="text" name="actividad_experi_empre_capa[]" id="ins-subtype-${increment}" hidden value="${actividad_experi_empre_capa}"></td>
		<td>${desde_experi_empre_capa}<input type="date" hidden name="desde_experi_empre_capa[]" id="ins-pres-${increment}" value="${desde_experi_empre_capa}"></td>
        <td>${hasta_experi_empre_capa}<input type="date" name="hasta_experi_empre_capa[]" id="ins-type-${increment}" hidden value="${hasta_experi_empre_capa}"></td>
		`;

		var cellremove_proy_accBtn = createCell();

		cellremove_proy_accBtn.appendChild(createremove_proy_accBtn())
		newRow.appendChild(cellremove_proy_accBtn);
		document.querySelector('#target_req_acc tbody').appendChild(newRow);
		$("#organo_experi_empre_capa").val($("#organo_experi_empre_capa").data("default-value"));
		$("#actividad_experi_empre_capa").val($("#actividad_experi_empre_capa").data("default-value"));

		$("#desde_experi_empre_capa").val('');
		$("#hasta_experi_empre_capa").val('');	

		$("#btn_guar_2").prop('disabled', true);
	}
}

function createremove_proy_accBtn() {
    var btnremove_proy_acc = document.createElement('button');
    btnremove_proy_acc.className = 'btn btn-xs btn-danger';
    btnremove_proy_acc.onclick = remove_proy_acc;
    btnremove_proy_acc.innerText = 'Descartar';
    return btnremove_proy_acc;
}

function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}
