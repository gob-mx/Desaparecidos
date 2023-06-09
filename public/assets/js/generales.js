function carga_archivo(div_contenedor,ruta,parametros){
	$('body').removeData();
	$('.tooltip').hide();
	$('body').addClass('m-page--loading-non-block');
	$('#'+div_contenedor).load(ruta,parametros, function(){
		$('body').removeClass('m-page--loading-non-block');
	});
}

function alerta(header,body){
	var modal =
	'<div class="modal fade" id="myModal" tabindex="-1" role="dialog"'+
		'aria-labelledby="myModalLabel" aria-hidden="true">'+
		'<div class="modal-dialog">'+
			'<div class="modal-content">'+
				'<div class="modal-header">'+
				  '<h4 class="modal-title" id="myModalLabel">'+header+'</h4>'+
					'<button type="button" class="close" data-dismiss="modal"+ aria-hidden="true">×</button>'+
				  '</div>'+
				'<div class="modal-body">'+
					''+ body +''+
				'</div>'+
				'<div class="modal-footer">'+
					'<button data-dismiss="modal" class="btn btn-ar btn-default" type="button">Cerrar</button>'+
				'</div>'+
			'</div>'+
		'</div>'+
	'</div>';
	$(modal).modal().on('shown.bs.modal',function(){
		//console.log(modal);
	}).on('hidden.bs.modal',function(){
		$(this).remove();
	});
}
$('body').on('focus','.date-picker',function(){
	$(this).datepicker({
							 language: "es",
							 format: "yyyy-mm-dd",
							 changeMonth: true,
							 changeYear: true,
							 autoclose: true,
							 todayHighlight:!0, orientation:"bottom left", templates: {
									 leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'
							 }
					 }).inputmask('yyyy-mm-dd');
});


$("body").on("change", "#auditar_fecha_alta", function(){
	  fecha = $(this).val();
		id_usuario = $(this).attr('data-function');
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: app_url + 'login/getAuditoriaUserDate/' + id_usuario + '/' + fecha,
			type: 'POST',
			dataType: 'json',
			beforeSend: function() {
					$("#register_logger_audit").html('<img id="preload_gear_audit" src="img/gears.svg">');
			},
			success: function(resp_success){
				  $("#register_logger_audit").html('');
					$.each(resp_success, function(a,b) {
							date = jQuery.trim(b.fecha_alta).substring(16, 11);
							$('.title_audit').html(fecha);
							$('#audit_count').html(a);
						  $('#register_logger_audit').append('<div class="m-timeline-2__item"><span class="m-timeline-2__item-time">' +	date + '</span><div class="m-timeline-2__item-cricle"><i class="fa fa-genderless m--font-danger"></i></div><div class="m-timeline-2__item-text  m--padding-top-5">' + b.descripcion + '<br><br></div></div>' );
					});
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red GRAL-02');}
		});

});


$('body').on('focus','.date-time-picker',function(){
	$(this).datetimepicker({
						 language: "es",
						 format: "yyyy-mm-dd hh:ii",
						 autoclose: true,
					 })
});


function sweetConfirm(options,callback){
  swal({
      title: options.title,
      type:  options.type,
      html:  options.html,
      showCancelButton: true,
      showCloseButton: true,
      focusConfirm: false,
      cancelButtonText: '<i class="fa	fa-thumbs-o-down"></i>&nbsp;Cancelar',
      confirmButtonText: '<i class="fa	fa-thumbs-o-up"></i>&nbsp;Aceptar',
      confirmButtonAriaLabel: '',
      confirmButtonColor: '#4962b3',
      cancelButtonColor: '#d33',
    }).then(function (confirma) {
        if(confirma){
          callback();
        }
      });
}

