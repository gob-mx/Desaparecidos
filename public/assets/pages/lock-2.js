$(document).keypress(function(event){
  var keycode = (event.keyCode ? event.keyCode : event.which);
  if(keycode == '13'){
    if($('#usuario').get(0).value==""){
			alerta('Alerta!','Olvido ingresar usuario');
			return false;
		}else if($('#password').get(0).value==""){

			alerta('Alerta!','Olvido ingresar password');
			return false;
		}else{
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: app_url + 'login/logear',
				type: 'POST',
				data: 'usuario='+$('#usuario').get(0).value+"&password="+$('#password').get(0).value,
				dataType: "json",
				beforeSend: function() {
		        /**/
		    },
				success: function(respuesta){
					if(respuesta[0].resp=='acceso_correcto'){
						if(respuesta[2].via == 'correcta'){
							if(respuesta[1].dispositivo=='celular'){
								window.location = app_url + "mobile";
							}else{
								window.location = app_url + "inicio";
							}
						}else if(respuesta[2].via == 'disabled'){
							alerta('Alerta!','El logueo esta deshabilitado de manera temporal por el administrador');
						}
					}else if(respuesta[0].resp=="acceso_incorrecto"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','Usuario o password incorrecto');
					}else if(respuesta[0].resp=="inhabilitado"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','Su cuenta está inhabilitada por exceder el número de intentos de acceso permitidos, notifíquelo a su administrador');
					}else if(respuesta[0].resp=="No autorizado"){
						$('#usuario').value="";
						$('#password').value="";
						alerta('Alerta!','No tiene permisos de acceso a esta aplicación, notifíquelo a su administrador de recursos');
					}
				},
				error: function(){ alerta('Alerta!','Error de conectividad de red CMMN-03');}
			});
		}
  }
});

var Lock = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "../assets/pages/media/bg/1.jpg",
    		    "../assets/pages/media/bg/2.jpg",
    		    "../assets/pages/media/bg/3.jpg",
    		    "../assets/pages/media/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();

jQuery(document).ready(function() {
    Lock.init();
});
