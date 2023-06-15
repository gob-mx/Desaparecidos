<script>
$("#breadcrumb-title").html('<img onclick="carga_archivo(\'contenedor_principal\',\'filecontrol/menu_ven\');" style="cursor:pointer; position:absolute; top:-20px; left:0px" src="img/ven-cbp.svg" width="50px"/>');
$("#breadcrumb-title").append('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / CBP');
</script>
<style>
#breadcrumb-title{
	padding-left: 60px;
}
</style>
<div class="m-portlet m-portlet--mobile">

	<div class="m-portlet__body">
		<table id="cbp" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Expediente</th>
					<th>Nombre</th>
					<th>Status</th>
					<th>Fecha evento</th>
          <th>Fecha reporte</th>
          <th>Fecha Loc</th>
          <th>Alcaldía D</th>
          <th>Alcaldia Vive</th>
          <th>Año desap</th>
          <th>Año rep</th>
          <th>Colonia D</th>
          <th>Colonia vive</th>
          <th>Edad</th>
          <th>Entidad D</th>
          <th>Entidad Loc</th>
          <th>Fipede</th>
          <th>Folio Nacional</th>
          <th>Materno</th>
          <th>Nombre</th>
          <th>Paterno</th>
          <th>Sexo</th>
          <th>Clasificación Etaria</th>
          <th>Sirilo</th>
          <th>Digito</th>
				</tr>
			</thead>
		</table>
	</div>

</div>

<script>
$(document).ready(function() {
    $('#cbp').dataTable( {
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
            "url": "cbp/obtenerBase",
            "type": "POST"
        }
    } );
} );
//accion_controller();

</script>
