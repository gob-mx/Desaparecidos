$("body").on("click", "#tmz_js_fn_01", function() {
		$.ajax({
			headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: app_url + 'tamizaje/nuevo_tamizaje',
			type: 'POST',
			data: $('#nuevo_tamizaje').serialize() + '&' + $.param({'state':41}),
			dataType: 'json',
			success: function(resp_success){
        if (resp_success['resp'] == 'true') {
					swal({
							title: "Correcto!!",
							text: "Su avance se guardó",
							type: "success",
							confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
					})
				}else{
					swal({
							title: "Error",
							text: "Ocurrió un error al guardar el avance.",
							type: "error",
							confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
					})
				}
			},
			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red TZJ-02');}
		});
});

$("body").on("click", ".counter20", function(){
		var actual = $("#counter20").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter20").data('value',parseInt(opc));
});

$("body").on("click", ".counter19", function(){
		var actual = $("#counter19").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter19").data('value',parseInt(opc));
});

$("body").on("click", ".counter18", function(){
		var actual = $("#counter18").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter18").data('value',parseInt(opc));
});

$("body").on("click", ".counter17", function(){
		var actual = $("#counter17").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter17").data('value',parseInt(opc));
});

$("body").on("click", ".counter16", function(){
		var actual = $("#counter16").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter16").data('value',parseInt(opc));
});


$("body").on("click", ".counter15", function(){
		var actual = $("#counter15").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter15").data('value',parseInt(opc));
});

$("body").on("click", ".counter14", function(){
		var actual = $("#counter14").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter14").data('value',parseInt(opc));
});

$("body").on("click", ".counter13", function(){
		var actual = $("#counter13").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter13").data('value',parseInt(opc));
});

$("body").on("click", ".counter12", function(){
		var actual = $("#counter12").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter12").data('value',parseInt(opc));
});

$("body").on("click", ".counter11", function(){
		var actual = $("#counter11").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter11").data('value',parseInt(opc));
});


$("body").on("click", ".counter10", function(){
		var actual = $("#counter10").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter10").data('value',parseInt(opc));
});

$("body").on("click", ".counter9", function(){
		var actual = $("#counter9").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter9").data('value',parseInt(opc));
});

$("body").on("click", ".counter8", function(){
		var actual = $("#counter8").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter8").data('value',parseInt(opc));
});

$("body").on("click", ".counter7", function(){
		var actual = $("#counter7").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter7").data('value',parseInt(opc));
});

$("body").on("click", ".counter6", function(){
		var actual = $("#counter6").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter6").data('value',parseInt(opc));
});

$("body").on("click", ".counter5", function(){
		var actual = $("#counter5").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter5").data('value',parseInt(opc));
});

$("body").on("click", ".counter4", function(){
		var actual = $("#counter4").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter4").data('value',parseInt(opc));
});

$("body").on("click", ".counter3", function(){
		var actual = $("#counter3").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter3").data('value',parseInt(opc));
});

$("body").on("click", ".counter2", function(){
		var actual = $("#counter2").data('value');
		var opc = $(this).data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$("#counter2").data('value',parseInt(opc));
});


$("body").on("change", ".counter", function(){
		var actual = $(this).data('value');
		var opc = $(this).find(':selected').data('opc_valor');
		var valor = $('#counter').data('value');
		var new_val = (parseInt(valor)+parseInt(opc))-parseInt(actual);
		$('#counter').data('value',new_val);
		$("#counter").text(new_val);
		$(this).data('value',parseInt(opc));
});

$("body").on("click", "#sin_violencia", function(){
	var a = 0;
	var valor = $('#counter').data('value');
	$(".counter").each(function(){
				b = $(this).data('value');
				a = a + parseInt(b);
	});
	var new_val = valor - parseInt(a);
	$('#counter').data('value',new_val);
	$("#counter").text(new_val);
	$('.counter').data('value',parseInt(0));
});

