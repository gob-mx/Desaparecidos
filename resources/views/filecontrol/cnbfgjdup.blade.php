<script>
$("#breadcrumb-title").html('<img onclick="carga_archivo(\'contenedor_principal\',\'filecontrol/menu_ven\');" style="cursor:pointer; position:absolute; top:-20px; left:0px" src="img/iconito.svg" width="50px"/>');
$("#breadcrumb-title").append('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' /Duplicados en CNB-FGJ');
</script>
<style>
#breadcrumb-title{
	padding-left: 60px;
}
</style>
<div class="m-portlet m-portlet--mobile">

	<div class="m-portlet__body">
		<table id="cnbfgjdup" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>id</th>
					<th>Nombre</th>
					<th>Paterno</th>
					<th>Materno</th>
          <th>Repeticiones</th>
          <th>Ids Origen</th>
				</tr>
			</thead>
		</table>
	</div>

</div>

<script>
$(document).ready(function() {
    $('#cnbfgjdup').dataTable( {
			"dom": 'Blfrtip',
			"buttons": [
					{
					'extend': 'csv',
					'filename': 'cnbfgjdup'
					},
				{
					'extend': 'excel',
					'filename': 'cnbfgjdup'
					},
				{
					'extend': 'pdf',
					'filename': 'cnbfgjdup'
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
            "url": "cnbfgjdup/obtenerBase",
            "type": "POST"
        }
    } );
} );
//accion_controller();

</script>
