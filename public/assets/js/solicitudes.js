var BootstrapSpin1 = {
		init: function() {
				$(".spin_beneficiarios").TouchSpin({
						buttondown_class: "btn btn-secondary",
						buttonup_class: "btn btn-secondary",
						min: 1,
						max: 99,
						step: 1,
						decimals: 0,
						boostat: 5,
						maxboostedstep: 10
				})
		}
};

var BootstrapSpin2 = {
		init: function() {
				$(".spin_antiguedad").TouchSpin({
						buttondown_class: "btn btn-secondary",
						buttonup_class: "btn btn-secondary",
						min: 0,
						max: 99,
						step: 1,
						decimals: 0,
						boostat: 5,
						maxboostedstep: 10
				})
		}
};

$("body").on("click", "#sol_js_fn_01", function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'solicitudes/modal_add_solicitud',
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						BootstrapSpin1.init();
						$('#wzd_js_fn_03').prop('disabled', true);
						$("#titular").on("click", function() {
							if( $('#titular').prop('checked') ) {
								$('#beneficiarios').prop('disabled', true);
								$('#beneficiarios').val('1');
							}else {
								$('#beneficiarios').prop('disabled', false);
							}
						});
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-01');}
		});
});

$("body").on("click", "#sol_js_fn_02", function() {
	var msj_error="";
	if(( $("#nombre").val() == "" || $("#paterno").val() == "" || $("#materno").val() == "") && ( $("#rfc").val() == "")){
		msj_error='Es necesario que ingrese los valores para el nombre completos o bien el RFC';
	}


	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'solicitudes/buscar',
		type: 'POST',
		data: $("#solicitud").serialize(),
		dataType: 'json',
			success: function(resp_success){
				$('#nombre').val(resp_success['nombre']);
				$('#paterno').val(resp_success['paterno']);
				$('#materno').val(resp_success['materno']);
				$('#rfc').val(resp_success['rfc']);
				$('#id_poliza').val(resp_success['id_poliza']);
				if(resp_success['success']){
					$('#sol_js_fn_03').prop('disabled', false);
				}
			},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-02');}
	});
});

$("body").on("click", "#sol_js_fn_03", function() {
	var msj_error="";
	if( $("#nombre").val() == "" )	msj_error+='Olvidó ingresar Nombre.<br />';
	if( $("#paterno").val() == "")	msj_error+='Olvidó ingresar el apellido paterno.<br />';
	if( $("#materno").val() == "")	msj_error+='Olvidó ingresar el apellido materno.<br />';
	if( $("#rfc").val() == "")	msj_error+='Olvidó ingresar el RFC.<br />';
	if( $("#beneficiarios").val() == "")	msj_error+='Olvidó ingresar el número de beneficiarios.<br />';
	if( $("#forma_pago").val() == "")	msj_error+='Olvidó seleccionar la forma de pago.<br />';
	if( $("#id_poliza").val() == "")	msj_error='Error de en el modulo de alta clave de error SOL-06';


	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'solicitudes/insertar',
		type: 'POST',
		data: $("#solicitud").serialize(),
		dataType: 'json',
			success: function(resp_success){
				if(resp_success['success']){
					$('#sol_js_fn_03').prop('disabled', true);
					$('#sol_js_fn_02').prop('disabled', true);
					$('#solicitudes').DataTable().ajax.reload();
					alerta('Noticia','Se creó la nueva solicitud satisfactoriamente con el identificador ' + resp_success['id']);
					$('#myModal').modal('hide');
				}
			},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-03');}
	});

});

$("body").on("click", "#sol_js_fn_04", function() {
	  id_solicitud = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'solicitudes/modal_edit_solicitud/' + id_solicitud,
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						BootstrapSpin1.init();
						$('#wzd_js_fn_03').prop('disabled', true);
						$("#titular").on("click", function() {
							if( $('#titular').prop('checked') ) {
								$('#beneficiarios').prop('disabled', true);
								$('#beneficiarios').val('1');
							}else {
								$('#beneficiarios').prop('disabled', false);
							}
						});
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-04');}
		});
});