var WizardTamizaje = function() {
    $("#m_wizard");
    var e, r, i = $("#nuevo_tamizaje");
    return {
        init: function() {
            var n;
            $("#m_wizard"),
            i = $("#nuevo_tamizaje"),
            (r = new mWizard("m_wizard",{
                startStep: 1
            })).on("beforeNext", function(r) {
                !0 !== e.form() && this.stop()
            }),
            r.on("change", function(e) {
                mUtil.scrollTop()
            }),
            r.on("change", function(e) {
                /*1 === e.getStep() &&
                swal({
                    title: "",
                    text: "Se ha completado la seccion número uno",
                    type: "success",
                    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                })*/
            }),
            r.on("change", function(e) {
                /*2 === e.getStep() && alert(2)*/
            }),
            e = i.validate({
                ignore: ":hidden",
                rules: {
                    1: {required: !0},
                    2: {required: !0},
                    3: {required: !0},
                    4: {required: !0},
                    5: {required: !0},
                    6: {required: !0},
                    7: {required: !0},
                    8: {required: !0},
                    9: {required: !0},
                    10: {required: !0},
                    11: {required: !0},
                    12: {required: !0},
                    13: {required: !0},
                    14: {required: !0},
                    15: {required: !0},
                    16: {required: !0},
                    17: {required: !0},
                    18: {required: !0},
                    19: {required: !0},
                    20: {required: !0},
                    21: {required: !0},
                    22: {required: !0},
                    23: {required: !0},
                    24: {required: !0},
                    25: {required: !0},
                    26: {required: !0},
                    27: {required: !0},
                    28: {required: !0},
                    29: {required: !0},
                    30: {required: !0},
                    31: {required: !0},
                    32: {required: !0},
                    33: {required: !0},
                    34: {required: !0},
                    35: {required: !0},
                    36: {required: !0},
                    37: {required: !0},
                    "38[]": {required: !0},
                    "39[]": {required: !0},
                    "40[]": {required: !0},
                    "41[]": {required: !0},
                    42: {required: !0},
                    43: {required: !0},
                    44: {required: !0},
                    45: {required: !0},
                    46: {required: !0},
                    47: {required: !0},
                    48: {required: !0},
                    "49[]": {required: !0},
                    "50[]": {required: !0},
                    51: {required: !0},
                    52: {required: !0},
                    53: {required: !0},
                    54: {required: !0}
                },
                messages: {
                    "prioritario[]": {
                        required: "Debe seleccionar al menos una opción, considere que si no aplica ninguna entonces seleccione el switch 'Ninguna'"
                    },
                    "hijos[]": {
                        required: "Debe seleccionar el campo hijos, agregarlos desde elboton agregar, o bien, selecciar sin hijos menores."
                    }
                },
                invalidHandler: function(e, r) {
                    mUtil.scrollTop(),
                    swal({
                        title: "Faltan campos!!",
                        text: "Existen alunos errores en los campos requeridos, por favor revise.",
                        type: "error",
                        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                    })
                },
                submitHandler: function(e) {}
            }),
            (n = i.find('[data-wizard-action="submit"]')).on("click", function() {
                  mApp.progress(n),
                  $.ajax({
              			headers: {
              						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              			},
              			url: app_url + 'tamizaje/nuevo_tamizaje',
              			type: 'POST',
              			data: $("#nuevo_tamizaje").serialize() + '&' + $.param({'state':42}),
              			dataType: 'json',
              			success: function(resp_success){
                      if (resp_success['resp'] == 'true') {
                        mApp.unprogress(n),
                        swal({
                            title: resp_success['riesgo'] + " - " + resp_success['valoracion'],
                            text: "El formulario se procesó de manera correcta!!",
                            type: "success",
                            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                        }),
												$("#nuevo_tamizaje").find(':input').each(function() {
												 $(this).attr("disabled","true");
											  }),
												$("#tmz_js_fn_01").remove(),
												$('[data-wizard-action="submit"]').remove()
              				}else{
                        mApp.unprogress(n),
                        swal({
                            title: "Error",
                            text: "Ocurrió un error al procesar el formulario.",
                            type: "error",
                            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                        })
              				}
              			},
              			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red TZJ-02');}
              		});
            })
        }
    }
}();
