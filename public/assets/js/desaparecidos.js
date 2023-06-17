$("body").on("click", ".modal_dup", function() {
		id = $(this).attr('data-iden');
		doc = $(this).attr('data-base');
			$.ajax({
				headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: 'filecontrol/getUnlocated/' + id + '/' + doc,
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
				error: function(respuesta){ alerta('Alerta!','Error de conectividad de red DES-01');}
			});
});
