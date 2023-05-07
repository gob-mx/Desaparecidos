var WizardTamizaje = function() {
    $("#m_wizard");
    var e, r, i = $("#wizard_as");
    return {
        init: function() {
            var n;
            $("#m_wizard"),
            i = $("#wizard_as"),
            (r = new mWizard("m_wizard",{
                startStep: 1
            })).on("beforeNext", function(r) {
                !0 !== e.form() && this.stop()
            }),
            r.on("change", function(e) {
                mUtil.scrollTop()
            }),
            r.on("change", function(e) {
							/*8 === e.getStep() &&
							swal({
									title: "",
									text: "Ha completado el tamizaje, verifique el PDF antes de finalizarlo, recuerde que una vez finalizado el tamizaje será inalterable",
									type: "success",
									confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
							}).then(function(){
								$("#show_pdf").show();
								$("#counter").css("right", "-30px");
								$("#tmz_js_fn_02").removeAttr("id");
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
                    "45[]": {required: !0},
                    46: {required: !0},
                    47: {required: !0},
                    "48[]": {required: !0},
                    "49[]": {required: !0},
                    50: {required: !0},
                    51: {required: !0},
                    52: {required: !0},
                    53: {required: !0},
                    54: {required: !0},
										55: {required: !0},
										56: {required: !0}
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
                        title: "¡Faltan campos!",
                        text: "Existen campos sin rellenar, por favor  revise sus respuestas",
                        type: "error",
                        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                    })
                },
                submitHandler: function(e) {}
            }),
            (n = i.find('[data-wizard-action="submit"]')).on("click", function() {
									if($("[name='54']").val()==''){
										swal({
											title: "¡Faltan campos!",
											text: 'Escriba los resultados del Anexo Factores de Vulnerabilidad, así como información que considere importante y que no recoja la ficha',
											type: "error",
											confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
										});
										return;
									};
                  mApp.progress(n),
                  $.ajax({
              			headers: {
              						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              			},
              			url: app_url + 'wizard/nuevo_registro',
              			type: 'POST',
              			data: $("#wizard_as").serialize(),
              			dataType: 'json',
              			success: function(resp_success){
                      if (resp_success['resp'] == 'true') {
                        mApp.unprogress(n),
                        swal({
                            title: resp_success['riesgo'] + " - " + resp_success['valoracion'],
                            text: "¡El formulario se procesó de manera correcta!",
                            type: "success",
                            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
                        }),
												$("#wizard_as").find(':input').each(function() {
												 $(this).attr("disabled","true");
											  }),
												$('[data-wizard-action="submit"]').remove();
												$('[data-wizard-action="abortar"]').remove();
												$("#breadcrumb-title").append(' / <span id="tmz_fin">(Wizard finalizado)<span>');
												/*if(resp_success['show_pdf'] == true){
														$("#show_pdf").show();
												}*/
              				}else if (resp_success['resp'] == 'false'){
                        mApp.unprogress(n),
												swal({
														title: "Error",
														text: resp_success['mensaje'],
														type: "error",
														confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
												})
              				}
              			},
              			error: function(respuesta){ alerta('Alerta!','Error de conectividad de red WZD-02');}
              		});
            })
        }
    }
}();
