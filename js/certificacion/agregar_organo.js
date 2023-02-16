function agregar_ccnu_acc(button) {
	var row = button.parentNode.parentNode;
  	var cells = row.querySelectorAll('td:not(:last-of-type)');
  	agregar_ccnu_accToCartTable(cells);

}

function remove_proy_acc() { 
	var row = this.parentNode.parentNode;
    document.querySelector('#target_req_acc tbody').removeChild(row);
	$("#organo").val($("#organo").data("default-value"));
	$("#actividad").val($("#actividad").data("default-value"));
    $("#desde").val($("#desde").data("default-value"));
    $("#hasta").val($("#hasta").data("default-value"));

	
}

function agregar_ccnu_accToCartTable(cells){
	var organo = $("#organo").val();
	var actividad = $("#actividad").val();
 	var desde = $("#desde").val();
	var hasta = $("#hasta").val();
     	
	if (organo == '' || actividad == '' || desde == ''  ){

		if (organo== '') {
			document.getElementById("organo").focus();
		}
		else if (actividad =='') {
			document.getElementById("actividad").focus();
		}
		else if (desde == '') {
			document.getElementById("desde").focus();
		}
        else if (hasta == '') {
			document.getElementById("hasta").focus();
		}
		
	}else{
		var newRow = document.createElement('tr');
		var increment = increment +1;
		newRow.className='myTr';
		newRow.innerHTML = `
		<td>${organo}<input type="text" name="organo[]" id="ins-type-${increment}" hidden value="${organo}"></td>
		<td>${actividad}<input type="text" name="actividad[]" id="ins-subtype-${increment}" hidden value="${actividad}"></td>
		<td>${desde}<input type="date" hidden name="desde[]" id="ins-pres-${increment}" value="${desde}"></td>
        <td>${hasta}<input type="date" name="hasta[]" id="ins-type-${increment}" hidden value="${hasta}"></td>
		`;

		var cellremove_proy_accBtn = createCell();

		cellremove_proy_accBtn.appendChild(createremove_proy_accBtn())
		newRow.appendChild(cellremove_proy_accBtn);
		document.querySelector('#target_req_acc tbody').appendChild(newRow);
		$("#organo").val($("#organo").data("default-value"));
		$("#actividad").val($("#actividad").data("default-value"));

		$("#desde").val('');
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
