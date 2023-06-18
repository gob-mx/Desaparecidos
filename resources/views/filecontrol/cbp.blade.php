<script>
$("#breadcrumb-title").html('<img onclick="carga_archivo(\'contenedor_principal\',\'filecontrol/menu_ven\');" style="cursor:pointer; position:absolute; top:-20px; left:0px" src="img/iconito.svg" width="50px"/>');
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
			"dom": 'Blfrtip',
			"buttons": [
					{
					'extend': 'csv',
					'filename': 'cbp'
					},
				{
					'extend': 'excel',
					'filename': 'cbp'
					},
				{
					'extend': 'pdf',
					'filename': 'cbp'
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
            "url": "cbp/obtenerBase",
            "type": "POST"
        }
    } );

		function newexportaction(e, dt, button, config) {
         var self = this;
         var oldStart = dt.settings()[0]._iDisplayStart;
         dt.one('preXhr', function (e, s, data) {
             // Just this once, load all data from the server...
             data.start = 0;
             data.length = 2147483647;
             dt.one('preDraw', function (e, settings) {
                 // Call the original action function
                 if (button[0].className.indexOf('buttons-copy') >= 0) {
                     $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                     $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                     $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                     $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-print') >= 0) {
                     $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                 }
                 dt.one('preXhr', function (e, s, data) {
                     // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                     // Set the property to what it was before exporting.
                     settings._iDisplayStart = oldStart;
                     data.start = oldStart;
                 });
                 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                 setTimeout(dt.ajax.reload, 0);
                 // Prevent rendering of the full data to the DOM
                 return false;
             });
         });
         // Requery the server with the new one-time export settings
         dt.ajax.reload();
     }

} );
//accion_controller();

</script>