function modalConfirm(callback,options){

	if(typeof options=='undefined'){
		options = {title:"¿Desea guardar el contenido?",type:"question",messageTrue:"Se guardo correctamente!",html:"",contentTrue:""}
	}

	  var options = {
	    title: (typeof options.title!='undefined')?options.title:"¿Desea guardar el contenido?",
	    type:  (typeof options.type!='undefined')?options.type:"question",
	    html:  (typeof options.html!='undefined')?options.html:"",
	    messageTrue: (typeof options.messageTrue!='undefined')?options.messageTrue:"Se guardó correctamente!",
	    contentTrue: (typeof options.contentTrue!='undefined')?options.contentTrue:""
	  }
	  sweetConfirm(options,function (){
	      if (typeof callback === "function") {
	        callback();
	      }
	  });
}
/**
 * Funcion general para limpiar combos de tipo Select2
 *
 */
function clearComboSelect2(id){
	$("#"+id).html('').select2({
		width: '100%',
		placeholder: {
			id: '-1', // the value of the option
			text: 'Seleccione una opción'
		}
	});
	 $("#"+id).append($('<option>',
		 {
				value: '-1',
				text : 'Seleccione una opcion'
		}));
}
/**
 * Funcion que Carga el contenido dentro de un tab
 * @return {[type]} [description]
 */
$('body').on('click','.load_tab_content',function(){
		var cotainer = $(this).data('container');
		var url =  $(this).data('url_content');
		carga_archivo(cotainer,url);
});


 /*
  * Mascara para validacion de numeros enteros, agregar etiqueta data-number="min|max", acepta números negativos
  *
  */
$("body").on("focus", "[data-number]", function() {
	var min_max = $(this).data('number');
	var min=0,max=1000;
	if(min_max!=''){
		obten_mm = min_max.split("|");
		min = parseInt(obten_mm[0]);
		max = parseInt(obten_mm[1]);
	}

	var allowMinus = (min<0)?true:false;

	$(this).inputmask({alias: 'numeric',
                     allowMinus: allowMinus,
                     digits: 0,
										 integerDigits:3,
										 min: -190,
                     max: max,rightAlign: false,
										 onKeyDown: function(event, buffer, caretPos, opts) {
																 var currentValue = buffer.length == 2 ? buffer[0] : "";
								        				 if (currentValue === "-" && (event.key === "Decimal" || event.key === ".")) {
								        						 $(event.currentTarget).val('-0..');
								      					 }
 							 	                  if(event.currentTarget.value > max || event.currentTarget.value < min){
 							 	                    $(event.currentTarget).val('');
 							 	                  }
 							 	   					 }
										});
});


$("body").on("focus", "[data-only_digit]", function() {
		$(this).inputmask('Regex', {regex: "[0-9]+$"});
});
/*
 * Mascara para validacion de numeros con digito, agregar etiqueta data-number_dec="min|max"
 *
 */

$("body").on("focus", "[data-number_dec]", function() {
	 var min_max = $(this).data('number_dec');
	 var num_dig_dat = $(this).data('number_dec_dig');
	 var min=0,max=1000,num_dig=1;

	 if(min_max!=''){
		 obten_mm = min_max.split("|");
		 min = parseFloat(obten_mm[0]);
		 max = parseFloat(obten_mm[1]);
	 }
	 if(num_dig_dat!=''){num_dig = num_dig_dat;}
	 var allowMinus = (min<0)?true:false;

   $(this).inputmask("decimal", { min: min, max: max, allowMinus: allowMinus, digits: num_dig, integerDigits: 3,
		 onKeyDown: function(event, buffer, caretPos, opts) {
	                  if(event.currentTarget.value > max){
	                    $(event.currentTarget).val('');
	                  }
	   					 }
	 });

});

$("body").on("focus", "[data-letter]", function() {
	$(this).inputmask('Regex', {regex: "[a-zA-ZñÑ]"});
});


function elimina_objeto_id(id){
	$("#"+id).remove();
}

function carga_modal_servicios(container,controlador){
	var id_persona = $('#id_persona_left').val();
	carga_archivo(container,controlador+id_persona);
}
function carga_servicios_episodio(container,controlador){
	var id_episodio = $('#id_episodio_left').val();
	carga_archivo(container,controlador+id_episodio);
}
function deshabilita_dependiente_check(dependiente,check){
	if($('input:checkbox[name='+check+']:checked').val()==1)
	{
		// limpia y deshabilita objeto
		$("#"+dependiente).val('');
		$("#"+dependiente).prop('disabled', true);
	}else{
		// habilita objeto
		$("#"+dependiente).prop('disabled', false);
	}
}

