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
	if( $("#id_poliza").val() == "")	msj_error='Error de en el modulo de alta clave de error SOL-04';


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
