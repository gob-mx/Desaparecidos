<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / GF SNTE 5 / Listado');
</script>
		<div class="m-portlet m-portlet--mobile">

			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
						<div class="col-xl-12 order-1 order-xl-2 m--align-right">

							<a id="wzd_js_fn_01" href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									<i class="fa fa-users left"></i>
									<span>
										Nueva solicitud
									</span>
								</span>
							</a>

							<div class="m-separator m-separator--dashed d-xl-none"></div>
						</div>
				</div>
			</div>

			<div class="m-portlet__body">
				<table id="solicitudes" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Paterno</th>
								<th>Materno</th>
								<th>RFC</th>
								<th>Forma de Pago</th>
								<th># Beneficiarios</th>
								<th>&nbsp;</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
<script>
    $(document).ready(function() {
        $('#solicitudes').dataTable( {
            responsive: true,
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
                "url": "solicitudes/listado_solicitudes",
                "type": "POST"
            }
        } );
    } );
		</script>
</script>
