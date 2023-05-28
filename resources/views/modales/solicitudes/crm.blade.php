<div class="modal fade" id="modalCRM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Seguimiento a solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_content">

              <div class="m-portlet__body">
								<div class="m-widget3 rounded" id="container_scroll">
                  <div class="content" id="appender">

                  <?php
                  $num = count($datos['mensajes']);
                  for($i=0;$i < $num ;$i++){
                    $avatar_usr_circ = (isset($datos['mensajes'][$i]->avatar)) ?'tmp/'.Helpme::duplicatePublicNoDelete($datos['mensajes'][$i]->avatar,'perfiles'):'img/avatar.jpg';
                  ?>


									<div class="m-widget3__item">
										<div class="m-widget3__header">
											<div class="m-widget3__user-img">
												<img class="m-widget3__img" src="plugs/timthumb.php?src=<?=$avatar_usr_circ?>&w=42&h=42&a=t" alt="">
											</div>
											<div class="m-widget3__info">
												<span class="m-widget3__username">
													<?=$datos['mensajes'][$i]->nombres.' '.$datos['mensajes'][$i]->apellido_paterno.' '.$datos['mensajes'][$i]->apellido_materno?>
												</span><br>
												<span class="m-widget3__time">
													<?=$datos['mensajes'][$i]->fecha_alta?>
												</span>
											</div>
											<span class="m-widget3__status m--font-<?php //$datos['mensajes'][$i]->valor?>">
												<?php //$datos['mensajes'][$i]->etiqueta?>
											</span>
										</div>
										<div class="m-widget3__body">
											<p class="m-widget3__text">
												<?=$datos['mensajes'][$i]->mensaje?>
											</p>
										</div>
									</div>


                  <?php
                  }
                  ?>

                  </div>
								</div>
							</div>
              <form class="m-form m-form--fit m-form--label-align-right" id="crm">
                <div class="m-portlet__body">
                  <div class="form-group m-form__group">
                    <label for="mensaje">Mensaje</label>
                    <textarea class="form-control m-input" id="mensaje" name="mensaje" rows="3"></textarea>
                  </div>
                </div>
                <input type="hidden" name="id_solicitud" value="<?=$datos['id_solicitud']?>">
              </form>

            </div>
						<div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">
                Cerrar
              </button>
              <button type="button" class="btn btn-primary" id="sol_js_fn_07">
                Agregar
              </button>
						</div>
        </div>
    </div>
</div>
