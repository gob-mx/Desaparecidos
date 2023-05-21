<!--Section: Team v.1-->
<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/listado\');">GF SNTE 5</a> / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/list/<?=$datos['id_solicitud']?>\');">Beneficiarios</a> / Datos del Beneficiario');
</script>

<div class="m-content">
  <div class="row">
    <div class="col-lg-12">

      <!--begin::Portlet-->
      <div class="m-portlet">
        <div class="m-portlet__head">
          <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
              <h3 class="m-portlet__head-text">
                <?=$datos['titular']?> > <?=$datos['beneficiario']?>
              </h3>
            </div>
          </div>
        </div>
        <div class="m-portlet__body">
          <ul class="nav nav-tabs  m-tabs-line" role="tablist">
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_1_1" role="tab">Ubicación</a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_2" role="tab">Particulares</a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_3" role="tab">Trabajo</a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_4" role="tab">Bancarios</a>
            </li>
          </ul>
          <form id="beneficiario">
            <div class="tab-content">
                  <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        ¿Cual es su domicilio?
                      </label>
                      <div class="input-group col-5">
                        <input type="text" class="form-control" id="id_direccion" readonly name="id_direccion" value="">
                        <input id="id_dom_4" name="id_dom_4" type="hidden" value="">
                        <div class="input-group-append">
                          <a class="btn btn-secondary modal_dir" data-iden="<?=$datos['id_solicitud']?>"  data-id="id_direccion" data-hidden="id_dom_4" type='link'>Direcciones...</a>
                        </div>
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        ¿Pais de nacimiento?
                      </label>
                      <div class="col-3">
                        <select class="form-control m-select2" id="id_pais_nacimiento" name="id_pais_nacimiento">
                          <?=$datos['paises']?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        ¿Pais de residencia?
                      </label>
                      <div class="col-4">
                        <select class="form-control m-select2" id="id_pais_residencia" name="id_pais_residencia">
                          <?=$datos['paises']?>
                        </select>
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Nacionalidad
                      </label>
                      <div class="col-4">
                          <select class="form-control m-select2" id="id_nacionalidad" name="id_nacionalidad">
                            <?=$datos['nacionalidades']?>
                          </select>
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-1 col-form-label">
                        A Paterno
                      </label>
                      <div class="col-3">
                        <input class="form-control m-input" type="text" id="ap_paterno" name="ap_paterno" placeholder="Apellido Paterno" value="">
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        A Materno
                      </label>
                      <div class="col-3">
                        <input class="form-control m-input" type="text" id="ap_materno" name="ap_materno" placeholder="Apellido Materno" value="">
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        Nombres
                      </label>
                      <div class="col-3">
                        <input class="form-control m-input" type="text" id="nombres" name="nombres" placeholder="Nombre(s)" value="">
                      </div>
                    </div>

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-1 col-form-label">
                        Parentesco
                      </label>
                      <div class="col-2">
                          <select class="form-control m-select2" id="parentesco" name="parentesco" style="width: 100%;">
                            <?=$datos['parentesco']?>
                          </select>
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Fecha Nacimiento
                      </label>
                      <div class="col-2">
                        <input class="form-control m-input" type="date" id="fecha_nac" name="fecha_nac" placeholder="Fecha de nacimiento" value="">
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Entidad Federativa de Nacimiento
                      </label>
                      <div class="col-3">
                        <select class="form-control m-select2" id="entidad_federativa_nac" name="entidad_federativa_nac" style="width: 100%;">
                          <?=$datos['estados']?>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="m_tabs_1_3" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-1 col-form-label">
                        Ocupación
                      </label>
                      <div class="col-3">
                        <select class="form-control m-select2" id="ocupacion" name="ocupacion" style="width: 100%;">
                          <?=$datos['ocupaciones']?>
                        </select>
                      </div>
                      <label class="col-1 col-form-label">
                        Actividad
                      </label>
                      <div class="col-3">
                        <select class="form-control m-select2" id="giro_actividad" name="giro_actividad" style="width: 100%;">
                          <?=$datos['actividades']?>
                        </select>
                      </div>
                      <label class="col-1 col-form-label">
                        Teléfono
                      </label>
                      <div class="col-3 input-group" style="width: 100%;">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="lada_telefono" oninput="validarTel(this)"  name="lada_telefono" value="">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado5"><i class="fa fa-phone red"></i></span></span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-1 col-form-label">
                        Correo electrónico
                      </label>
                      <div class="col-2">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="email" oninput="validarEmail(this)" onkeyup="this.value = this.value.toLowerCase();" name="email" placeholder="Ingrese su mail" value="">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado3"><i class="fa fa-times red"></i></span></span>
                        </div>
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        C.U.R.P
                      </label>
                      <div class="col-2">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="curp" oninput="validarCURP(this)" onkeyup="this.value = this.value.toUpperCase();" name="curp" placeholder="Ingrese su CURP" value="">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado"><i class="fa fa-times red"></i></span></span>
                        </div>
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        R.F.C.
                      </label>
                      <div class="col-2">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="rfc" oninput="validarRFC(this)" onkeyup="this.value = this.value.toUpperCase();" name="rfc" placeholder="Ingrese su RFC" value="">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado2"><i class="fa fa-times red"></i></span></span>
                        </div>
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        Serie de e-firma
                      </label>
                      <div class="col-2">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="serie_e_firma" oninput="validarE_firma(this)"  name="serie_e_firma" value="">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado4"><i class="fa fa-times red"></i></span></span>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="m_tabs_1_4" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-1 col-form-label">
                        CLABE
                      </label>
                      <div class="col-5">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="CLABE" oninput="validarClabe(this)"  name="CLABE" value="">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado6"><i class="fa fa-money-bill-alt red"></i></span></span>
                          <input id="bank_id" name="bank_id" type="hidden" value="">
                        </div>
                      </div>

                      <label for="example-text-input" class="col-1 col-form-label">
                        Banco
                      </label>
                      <div class="col-5">
                        <input readonly class="form-control m-input" type="text" id="banco" name="banco" placeholder="Ingrese la CLABE para obtener el Banco" value="">
                      </div>
                    </div>


                  </div>
            </div>
          </form>

          <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
              <div class="row">
                <div class="col-9"></div>
                <div class="col-3"><br><br><br>
                    <a id="sol_js_fn_05" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                      Guardar
                    </a>
                  &nbsp;&nbsp;
                  <a type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                    Cancelar
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <script>
      var Select2 = {
          init: function() {
              $("#id_nacionalidad").select2({
                  placeholder: "Seleccione una Nacionalidad"
              });

              $("#id_pais_nacimiento").select2({
                  placeholder: "Seleccione un país"
              });

              $("#id_pais_residencia").select2({
                  placeholder: "Seleccione un país"
              });

              $("#parentesco").select2({
                  placeholder: "Seleccione el parentesco"
              });

              $("#entidad_federativa_nac").select2({
                  placeholder: "Seleccione el estado"
              });

              $("#ocupacion").select2({
                  placeholder: "Seleccione la ocupación"
              });

              $("#giro_actividad").select2({
                  placeholder: "Seleccione la ocupación"
              });
          }
      };
      jQuery(document).ready(function() {
          Select2.init();
      });
      </script>

    </div>
  </div>
</div>