function habilita_dependiente_check(dependiente,check){
	if($('input:checkbox[name='+check+']:checked').val()==1)
	{
		// habilita objeto
		$("#"+dependiente).prop('disabled', false);
	}else{
		// limpia y deshabilita objeto
		$("#"+dependiente).val('');
		$("#"+dependiente).prop('disabled', true);
	}
}



/**
 *  validarCURP: Form Alta Paciente
 *  Boton: Se ejecuta como validacion antes de guardar
 *  Descripcion: Hace una validacion en base a las reglas establecidas por RENAPO para la generacion de CURP
 * @type ID-curp
 */

 function validarCURP(input) {
     var curp = input.value.toUpperCase(),
         resultado = document.getElementById("resultado"),
         valido = "<i class='fa fa-times red'></i>";

     if (curpValida(curp)) { // ⬅️ Acá se comprueba
     	   valido = "<i class='fa fa-check green'></i>";
     }
		 $("#resultado").html(valido);
 }

function curpValida(curp) {
    var re = /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        validado = curp.match(re);

    if (!validado)  //Coincide con el formato general?
    	return false;

    //Validar que coincida el dígito verificador
    function digitoVerificador(curp17) {
        //Fuente https://consultas.curp.gob.mx/CurpSP/
        var diccionario  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ",
            lngSuma      = 0.0,
            lngDigito    = 0.0;
        for(var i=0; i<17; i++)
            lngSuma = lngSuma + diccionario.indexOf(curp17.charAt(i)) * (18 - i);
        lngDigito = 10 - lngSuma % 10;
        if (lngDigito == 10) return 0;
        return lngDigito;
    }

    if (validado[2] != digitoVerificador(validado[1]))
    	return false;

    return true; //Validado
}


/**
 *  validarRFC: Form Alta Paciente
 *  Boton: Se ejecuta como validacion antes de guardar
 *  Descripcion: Hace una validacion en base a las reglas establecidas por el SAT para la generacion de RFC
 * @type ID-rfc
 */

function validarRFC(input) {
    var rfc = input.value.trim().toUpperCase(),
		    resultado = document.getElementById("resultado2"),
        valido = "<i class='fa fa-times red'></i>";

				if (rfcValido(rfc)) { // ⬅️ Acá se comprueba
	      	   valido = "<i class='fa fa-check green'></i>";
	      }
	 		 $("#resultado2").html(valido);
}

function rfcValido(rfc, aceptarGenerico = true) {
    //const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
		const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)? ?(?:([A-Z\d]{2})([A\d]) ?)?$/;
    var   validado = rfc.match(re);


    if (!validado)  //Coincide con el formato general del regex?
        return false;

    //Separar el dígito verificador del resto del RFC
    const digitoVerificador = validado.pop(),
          rfcSinDigito      = validado.slice(1).join(''),
          len               = rfcSinDigito.length,

    //Obtener el digito esperado
          diccionario       = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
          indice            = len + 1;
    var   suma,
          digitoEsperado;

					console.log("RFC sin Digito: " + rfcSinDigito);
					console.log("Len: " + len);


    if (len == 12) suma = 0
    else suma = 481; //Ajuste para persona moral

    for(var i=0; i<len; i++)
				console.log("Indice: "+indice);
				console.log(diccionario.indexOf(rfcSinDigito.charAt(i)));
				//console.log("Valor del Indice: "+(indice - i));
        suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
    digitoEsperado = 11 - suma % 11;
    if (digitoEsperado == 11) digitoEsperado = 0;
    else if (digitoEsperado == 10) digitoEsperado = "A";
		console.log(digitoEsperado);

    //El dígito verificador coincide con el esperado?
    // o es un RFC Genérico (ventas a público general)?
    /*if ((digitoVerificador != digitoEsperado)
     && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
        return false;
    else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
        return false;*/
    return rfcSinDigito + digitoVerificador;
}

function decimales(obj){
  var cadena = $('#'+obj).val();
  var patron = /([0-9]+[\.][0-9])/;

  if(patron.test(cadena)==false){
    $('#'+obj).get(0).value="";
  }
}

