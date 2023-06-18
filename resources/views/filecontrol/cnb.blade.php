<script>
$("#breadcrumb-title").html('<img onclick="carga_archivo(\'contenedor_principal\',\'filecontrol/menu_ven\');" style="cursor:pointer; position:absolute; top:-20px; left:0px" src="img/iconito.svg" width="50px"/>');
$("#breadcrumb-title").append('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / CNB');
</script>
<style>
#breadcrumb-title{
	padding-left: 60px;
}
</style>
<div class="m-portlet m-portlet--mobile">

	<div class="m-portlet__body">
		<table id="cnb" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
          <th>﻿Consecutivo</th>
          <th>FUB</th>
          <th>Nombre</th>
          <th>PrimerApellido</th>
          <th>SegundoApellido</th>
          <th>Fecha</th>
          <th>Edad</th>
          <th>Sexo</th>
          <th>Lugar</th>
          <th>CURP</th>
          <th>RFC</th>
          <th>Nacionalidad</th>
          <th>Fecha</th>
          <th>Autoridad</th>
          <th>Total</th>
          <th>Estatus</th>
          <th>Fecha</th>
          <th>Entidad</th>
          <th>Estatus</th>
          <th>Clasificacion</th>
        </tr>
      </thead>
    </table>
</div>

</div>
<script>
$(document).ready(function() {
    $('#cnb').dataTable( {
			"dom": 'Blfrtip',
			"buttons": [
					{
					'extend': 'csv',
					'filename': 'cnb'
					},
				{
					'extend': 'excel',
					'filename': 'cnb'
					},
				{
					'extend': 'pdf',
					'filename': 'cnb'
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
            "url": "cnb/obtenerBase",
            "type": "POST"
        }
    } );
} );
//accion_controller();

</script>
