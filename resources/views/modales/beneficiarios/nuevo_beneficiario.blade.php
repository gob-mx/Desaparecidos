<div class="modal fade" id="myModaladdbenefit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nuevo beneficiario:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">

              <div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="200">
                <form id="beneficiario_form">

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="recipient-name" class="form-control-label">Nombres:</label>
                        <input name="nombre" type="text" class="form-control" id="nombre">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="recipient-name" class="form-control-label">Paterno:</label>
                        <input name="paterno" type="text" class="form-control" id="paterno">
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="recipient-name" class="form-control-label">Materno:</label>
                        <input name="materno" type="text" class="form-control" id="materno">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="recipient-name" class="form-control-label">Parentesco:</label>
                        <select class="form-control m-input" id="parentesco" name="parentesco">
                        <?php echo $datos['parentesco']; ?>
                        </select>
                      </div>
                    </div>

                  </div>
                  <input type="hidden" name="id_solicitud" value="<?=$datos['id_solicitud']?>">
                </form>
              </div>

            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
              </button>
              <button type="button" class="btn btn-primary" id="ben_js_fn_05">
                Agregar
              </button>
						</div>
        </div>
    </div>
</div>
