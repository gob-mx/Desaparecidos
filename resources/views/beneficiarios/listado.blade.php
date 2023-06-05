<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/listadofilter\');">GF SNTE 5</a> /  <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/list/<?=$datos['id_solicitud']?>\');">Beneficiarios</a>');
</script>
		<div class="m-portlet m-portlet--mobile">

			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					 <div class="m-portlet__head-title">
						 <h3 class="m-portlet__head-text">
							 <?=$datos['titular']?>
						 </h3>
					 </div>
				 </div>
				 <?php
				 if($datos['solicitud']->esTitular == 0){
				 ?>
				<div class="m-portlet__head-caption">
						<div class="col-xl-12 order-1 order-xl-2 m--align-right">

							<a id="ben_js_fn_01" data-function="<?=$datos['id_solicitud']?>" href="javascript:;" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
								<span>
									<i class="fa fa-user left"></i>
									<span>
										Nuevo beneficiario
									</span>
								</span>
							</a>

						</div>
				</div>
				<?php
				}
				?>
			</div>

			<div class="m-portlet__body">
				<table id="beneficiarios" class="table table-striped table-bordered display responsive nowrap" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th>ID</th>
								<th>Beneficiario</th>
                <th>Parentesco</th>
								<th>&nbsp;</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
<script>
    $(document).ready(function() {
			  SweetAlert2Benefit.init();
        $('#beneficiarios').dataTable( {
            responsive: true,
            "fnDrawCallback": function( oSettings ) {
              $('[data-toggle="m-tooltip"]').tooltip();
							SweetAlert2Benefit.init();
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
                "url": "beneficiarios/listado_beneficiarios/<?=$datos['id_solicitud']?>",
                "type": "POST"
            }
        } );
    } );
		</script>
</script>
