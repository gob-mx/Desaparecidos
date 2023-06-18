<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / Roles y permisos / Permisos');
</script>
<div class="m-portlet m-portlet--mobile">

	<div class="m-portlet__body">
		<table id="filecontrol" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
          <th>id</th>
          <th>type_source</th>
          <th>status_file</th>
          <th>filetype</th>
          <th>registros</th>
          <th>user_alta</th>
          <th>fecha_alta</th>
					<th>Reprocesar</th>
				</tr>
			</thead>
		</table>
	</div>

</div>



<script>
$(document).ready(function() {
    $('#filecontrol').dataTable( {
			"dom": 'Blfrtip',
			"buttons": [
					{
					'extend': 'csv',
					'filename': 'Filecontrol'
					},
				{
					'extend': 'excel',
					'filename': 'Filecontrol'
					},
				{
					'extend': 'pdf',
					'filename': 'Filecontrol'
					}
			],
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
            "url": "filecontrol/obtenerArchivos",
            "type": "POST"
        }
    } );
} );
//accion_controller();

</script>