function resalta_seleccionado(id){
	$(".gli").css("color","#5867dd");
	$("#"+id).css("color","#06091f");
}

/**
 * Funcion que habilita o deshabilita un campo en base a la respuesta de otro (SI/NO) de tipo checked, limpia el contenido del campo habilitado
 * en caso de evaluar no.
 * @return {[type]} [description]
 */


 $("body").on("click", "[data-enable_input]", function() {
		 var input = $(this).data('enable_input');
	    if($(this).prop('checked')){
	       $('#'+input).prop('readonly', false).focus();
				 $('#'+input).prop('disabled', false).focus();
	    }else{
	      $('#'+input).prop('readonly', true).val('');
	    }
 });

 $("body").on("change", "[data-unblock_by_id]", function() {
	 var input = $(this).data('unblock_by_id');
	 var value_unblock = $(this).data('value_unblock');
		if($(this).val() == value_unblock){
			 $('#'+input).prop('disabled', false);
		}else{
			$('#'+input).prop('disabled', true).val('');
		}
 });

 $("body").on("change", "[data-block_by_id]", function() {

	 var input = $(this).data('block_by_id');
	 var value_block = $(this).data('value_block');

		if($(this).val() == value_block){
			 $('#'+input).prop('disabled', true).val('');
		}else{
				$('#'+input).prop('disabled', false);
		}
 });

$("body").on("focus", "[data-set_max_word]", function() {
		var modo_max = Number($(this).data('set_max_word'));
		$(this).maxlength({threshold: modo_max,warningClass:"m-badge m-badge--primary m-badge--rounded m-badge--wide",limitReachedClass:"m-badge m-badge--brand m-badge--rounded m-badge--wide",appendToParent:!0});
});

$("body").on("click", ".modal_dir", function() {
		iden = $(this).attr('data-iden');
		id = $(this).attr('data-id');
		hidden = $(this).attr('data-hidden');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'direcciones/modal_dir/' + iden + '/' + id + '/' + hidden ,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					  $(modal).modal().on('shown.bs.modal',function(){
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red GRAL-03');}
			});
});

$("body").on("click", ".cp_search", function() {
	    cp = $("#codigo_postal").val();

			var msj_error="";
			if( cp == "" )	msj_error+='Ingrese el código postal a buscar.<br />';

			if( !msj_error == "" ){
				alerta('Faltan datos', msj_error);
				return false;
			}

			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'direcciones/cp_search/' + cp ,
				type: 'POST',
				dataType: 'html',
				success: function(resp_success){
						$("#asentamiento").html(resp_success);
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red GRAL-04');}
			});
});


$("body").on("change", "#asentamiento", function() {
	id_cp = $("#asentamiento").val();
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'direcciones/get_all/' + id_cp ,
		type: 'POST',
		dataType: 'json',
		success: function(resp_success){
			$('#estado').val(resp_success['estado']);
			$('#municipio').val(resp_success['municipio']);
			$('#ciudad').val(resp_success['ciudad']);
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red GRAL-04');}
	});
});

$("body").on("click", "#gral_js_fn_01", function() {

			var msj_error="";
			if( $("#asentamiento").val() == "" )	msj_error+='Seleccione el asentamiento.<br />';
			if( $("#calle").val() == "" )	msj_error+='Escriba la calle de la dirección.<br />';
			if( $("#num_ext").val() == "" )	msj_error+='Escriba el número exterior.<br />';

			if( !msj_error == "" ){
				alerta('Faltan datos', msj_error);
				return false;
			}

			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'direcciones/insert',
				type: 'POST',
				dataType: 'json',
				data: $("#direccion").serialize(),
				success: function(resp_success){
					$('#' + $("#id").val()).val($("#calle").val() + ' ' + $("#num_ext").val() + ' ' + $('select[name="asentamiento"] option:selected').text());
					$('#' + $("#hidden").val()).val(resp_success['id_direccion']); //se carga con el identificador del nuevo insert
					$('#address_form').modal('hide');
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red GRAL-04');}
			});
});

