<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Añadir nueva solicitud:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">

              <div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-height="200">
                <form id="solicitud">

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Nombres:</label>
                        <input onchange="disabled_add()" name="nombre" type="text" class="form-control" id="nombre">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Paterno:</label>
                        <input onchange="disabled_add()" name="paterno" type="text" class="form-control" id="paterno">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Materno:</label>
                        <input onchange="disabled_add()" name="materno" type="text" class="form-control" id="materno">
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Forma de pago:</label>
                        <select class="form-control m-input" id="forma_pago" name="forma_pago">
                        <?php echo $datos['forma_pago']; ?>
                        </select>
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">RFC:</label>
                        <input onchange="disabled_add()" name="rfc" type="text" class="form-control" id="rfc">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label"># Beneficiarios:</label>
                        <input name="beneficiarios" readonly type="number" class="form-control spin_beneficiarios" value="1" id="beneficiarios">
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">¿El beneficiario es el titular?:</label>
                        <span class="m-switch m-switch--outline m-switch--brand">
                          <label>
                            <input class="checkbox_activo titular" id="titular" type="checkbox" name="titular">
                            <span></span>
                          </label>
                        </span>
                      </div>
                    </div>

                  </div>
                  <input id="id_poliza" name="id_poliza" type="hidden" value="">
                </form>
              </div>

            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
              </button>
              <button type="button" class="btn btn-primary" id="sol_js_fn_02">
                Buscar
              </button>
              <button type="button" disabled class="btn btn-primary" id="sol_js_fn_03">
                Agregar
              </button>
						</div>
        </div>
    </div>
</div>
