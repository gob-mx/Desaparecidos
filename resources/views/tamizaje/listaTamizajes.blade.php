<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / Listar Tamizajes / Expediente:');
</script>
<div class="m-portlet m-portlet--mobile">


	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
				<div class="col-xl-12 order-1 order-xl-2 m--align-right">
					<a id="tmje_js_fn_01" href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
						<span>
							<i class="fa fa-plus left"></i>
							<span>
								Nuevo tamizaje
							</span>
						</span>
					</a>
					<div class="m-separator m-separator--dashed d-xl-none"></div>
				</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<table id="tamizajes" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Expediente</th>
				</tr>
			</thead>
		</table>
	</div>

</div>

<script>
$(document).ready(function() {
    $('#tamizajes').dataTable( {
      "fnDrawCallback": function( oSettings ) {
        /**/
      },
    "language": {
        "url": "<?=env('APP_URL')?>assets/plugins/datatables/Spanish.json"
    },
		"searching": true,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "processing": true,
    "serverSide": true,
		"ajax": {
						"headers": {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
            "url": "tamizaje/listaTamizajes",
            "type": "POST"
        }
    } );
} );
accion_controller();

var pusher = new Pusher('<?=env('PUSHER_APP_KEY')?>', {
	encrypted: true
});

var updChannel = pusher.subscribe('tamizajes');

pusher.connection.bind('connected', function() {
	console.log('✓ Servicio de actualización de tamizajes activo');
})
updChannel.bind('evento', function(data) {
	$('#tamizajes').DataTable().ajax.reload();
});

</script>
