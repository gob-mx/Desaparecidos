<script>
$("#breadcrumb-title").html('<img onclick="carga_archivo(\'contenedor_principal\',\'filecontrol/menu_ven\');" style="cursor:pointer; position:absolute; top:-20px; left:0px" src="img/ven-fgj.svg" width="50px"/>');
$("#breadcrumb-title").append('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / FGJ');
</script>
<style>
#breadcrumb-title{
	padding-left: 60px;
}
</style>
<div class="m-portlet m-portlet--mobile">

	<div class="m-portlet__body">
		<table id="fgj" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
          <th>﻿idausente</th>
          <th>nombre</th>
          <th>apaterno</th>
          <th>amaterno</th>
          <th>edad</th>
          <th>dessexo</th>
          <th>desctipo</th>
          <th>descmunicipio</th>
          <th>colonia</th>
          <th>descTipoAu</th>
          <th>fechaausencia</th>
          <th>abrevTipo</th>
          <th>descTipo2</th>
          <th>apoyo</th>
          <th>iddenunciante</th>
          <th>nombre_denunciante</th>
          <th>apaterno_denunciante</th>
          <th>amaterno_denunciante</th>
          <th>fechaalta</th>
          <th>desctiporeporte</th>
          <th>desctipocancelacion</th>
          <th>fechalocalizacion</th>
          <th>FechaCapturaLocalizacion</th>
          <th>deschechos</th>
          <th>desclocalizado</th>
          <th>desclugar</th>
          <th>municipiolocalizacion</th>
          <th>numavprev</th>
          <th>avprev</th>
          <th>ausencia_fecha</th>
          <th>alta_fecha</th>
          <th>localizacion_fecha</th>
          <th>alta_semana</th>
          <th>localizacion_semana</th>
				</tr>
			</thead>
		</table>
	</div>

</div>

<script>
$(document).ready(function() {
    $('#fgj').dataTable( {
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
            "url": "fgj/obtenerBase",
            "type": "POST"
        }
    } );
} );
//accion_controller();

</script>
