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
    $("#hasta").val($("#hasta").data("default-value"));

	
}

function agregar_personaToCartTable(cells){
	var nombre_ape = $("#nombre_ape").val();
	var cedula = $("#cedula").val();
 	var rif = $("#rif").val();
	var hasta = $("#hasta").val();
     	
	if (nombre_ape == '' || cedula == '' || rif == ''  ){

		if (nombre_ape== '') {
			document.getElementById("nombre_ape").focus();
		}
		else if (cedula =='') {
			document.getElementById("cedula").focus();
		}
		else if (rif == '') {
			document.getElementById("rif").focus();
		}
        else if (hasta == '') {
			document.getElementById("hasta").focus();
		}
		
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${nombre_ape}<input type="text" name="nombre_ape[]" id="ins-type-${increment}" hidden value="${nombre_ape}"></td>
		<td>${cedula}<input type="text" name="cedula[]" id="ins-subtype-${increment}" hidden value="${cedula}"></td>
		<td>${rif}<input type="date" hidden name="rif[]" id="ins-pres-${increment}" value="${rif}"></td>
        <td>${hasta}<input type="date" name="hasta[]" id="ins-type-${increment}" hidden value="${hasta}"></td>
		`;

		var cellremove_proy_accBtn = createCell();

		cellremove_proy_accBtn.appendChild(createremove_proy_accBtn())
		newRow.appendChild(cellremove_proy_accBtn);
		document.querySelector('#target_persona tbody').appendChild(newRow);
		$("#nombre_ape").val($("#nombre_ape").data("default-value"));
		$("#cedula").val($("#cedula").data("default-value"));

		$("#rif").val('');
		$("#hasta").val('');	

		$("#btn_guar_2").prop('disabled', false);
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