$("body").on("click", ".portlet_dir", function() {
			dir_id = $(this).attr('data-dir_id');
			$('#' + $("#id").val()).val($(this).attr('data-dir_calle') + ' ' + $(this).attr('data-dir_num_ext') + ' ' + $(this).attr('data-dir_asentamiento'));
			$('#' + $("#hidden").val()).val(dir_id); //se carga con el identificador guardado
			$('#address_form').modal('hide');
});

$("body").on("click", "#add_nueva_dir", function() {

			$("#dir_exist").css({'display':'none'});
			$("#direccion").css({'display':''});
			$("#footer_dir").css({'display':''});

});

$("body").on("click", "#add_exist_dir", function() {

			$("#dir_exist").css({'display':''});
			$("#direccion").css({'display':'none'});
			$("#footer_dir").css({'display':'none'});

});

function validarEmail(input) {
	var mail = input.value.trim().toLowerCase(),
		  valido = "<i class='fa fa-times red'></i>";

		if (emailValida(mail)) { // ⬅️ Acá se comprueba
				valido = "<i class='fa fa-check green'></i>";
		}
		$("#resultado3").html(valido);
}

function emailValida(mail) {
	 var re       = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/,
			 validado = String(mail).match(re);

	 if (!validado)  //Coincide con el formato general?
		 return false;

	 return true; //Validado
}

function validarE_firma(input) {
	var sign = input.value.trim(),
		  valido = "<i class='fa fa-times red'></i>";

		if (efirmaValida(sign)) { // ⬅️ Acá se comprueba
				valido = "<i class='fa fa-check green'></i>";
		}
		$("#resultado4").html(valido);
}

function efirmaValida(sign) {
	 var re       = /^\d{20}$/,
			 validado = sign.match(re);

	 if (!validado)  //Coincide con el formato general?
		 return false;

	 return true; //Validado
}

function validarTel(input) {
	console.log(input);
	var tel = input.value.trim(),
		  valido = "<i class='fa fa-phone red'></i>";

		if (telValida(tel)) { // ⬅️ Acá se comprueba
				valido = "<i class='fa fa-phone green'></i>";
		}
		$("#resultado5").html(valido);
}

function telValida(tel) {
	 var re       = /^\d{10}$/,
			 validado = tel.match(re);

	 if (!validado)  //Coincide con el formato general?
		 return false;

	 return true; //Validado
}

function validarClabe(input) {
	var clabeNum = input.value.trim(),
	    clabeCheck = clabe.validate(clabeNum),
		  valido = "<i class='fa fa-money-bill-alt red'></i>";
			$("#banco").val(clabeCheck.bank);
			$("#bank_id").val(clabeCheck.code.bank);
		if (clabeCheck.ok) { // ⬅️ Acá se comprueba
				valido = "<i class='fa fa-money-bill-alt green'></i>";
		}
		$("#resultado6").html(valido);
}

function clabeValida(clabeNum) {
	    clabeNum = clabeNum.trim();
	    clabeCheck = clabe.validate(clabeNum);
			return clabeCheck.ok;
}

$("body").on("change", ".pais", function() {
  id_estado = $(this).attr('data-estado');
  estado = $("#" + id_estado).val();
	pais = $("#" + $(this).attr('data-pais')).val();
  ciudad = $(this).attr('data-change');
  $('#'+ciudad).html('');
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'direcciones/get_estados/' + pais ,
		type: 'POST',
		dataType: 'html',
		success: function(resp_success){
			$('#' + id_estado).html(resp_success);
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-05');}
	});
});

$("body").on("change", ".estado", function() {
	estado = $("#" + $(this).attr('data-estado')).val();
	pais = $("#" + $(this).attr('data-pais')).val();
  ciudad = $(this).attr('data-change');
	$.ajax({
		headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url: 'direcciones/get_ciudades/' + pais + '/' + estado ,
		type: 'POST',
		dataType: 'html',
		success: function(resp_success){
			$('#' + ciudad).html(resp_success);
		},
		error: function(respuesta){ alerta('Alerta!','Error de conectividad de red SOL-05');}
	});
});