$("body").on("click", "#sol_js_fn_05", function() {
	var msj_error="";
	if( $('#id_domicilio_cuando_fallecio').val() == "" )	msj_error+='&bull;&nbsp;Falta ingresar el último domicilio del finado.<br />';
	if( $('#id_dom_1').val() == "" )	msj_error+='&bull;&nbsp;Falta ingresar el último domicilio del finado.<br />';
	if( $('#pais_as').val() == "" || $('#entidad_as').val() == "" || $('#ciudad_nac').val() == "")	msj_error+='&bull;&nbsp;Falta Ingresar cual fué su ciudad de nacimiento.<br />';
	if( $('#nacionalidades').val() == "" )	msj_error+='&bull;&nbsp;Seleccione cual fué su Nacionalidad.<br />';
	if( curpValida($('#curp').val())==false )	msj_error+='&bull;&nbsp;Ingrese un CURP válido.<br />';
	if( $('#no_polizas').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el número de poliza.<br />';
	if( $('#tipo_seguro').val() == "" )	msj_error+='&bull;&nbsp;Seleccione el tipo de seguro.<br />';
	if( $('#grupo_y_colectivo').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el Grupo y/o Colectivo.<br />';
	if( $('#no_certificado').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el número de certificado.<br />';
	if( $('#afiliacion_imss_issste').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el número de afiliacion al IMSS o ISSSTE.<br />';
	if( $('#ocupacion').val() == "" )	msj_error+='&bull;&nbsp;Seleccione una ocupación.<br />';
	if( $('#empresa_trabajo').val() == "" )	msj_error+='&bull;&nbsp;Ingrese la Empresa donde trabajaba.<br />';
	if( $('#antiguedad_en_empresa').val() == "" )	msj_error+='&bull;&nbsp;Ingrese la antiguedad en la empresa.<br />';
	if( $('#id_domicilio_empresa').val() == "" )	msj_error+='&bull;&nbsp;Seleccione el domiciloio de la empresa.<br />';
	if( $('#id_dom_2').val() == "" )	msj_error+='&bull;&nbsp;Seleccione el domiciloio de la empresa.<br />';
	if( $('#otras_empresas').val() == "" )	msj_error+='&bull;&nbsp;Seleccione en que otras empresas trabajaba.<br />';
	if( $('#pais_fall').val() == "" || $('#entidad_fall').val() == "" || $('#id_lugar').val() == "")	msj_error+='&bull;&nbsp;Ingrese la ciudad donde falleció.<br />';
	if( $('#cat_edificio_fallecimiento').val() == "" )	msj_error+='&bull;&nbsp;Seleccione el Lugar de Fallecimiento.<br />';
	if( $('#fecha_fallecimiento').val() == "" )	msj_error+='&bull;&nbsp;Ingrese la fecha de fallecimiento.<br />';
	if( $('#causa_fallecimiento').val() == "" )	msj_error+='&bull;&nbsp;Ingrese la causa del fallecimiento.<br />';
	if( $('#agencia_servicio_funerario').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el nombre de la agencia de servicios funerarios que le atendió.<br />';
	if( $('#fecha_servicios_funerarios').val() == "" )	msj_error+='&bull;&nbsp;Ingrese la fecha en que se ofrecieron los servicio funerarios.<br />';
	//if( $('#autoridad_tomo_hechos_violentos').val() == "" )	msj_error+='XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.<br />';
	if( $('#id_solicitud').val() == "" )	msj_error+='&bull;&nbsp;Ocurrio Un error grave en el procesamiento de la solicitud ERROR SOL-05.<br />';

	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'solicitudes/datos_asegurado',
			type: 'POST',
			data: $("#datos_asegurado").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success) {
					  swal("Actualizado!", "Se actualizó la solicitud.", "success");
						console.log(resp_success);
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-07');}
		});

});

$("body").on("click", ".sol_js_fn_06", function() {
	  id_solicitud = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'solicitudes/modal_crm/' + id_solicitud,
			dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						const scroll_content = document.querySelector('#container_scroll');
            const ps = new PerfectScrollbar(scroll_content);
						scroll_content.style.height = '300px';
						scroll_content.scrollTop = 100000;
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-08');}
		});
});


$("body").on("click", "#sol_js_fn_07", function() {
	var msj_error="";
	if( $('#mensaje').val() == "" )	msj_error+='&bull;&nbsp;El mensaje esta vacío.<br />';
	if( $('#id_solicitud').val() == "" )	msj_error+='&bull;&nbsp;Ocurrio Un error grave en el procesamiento de la solicitud ERROR SOL-07.<br />';

	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'solicitudes/add_mensaje',
			type: 'POST',
			data: $("#crm").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success) {
					  $("#appender").append('<div class="m-widget3__item">' +
																	'<div class="m-widget3__header">' +
																	'<div class="m-widget3__user-img">' +
																	'<img class="m-widget3__img" src="plugs/timthumb.php?src=' +
																	resp_success['image'] +
																	'&w=42&h=42&a=t" alt="">' +
																	'</div>' +
																	'<div class="m-widget3__info">' +
																	'<span class="m-widget3__username">' +
																	resp_success['usuario'] +
																	'</span><br>' +
																	'<span class="m-widget3__time">' +
																	resp_success['insert_time'] +
																	'</span>' +
																	'</div>' +
																	'<span class="m-widget3__status m--font-' +
																	//resp_success['class'] +
																	'">' +
																	//resp_success['status_crm'] +
																	'</span>' +
																	'</div>' +
																	'<div class="m-widget3__body">' +
																	'<p class="m-widget3__text">' +
																	resp_success['mensaje'] +
																	'</p>' +
																	'</div>' +
																	'</div>'
																	);
						const scroll_content = document.querySelector('#container_scroll');
						scroll_content.scrollTop = 10000;
						console.log(resp_success);
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-07');}
		});

});
