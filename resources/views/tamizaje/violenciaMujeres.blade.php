<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / Tamizaje / Valoración de riesgo en mujeres víctimas de violencia de pareja');
</script>
<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__body">
		<table id="tamizajes" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>ID</th>
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
            "url": "tamizaje/violenciaMujeresGet",
            "type": "POST"
        }
    } );
} );
accion_controller();
</script>
