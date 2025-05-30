function consultar_rif() {
	var rif_b = $("#rif_b").val();
	if ($.fn.DataTable.isDataTable('#data1')) {
        $('#data1').DataTable().destroy();
    }
	if ($.fn.DataTable.isDataTable('#data2')) {
        $('#data2').DataTable().destroy();
    }
	//  var base_url =window.location.origin+'/asnc/index.php/evaluacion_desempenio/graficos';
	//  var base_url2 =window.location.origin+'/asnc/index.php/evaluacion_desempenio/inf_tabla';
	//  var base_url3 =window.location.origin+'/asnc/index.php/evaluacion_desempenio/inf_tabla2';

	var base_url = "/index.php/evaluacion_desempenio/graficos";
	var base_url2 = "/index.php/evaluacion_desempenio/inf_tabla";
	var base_url3 = "/index.php/evaluacion_desempenio/inf_tabla2";

	$.ajax({
		url: base_url,
		method: "POST",
		data: { rif_b: rif_b },
		dataType: "json",
		success: function (data) {
			if(data != ''){
				$("#grafico").show();
				$("#mensaje").show();

				var t_calificacion = [];
				var calificacion = [];
				var color = [
					"rgba(224,221,1)",
					"rgba(0,208,79)",
					"rgba(0,194,199, 1)",
					"rgba(224,126,1)",
					"rgba(224,1,1)",
				];
				var bordercolor = [
					"rgba(224,221,1)",
					"rgba(0,208,79)",
					"rgba(0,194,199, 1)",
					"rgba(224,126,1)",
					"rgba(224,1,1)",
				];
	
				for (var i in data) {
					t_calificacion.push(data[i].t_calificacion);
					calificacion.push(data[i].calificacion);
				}
	
				var chartdata = {
					labels: calificacion,
					datasets: [
						{
							label: calificacion,
							backgroundColor: color,
							borderColor: color,
							borderWidth: 2,
							hoverBackgroundColor: color,
							hoverBorderColor: bordercolor,
							data: t_calificacion,
						},
					],
				};
	
				var mostrar = $("#miGrafico");
				var grafico = new Chart(mostrar, {
					type: "doughnut",
					data: chartdata,
					options: {
						animation: {
							duration: 500,
							easing: "easeOutQuart",
							onComplete: function () {
								var ctx = this.chart.ctx;
								ctx.font = Chart.helpers.fontString(
									Chart.defaults.global.defaultFontFamily,
									"normal",
									Chart.defaults.global.defaultFontFamily
								);
								ctx.textAlign = "center";
								ctx.textBaseline = "bottom";
								this.data.datasets.forEach(function (dataset) {
									for (var i = 0; i < dataset.data.length; i++) {
										var model =
												dataset._meta[Object.keys(dataset._meta)[0]].data[i]
													._model,
											total = dataset._meta[Object.keys(dataset._meta)[0]].total,
											mid_radius =
												model.innerRadius +
												(model.outerRadius - model.innerRadius) / 2,
											start_angle = model.startAngle,
											end_angle = model.endAngle,
											mid_angle = start_angle + (end_angle - start_angle) / 2;
										var x = mid_radius * Math.cos(mid_angle);
										var y = mid_radius * Math.sin(mid_angle);
										ctx.fillStyle = "#000000";
										if (i == 3) {
											ctx.fillStyle = "#444";
										}
										var val = dataset.data[i];
										var percent = String(Math.round((val / total) * 100)) + "%";
										if (val != 0) {
											ctx.fillText(dataset.data[i], model.x + x, model.y + y);
											ctx.fillText(percent, model.x + x, model.y + y + 15);
										}
									}
								});
							},
						},
					},
				});
			}else{
				event.preventDefault();
				swal.fire({
					title: 'Es rif solicitado no posee registros en el Sistema Integrado',
					type: 'info',
					showCancelButton: false,
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'Ok'
				}).then((result) => {
					if (result.value == true) {
						$("#grafico").hide();
						//location.reload();
					}
				});
			}
		},
		error: function (data) {
			console.log(data);
		},
	});

	$.ajax({
		url: base_url2,
		method: "post",
		data: { rif_b: rif_b },
		dataType: "json",
		success: function (data) {
			$("#data1 tbody").empty();
			$.each(data, function (index, response) {
				$("#data1 tbody").append(
					"<tr><td>" +
						response["fecha_evaluacion"] +
						"</td><td>" +
						response["nombre_ente"] +
						"</td><td>" +
						response["objeto"] +
						"</td><td>" +
						response["nombre_calificacion"] +
						"</td></tr>"
				);
			});
			 $('#data1').DataTable({
                        "paging": true,
                        "pageLength": 10,
                        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
		},
	});
 

	$.ajax({
		url: base_url3,
		method: "post",
		data: { rif_b: rif_b },
		dataType: "json",
		success: function (data) {
			$("#data2 tbody").children().remove();
			$.each(data, function (index, response) {
				$("#data2 tbody").append(
					"<tr><td>" +
						response["fecha_evaluacion"] +
						"</td><td>" +
						response["nombre_ente"] +
						"</td><td>" +
						response["descr_contrato"] +
						"</td><td>" +
						response["nombre_calificacion"] +
						"</td></tr>"
				);
			});
			 $('#data2').DataTable({
                        "paging": true,
                        "pageLength": 2,
                        //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        dom: "Bfrtip",
                        buttons: [{
                            extend: "excel",
                            text: "Exportar Hoja de Cálculo"
                        }]
                    });
		},
	});
}
