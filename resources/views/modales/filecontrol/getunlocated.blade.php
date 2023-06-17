<div class="modal fade" id="getunlocated" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel" style="cursor:pointer">Datos de desaparecido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">
              <div class="m-portlet__body">
								<div class="m-widget3 rounded" id="container_scroll">

                  <table class="table table-sm m-table m-table--head-bg-brand">
                  <thead class="thead-inverse">
                  <tr>
                  <th>Campo</th>
                  <th>Valor</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($datos->getAttributes() as $key => $value){
                    echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
                    }
                    ?>
                  </tbody>
                  </table>

                </div>
              </div>
            </div>

						<div class="modal-footer" id="footer_dir">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cerrar
              </button>
						</div>
        </div>
    </div>
</div>
