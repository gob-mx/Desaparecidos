function accion_cbp(){
	$(document).ready(function() {
		$('#controllers').dataTable();
		$('#controllers tbody').on('click', 'tr', function () {
			var id = $('td', this).eq(0).text();
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'controllers/data_controller/' + id,
				dataType: 'html',
				success: function(resp_success){
					var modal =  resp_success;
					$(modal).modal().on('shown.bs.modal',function(){
						//console.log(modal);
					}).on('hidden.bs.modal',function(){
						$(this).remove();
					});
				},
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red CNTR-01');}
			});
		} );
	} );
}
