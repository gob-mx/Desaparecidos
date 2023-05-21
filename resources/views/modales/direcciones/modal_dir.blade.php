<div class="modal fade" id="address_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel" style="cursor:pointer">
                  <span id="add_nueva_dir">Añadir nueva dirección</span> o
                  <span id="add_exist_dir">seleccionar existente:</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">




                  <?php
                  if(count($datos['direcciones']) > 0){
                  ?>
                    <div class="form-group" id="dir_exist">
                      <div class="row">
                  <?php
                    foreach($datos['direcciones'] as $num => $direccion){
                      ?>
                      <div class="m-portlet m-portlet--bordered m-portlet--bordered-semi m-portlet--rounded portlet_dir"
                      data-dir_id="<?=$direccion->id?>"
                      data-dir_calle="<?=$direccion->calle?>"
                      data-dir_num_ext="<?=$direccion->num_ext?>"
                      data-dir_num_int="<?=$direccion->num_int?>"
                      data-dir_asentamiento="<?=$direccion->asentamiento?>"
                      data-dir_municipio="<?=$direccion->municipio?>"
                      data-dir_ciudad="<?=$direccion->ciudad?>"
                      data-dir_estado="<?=$direccion->estado?>"
                      data-dir_codigo_postal="<?=$direccion->codigo_postal?>"
                      style="cursor:pointer">
                        <div class="m-portlet__head">
                          <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                              <h3 class="m-portlet__head-text">
                                <?=$direccion->calle?>
                              </h3>
                            </div>
                          </div>
                        </div>
                        <div class="m-portlet__body">
                          <?=$direccion->calle?> <?=$direccion->num_ext?> - <?=$direccion->num_int?>, <?=$direccion->asentamiento?>,
                          <?=$direccion->municipio?>, <?=$direccion->ciudad?>, <?=$direccion->estado?>, CP. <?=$direccion->codigo_postal?>
                        </div>
                      </div>
                      <?php
                    }
                    ?>
                    </div>
                  </div>
                    <?php
                    $display_hide = 'style="display: none;"';
                  }else{
                    $display_hide = '';
                  }
                  ?>



                <form id="direccion" <?=$display_hide?>>

                  <div class="form-group">

                    <div class="row">

                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">CP:</label>
                        <div class="form-group m-form__group">
                          <div class="input-group">
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="">
                            <div class="input-group-append">
                              <a class="btn btn-secondary cp_search"><i class="flaticon-search"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-sm-6 col-md-6 col-lg-8">
                        <label for="recipient-name" class="form-control-label">Asentamiento:</label>
                        <select readonly class="form-control m-input" id="asentamiento" name="asentamiento"></select>
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Estado:</label>
                        <input readonly name="estado" type="text" class="form-control" id="estado">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Municipio:</label>
                        <input readonly name="municipio" type="text" class="form-control" id="municipio">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <label for="recipient-name" class="form-control-label">Ciudad:</label>
                        <input readonly name="ciudad" type="text" class="form-control" id="ciudad">
                      </div>
                    </div>

                  </div>

                  <div class="form-group">

                    <div class="row">
                      <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                        <label for="recipient-name" class="form-control-label">Calle:</label>
                        <input name="calle" type="text" class="form-control" id="calle">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="recipient-name" class="form-control-label">Num EXT:</label>
                        <input name="num_ext" type="text" class="form-control" id="num_ext">
                      </div>
                      <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <label for="recipient-name" class="form-control-label">Num INT:</label>
                        <input name="num_int" type="text" class="form-control" id="num_int">
                      </div>
                    </div>

                  </div>

                  <input id="iden" name="iden" type="hidden" value="<?=$datos['iden']?>">       <!--Para identificar a que grupo de valores pertenece la direccion-->
                  <input id="id" name="id" type="hidden" value="<?=$datos['id']?>">             <!--para identificar en donde se escribe el valor seleccionado en el formulario padre-->
                  <input id="hidden" name="hidden" type="hidden" value="<?=$datos['hidden']?>"> <!--identificador del CP que se liga al formulario padre-->

                </form>


            </div>

						<div class="modal-footer" id="footer_dir"  <?=$display_hide?>>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cancelar
              </button>
              <button type="button" class="btn btn-primary" id="gral_js_fn_01">
                Agregar
              </button>
						</div>
        </div>
    </div>
</div>
