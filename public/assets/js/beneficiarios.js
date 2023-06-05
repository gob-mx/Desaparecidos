$("body").on("click", "#ben_js_fn_01", function() {
    id_solicitud = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'beneficiarios/modal_add_beneficiario/' + id_solicitud,
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
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red BEN-01');}
		});
});

$("body").on("click", ".ben_js_fn_02", function() {
    id_beneficiario = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'beneficiarios/modal_edit_beneficiario/' + id_beneficiario,
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
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red BEN-01');}
		});
});

var SweetAlert2Benefit = {
    init: function() {
        $(".ben_js_fn_03").click(function(e) {
            id_beneficiario = $(this).attr('data-function');
            name = $(this).attr('data-name');
            swal({
                title: "Acción Irreversible",
                text: "¿Está usted seguro de eliminar a " + name + "?",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                reverseButtons: !0
            }).then(function(e) {
               if(e.value != true){
                 delete_beneficiario(name, id_beneficiario);
               }
            })
        })
    }
};
function delete_beneficiario(name, id_beneficiario) {
    $.ajax({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: 'beneficiarios/delete/' + id_beneficiario,
      dataType: 'json',
      type: 'POST',
        success: function(resp_success){
          $('#beneficiarios').DataTable().ajax.reload();
          swal("Eliminado!", "El beneficiario "+name+" fué elimiando.", "success")
        },
      error: function(respuesta){ alerta('Alerta!','Error de conectividad de red BEN-02');}
    });
};


$("body").on("click", "#ben_js_fn_04", function() {
	var msj_error="";
	if( $('#paterno').val() == "" )	msj_error+='&bull;&nbsp;Ingrese al apellido paterno.<br />';
	if( $('#materno').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el apellido materno.<br />';
	if( $('#nombre').val() == "" )	msj_error+='&bull;&nbsp;Ingrese su nombre o nombres.<br />';
	if( $('#parentesco').val() == 88 )	msj_error+='&bull;&nbsp;Seleccione el parentesco.<br />';


	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'beneficiarios/editBeneficiario' ,
			type: 'POST',
			data: $("#beneficiario_edit").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success) {
            console.log(resp_success);
						$('#beneficiarios').DataTable().ajax.reload();
            alerta('Noticia','Se editó el Beneficiario satisfactoriamente');
            $('#modaleditbenefit').modal('hide');
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red BEN-07');}
		});

});


$("body").on("click", "#ben_js_fn_05", function() {
	var msj_error="";
	if( $('#paterno').val() == "" )	msj_error+='&bull;&nbsp;Ingrese al apellido paterno.<br />';
	if( $('#materno').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el apellido materno.<br />';
	if( $('#nombre').val() == "" )	msj_error+='&bull;&nbsp;Ingrese su nombre o nombres.<br />';
	if( $('#parentesco').val() == 88 )	msj_error+='&bull;&nbsp;Seleccione el parentesco.<br />';


	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'beneficiarios/addBeneficiario' ,
			type: 'POST',
			data: $("#beneficiario_form").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success) {
            console.log(resp_success);
						$('#beneficiarios').DataTable().ajax.reload();
            alerta('Noticia','Se creó el nuevo Beneficiario satisfactoriamente con el identificador '+ resp_success['beneficiario']);
            $('#myModaladdbenefit').modal('hide');
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red BEN-07');}
		});

});

$("body").on("click", "#ben_js_fn_06", function() {
	var msj_error="";
	if( $('#id_direccion').val() == "" )	msj_error+='&bull;&nbsp;Falta ingresar la dirección del beneficiario.<br />';
	if( $('#id_dom_4').val() == "" )	msj_error+='&bull;&nbsp;Falta ingresar la dirección del beneficiario.<br />';
	if( $('#id_pais_nacimiento').val() == "")	msj_error+='&bull;&nbsp;Falta Ingresar el país de nacimiento.<br />';
	if( $('#id_pais_residencia').val() == "" )	msj_error+='&bull;&nbsp;Seleccione el país de residencia.<br />';
  if( $('#id_nacionalidad').val() == "" )	msj_error+='&bull;&nbsp;Seleccione cual es su Nacionalidad.<br />';
	if( $('#ap_paterno').val() == "" )	msj_error+='&bull;&nbsp;Ingrese al apellido paterno.<br />';
	if( $('#ap_materno').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el apellido materno.<br />';
	if( $('#nombres').val() == "" )	msj_error+='&bull;&nbsp;Ingrese su nombre o nombres.<br />';
	if( $('#parentesco').val() == "" )	msj_error+='&bull;&nbsp;Seleccione el parentesco.<br />';
	if( $('#fecha_nac').val() == "" )	msj_error+='&bull;&nbsp;Ingrese su fecha de nacimiento.<br />';
	if( $('#entidad_federativa_nac').val() == "" )	msj_error+='&bull;&nbsp;Ingrese el estado donde nació.<br />';
	if( $('#ocupacion').val() == "" )	msj_error+='&bull;&nbsp;Seleccione su ocupación.<br />';
	if( $('#giro_actividad').val() == "" )	msj_error+='&bull;&nbsp;Ingrese su actividad.<br />';
	if( telValida($('#lada_telefono').val()) == false )	msj_error+='&bull;&nbsp;Ingrese su numero a 10 digitos válido.<br />';
	if( emailValida($('#email').val()) == false )	msj_error+='&bull;&nbsp;Ingrese un correo válido.<br />';
	if( curpValida($('#curp').val())==false )	msj_error+='&bull;&nbsp;Ingrese un CURP válido.<br />';
	if( rfcValido($('#rfc').val()) == false )	msj_error+='&bull;&nbsp;Ingrese un RFC válido.<br />';
	//if( efirmaValida($('#serie_e_firma').val()) == false )	msj_error+='&bull;&nbsp;Ingrese una e-firma válida.<br />';
  if($('#forma_pago').val() == 66){
    if( clabeValida($('#CLABE').val()) == false )	msj_error+='&bull;&nbsp;Ingrese una CLABE Interbancaria válida.<br />';
  	if( $('#bank_id').val() == "" )	msj_error+='&bull;&nbsp;Ingrese un Banco válido.<br />';
  	if( $('#banco').val() == "" )	msj_error+='&bull;&nbsp;Ingrese un Banco válido.<br />';
  }

	if( !msj_error == "" ){
		alerta('Faltan datos', msj_error);
		return false;
	}

		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'beneficiarios/datos_beneficiario',
			type: 'POST',
			data: $("#datos_beneficiario").serialize(),
			dataType: 'json',
			success: function(resp_success){
				if (resp_success) {
            swal("Actualizado!", "El beneficiario se actualizó.", "success");
						console.log(resp_success);
				}else{
					alerta_div('error_alerta',resp_success['mensaje'],resp_success['error']);
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red BEN-07');}
		});

});
