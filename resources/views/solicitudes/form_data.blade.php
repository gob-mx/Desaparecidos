<!--Section: Team v.1-->
<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/listado\');">GF SNTE 5</a> / Solicitud / Datos del Asegurado');
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
                <?=$datos['titular']?>
              </h3>
            </div>
          </div>
        </div>
        <div class="m-portlet__body">
          <ul class="nav nav-tabs  m-tabs-line" role="tablist">
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_1_1" role="tab">Particulares</a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_2" role="tab">Seguro</a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_3" role="tab">Trabajo</a>
            </li>
            <li class="nav-item m-tabs__item">
              <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_1_4" role="tab">Fallecimiento</a>
            </li>
          </ul>
          <form id="datos_asegurado">
            <div class="tab-content">
                  <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        ¿Cual fue su último domicilio?
                      </label>
                      <div class="input-group col-10">
                        <input type="text" class="form-control" id="id_domicilio_cuando_fallecio" readonly name="id_domicilio_cuando_fallecio" value="<?=$datos['humanAddress1']?>">
                        <input id="id_dom_1" name="id_dom_1" type="hidden" value="<?=$datos['asegurado']->id_domicilio_cuando_fallecio?>">
                        <div class="input-group-append">
                          <a class="btn btn-secondary modal_dir" data-iden="<?=$datos['id_solicitud']?>"  data-id="id_domicilio_cuando_fallecio" data-hidden="id_dom_1" type='link'>Direcciones...</a>
                        </div>
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        ¿Cual fué su lugar de nacimiento?
                      </label>
                      <div class="col-3">
                          <select data-pais="pais_as" data-estado="entidad_as" data-change="ciudad_nac" readonly class="form-control m-input pais" id="pais_as" name="pais_as"><?=$datos['paises1']?></select>
                      </div>
                      <div class="col-3">
                          <select data-pais="pais_as" data-estado="entidad_as" data-change="ciudad_nac" readonly class="form-control m-input estado" id="entidad_as" name="entidad_as"><option><?=$datos['estados1']?></option></select>
                      </div>
                      <div class="col-4">
                          <select data-pais="pais_as" data-estado="entidad_as" data-change="ciudad_nac" readonly class="form-control m-input" id="ciudad_nac" name="ciudad_nac"><?=$datos['ciudades1']?></select>
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Cual fué su Nacionalidad
                      </label>
                      <div class="col-5">
                          <select class="form-control m-select2" id="nacionalidades" name="nacionalidades">
                            <?=$datos['nacionalidades']?>
                          </select>
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        C.U.R.P
                      </label>
                      <div class="col-4">
                        <div class="m-input-icon m-input-icon--right">
                          <input type="text" class="form-control m-input" id="curp" oninput="validarCURP(this)" onkeyup="this.value = this.value.toUpperCase();" name="curp" placeholder="Ingrese su CURP" value="<?=$datos['asegurado']->curp?>">
                          <span class="m-input-icon__icon m-input-icon__icon--right"><span id="resultado"><i class="fa fa-times red"></i></span></span>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Número de Polizas
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input" type="text" id="no_polizas" name="no_polizas" placeholder="Número de polizas" value="<?=$datos['no_poliza']?>">
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Tipo de Seguro
                      </label>
                      <div class="col-4">
                        <select class="form-control m-select2" id="tipo_seguro" name="tipo_seguro" style="width: 100%;">
                          <?=$datos['tipo_seguro']?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Grupo y/o Colectivo
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input" readonly type="text" id="grupo_y_colectivo" name="grupo_y_colectivo" value="SNTE 5" placeholder="Grupo y/o Colectivo" value="">
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        No. de Certificado
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input" type="text" id="no_certificado" name="no_certificado" placeholder="No. de Certificado" value="<?=$datos['certificado']?>">
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="m_tabs_1_3" role="tabpanel">

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Número de afiliación al IMSS o al ISSSTE
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input" type="text" id="afiliacion_imss_issste" name="afiliacion_imss_issste" placeholder="Número de afiliación al IMSS o al ISSSTE" value="<?=$datos['asegurado']->afiliacion_imss_issste?>">
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Ocupación
                      </label>
                      <div class="col-4">
                          <select class="form-control m-select2" id="ocupacion" name="ocupacion" style="width: 100%;">
                            <?=$datos['ocupaciones']?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Empresa donde trabajaba
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input" type="text"  id="empresa_trabajo" name="empresa_trabajo" placeholder="Empresa donde trabajaba" value="Sindicato">
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Antigüedad en la Empresa
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input spin_antiguedad" readonly type="text" id="antiguedad_en_empresa" name="antiguedad_en_empresa" placeholder="Antiguedad en años" value="<?=$datos['asegurado']->antiguedad_en_empresa?>">
                      </div>
                    </div>

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Domicilio de la Empresa
                      </label>
                      <div class="input-group col-4">
                        <input type="text" class="form-control" id="id_domicilio_empresa" readonly name="id_domicilio_empresa" value="<?=$datos['humanAddress2']?>">
                        <input id="id_dom_2" name="id_dom_2" type="hidden" value="<?=$datos['asegurado']->id_domicilio_empresa?>">
                        <div class="input-group-append">
                          <a class="btn btn-secondary modal_dir" data-iden="<?=$datos['id_solicitud']?>"  data-id="id_domicilio_empresa" data-hidden="id_dom_2" type='link'>Direcciones...</a>
                        </div>
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Otras Empresas
                      </label>
                      <div class="col-4">
                        <input class="form-control m-input" type="text" id="otras_empresas" name="otras_empresas" value="Ninguna" placeholder="Otras Empresas" value="">
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="m_tabs_1_4" role="tabpanel">

                    <div class="form-group m-form__group row">

                      <label for="example-text-input" class="col-2 col-form-label">
                        ¿Ciudad?
                      </label>
                      <div class="col-3">
                          <select data-pais="pais_fall" data-estado="entidad_fall" data-change="id_lugar" id="pais_fall" name="pais_fall" readonly class="form-control m-input pais"><?=$datos['paises2']?></select>
                      </div>
                      <div class="col-3">
                          <select data-pais="pais_fall" data-estado="entidad_fall" data-change="id_lugar" id="entidad_fall" name="entidad_fall" readonly class="form-control m-input estado"><option><?=$datos['estados2']?></option></select>
                      </div>
                      <div class="col-4">
                          <select data-pais="pais_fall" data-estado="entidad_fall" data-change="id_lugar" id="id_lugar" name="id_lugar" readonly class="form-control m-input"><?=$datos['ciudades2']?></select>
                      </div>

                    </div>

                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-1 col-form-label">
                        Lugar:
                      </label>
                      <div class="col-2">
                        <select class="form-control m-select2" id="cat_edificio_fallecimiento" name="cat_edificio_fallecimiento" style="width: 100%;">
                          <?=$datos['fallece_en']?>
                        </select>
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        Fecha:
                      </label>
                      <div class="col-2">
                        <input class="form-control m-input" type="date" id="fecha_fallecimiento" name="fecha_fallecimiento" placeholder="Fecha de fallecimiento" value="<?=$datos['fallecido']->fecha_fallecimiento?>">
                      </div>
                      <label for="example-text-input" class="col-1 col-form-label">
                        Causa:
                      </label>
                      <div class="col-5">
                        <input class="form-control m-input" type="text"  id="causa_fallecimiento" name="causa_fallecimiento" placeholder="Causa del fallecimiento" value="<?=$datos['fallecido']->causa_fallecimiento?>">
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-2 col-form-label">
                        Agencia de servicios funerarios
                      </label>
                      <div class="col-6">
                        <input class="form-control m-input" type="text" id="agencia_servicio_funerario" name="agencia_servicio_funerario" placeholder="Agencia que proporcionó los servicios funerarios" value="<?=$datos['fallecido']->agencia_servicio_funerario?>">
                      </div>
                      <label for="example-text-input" class="col-2 col-form-label">
                        Fecha de servicios funerarios
                      </label>
                      <div class="col-2">
                        <input class="form-control m-input" type="date" id="fecha_servicios_funerarios" name="fecha_servicios_funerarios" placeholder="Fecha de los servicios funerarios" value="<?=$datos['fallecido']->fecha_servicios_funerarios?>">
                      </div>
                    </div>
                    <div class="form-group m-form__group row">
                      <label for="example-text-input" class="col-4 col-form-label">
                        En caso de muerte violenta, indique que autoridad tomó Conocimiento del hecho:
                      </label>
                      <div class="col-8">
                        <input class="form-control m-input" type="text" id="autoridad_tomo_hechos_violentos" name="autoridad_tomo_hechos_violentos" value="<?=$datos['fallecido']->autoridad_tomo_hechos_violentos?>">
                      </div>
                    </div>

                  </div>
            </div>
            <input id="id_solicitud" name="id_solicitud" type="hidden" value="<?=$datos['id_solicitud']?>">
          </form>

          <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
              <div class="row">
                <div class="col-7"></div>
                <div class="col-3"><br><br><br>
                    <a id="sol_js_fn_05" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                      Guardar
                    </a>
                  &nbsp;&nbsp;
                  <a type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                    Cancelar
                  </a>
                </div>
                <div class="col-2"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <script>
      var Select2 = {
          init: function() {
              $("#nacionalidades").select2({
                  placeholder: "Seleccione una Nacionalidad"
              });

              $("#ocupacion").select2({
                  placeholder: "Seleccione una Ocupación"
              });

              $("#cat_edificio_fallecimiento").select2({
                  placeholder: "Donde falleció"
              });

              $("#tipo_seguro").select2({
                  placeholder: "Tipo de seguro"
              });
          }
      };
      jQuery(document).ready(function() {
          window.onload = validarCURP(document.getElementById("curp"));
          Select2.init();
          BootstrapSpin2.init();
      });

      </script>

    </div>
  </div>
</div>
