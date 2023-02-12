<script>
<?php
$status_evaluacion = '';
if($datos['cat_status_evaluacion'] == 42){
		$status_evaluacion = ' / <span id="tmz_fin">(Tamizaje finalizado)<span>';
		?>
		$("#nuevo_tamizaje").find(':input').each(function() {
		 $(this).attr("disabled","true");
		});
		$('[data-wizard-action="submit"]').remove();
		<?php
}
echo isset($checkbox[38])?'$("#counter").css("right", "-30px");':'';
?>

$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / <?=$datos['generales']->folio?> / <?=$datos['generales']->nombreVictima?> <?=$status_evaluacion?>');
</script>


<div class="m-portlet m-portlet--full-height">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text" id="title_tmz">
					<?=$datos['quest'][1][0]['name_exam']?>
				</h3>
			</div>
		</div>
		<?php
			$show_pdf = isset($checkbox[38])?'':'none';
		?>
		<div style="float:right; display: inline; position:relative; top:20px; display: <?=$show_pdf?>;" id="show_pdf"><a href="<?=env('APP_URL')?>pdf/<?=$datos['id_evaluacion']?>" target="_blank"><img src="<?=env('APP_URL')?>img/pdf.png" width="32px"></a></div>
		<div id="counter" data-value="<?=$datos['riesgo']?>"><?=$datos['riesgo']?></div>
	</div>
	<div class="m-portlet__body m-portlet__body--no-padding">
		<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
			<div class="m-portlet__padding-x">
			</div>
			<div class="row m-row--no-padding">
				<div class="col-xl-3 col-lg-12">
					<div class="m-wizard__head">
						<div class="m-wizard__progress">
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="m-wizard__nav">
							<div class="m-wizard__steps">
<!--GENERALES-->
								<div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_1">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>1</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][1][0]['grupo']?>
										</div>
									</div>
								</div>
<!--VIOLENCIA EXTREMA-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>2</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][10][1]['grupo']?>
										</div>
									</div>
								</div>
<!--ANTECEDENTES-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_3">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>3</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][19][55]['grupo']?>
										</div>
									</div>
								</div>
<!--AMENAZAS-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_4">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>4</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][26][74]['grupo']?>
										</div>
									</div>
								</div>
<!--CONTROL EXTREMO-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_5">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>5</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][28][80]['grupo']?>
										</div>
									</div>
								</div>
<!--AGRAVANTES-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_6">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>6</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][33][95]['grupo']?>
										</div>
									</div>
								</div>
<!--FACTORES DE VULNERABILIDAD-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_7">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>7</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][38][111]['grupo']?>
										</div>
									</div>
								</div>
<!--OBSERVACIONES-->
								<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_8">
									<div class="m-wizard__step-info">
										<a href="#" class="m-wizard__step-number">
											<span><span>8</span></span>
										</a>
										<div class="m-wizard__step-line">
											<span></span>
										</div>
										<div class="m-wizard__step-label">
											<?=$datos['quest'][54][0]['grupo']?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-9 col-lg-12">
					<div class="m-wizard__form">
						<form class="m-form m-form--label-align-left- m-form--state-" id="nuevo_tamizaje">
							<div class="m-portlet__body m-portlet__body--no-padding">
<!--GENERALES-->
								<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">
												<?=$datos['quest'][1][0]{'subgrupo'}?>
											</h3>
										</div>
										<input type="hidden" name="id_expediente" value="<?=$datos['generales']->id_expediente?>">
										<input type="hidden" name="id_victima" value="<?=$datos['generales']->id_victima?>">
										<input type="hidden" name="id_remoteUser" value="<?=$datos['generales']->id_remoteUser?>">
										<input type="hidden" name="id_examen" value="<?=$datos['quest'][1][0]['id_examen']?>">
										<input type="hidden" name="id_evaluacion" value="<?=$datos['id_evaluacion']?>">
										<input type="hidden" name="store_hijos" value="<?=isset($obtener_reactivos[41]['campo_unico'])?base64_encode($obtener_reactivos[41]['campo_unico']):null?>">

										<div class="form-group m-form__group row">
											<div class="col-lg-8 m-form__group-sub">
											<!--Ministerio publico-->
											<label class="form-control-label"><?=$datos['quest'][1][0]['reactivo']?>:</label>
												<input type="text" readonly name="<?=$datos['quest'][1][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[1]['campo_unico'])?$obtener_reactivos[1]['campo_unico']:$datos['generales']->nombreEmpleado?>">
												<span class="m-form__help"><?=$datos['quest'][1][0]['react_ayuda']?></span>
											</div>
											<!--Fecha-->
											<div class="col-lg-4 m-form__group-sub">
												<?php
												$i  = date("Y-m-d H:i:s");
												$im = date("Y-m-d",strtotime($i."+ 2 days"));
												$ia = date("Y-m-d",strtotime($i."- 2 days"));
												?>
											<label class="form-control-label"><?=$datos['quest'][2][0]['reactivo']?>:</label>
												<input type="date" name="<?=$datos['quest'][2][0]['react_id_reactivo']?>" class="form-control m-input" value="<?=isset($obtener_reactivos[2]['campo_unico'])?$obtener_reactivos[2]['campo_unico']:''?>" min="<?=$ia?>" max="<?=$im?>">
												<span class="m-form__help"><?=$datos['quest'][2][0]['react_ayuda']?></span>
											</div>
										</div>
										<?php ?>
										<div class="form-group m-form__group row">
											<div class="col-lg-4 m-form__group-sub">
													<label class="form-control-label"><?=$datos['quest'][3][0]['reactivo']?>:</label>
														<input type="text" readonly name="<?=$datos['quest'][3][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[3]['campo_unico'])?$obtener_reactivos[3]['campo_unico']:$datos['generales']->descfiscalia?>">
														<span class="m-form__help"><!--fiscalia--></span>
											</div>
											<div class="col-lg-4 m-form__group-sub">
													<label class="form-control-label"><?=$datos['quest'][4][0]['reactivo']?>:</label>
														<input type="text" readonly name="<?=$datos['quest'][4][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[4]['campo_unico'])?$obtener_reactivos[4]['campo_unico']:$datos['generales']->desc_agencia?>">
														<span class="m-form__help"><!--agencia--></span>
											</div>
											<div class="col-lg-4 m-form__group-sub">
													<label class="form-control-label"><?=$datos['quest'][5][0]['reactivo']?>:</label>
														<input type="text" readonly name="<?=$datos['quest'][5][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[5]['campo_unico'])?$obtener_reactivos[5]['campo_unico']:$datos['generales']->desc_unidad?>">
														<span class="m-form__help"><!--unidad--></span>
											</div>
										</div>
									</div>
									<div class="m-separator m-separator--dashed m-separator--lg"></div>
									<div class="m-form__section">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">
												<!--victima-->
												<?=$datos['quest'][6][0]['subgrupo']?>
											</h3>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-8 m-form__group-sub">
												<!--Nombre y apellidos-->
												<label class="form-control-label"><?=$datos['quest'][6][0]['reactivo']?>:</label>
												<input type="text" readonly name="<?=$datos['quest'][6][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[6]['campo_unico'])?$obtener_reactivos[6]['campo_unico']:$datos['generales']->nombreVictima?>">
												<span class="m-form__help"><?=$datos['quest'][6][0]['react_ayuda']?></span>
											</div>
											<div class="col-lg-4 m-form__group-sub">
												<!--edad de la victima-->
												<label class="form-control-label"><?=$datos['quest'][7][0]['reactivo']?>:</label>
												<input type="number"  readonly class="form-control m-input" name="<?=$datos['quest'][7][0]['react_id_reactivo']?>" value="<?=isset($obtener_reactivos[7]['campo_unico'])?$obtener_reactivos[7]['campo_unico']:$datos['generales']->edad?>">
												<span class="m-form__help"><?=$datos['quest'][7][0]['react_ayuda']?></span>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<div class="col-lg-6 m-form__group-sub">
												  <!--carpeta de investigacion-->
													<label class="form-control-label"><?=$datos['quest'][8][0]['reactivo']?>:</label>
													<input type="text"  readonly class="form-control m-input" name="<?=$datos['quest'][8][0]['react_id_reactivo']?>" value="<?=isset($obtener_reactivos[8]['campo_unico'])?$obtener_reactivos[8]['campo_unico']:$datos['generales']->folio?>">
													<span class="m-form__help"><?=$datos['quest'][8][0]['react_ayuda']?></span>
											</div>
											<div class="col-lg-6 m-form__group-sub">
												  <!--Delito-->
													<label class="form-control-label"><?=$datos['quest'][9][0]['reactivo']?>:</label>
													<select name="<?=$datos['quest'][9][0]['react_id_reactivo']?>" class="form-control m-input m-input--square">
														<?php
														$id1 = isset($obtener_reactivos[9]['campo_unico'])?$obtener_reactivos[9]['campo_unico']:'';
														echo Helpme::setOption($datos['delitos'],$id1);
														?>
												  </select>
													<span class="m-form__help">&nbsp;</span>
											</div>
									  </div>
									</div>
								</div>
<!--VIOLENCIA EXTREMA-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_2">
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">I. <?=$datos['quest'][10][1]['subgrupo']?></h3>
											<p>
											¿Su pareja o expareja ha realizado alguna de las siguientes acciones en su contra?
											Marque las opciones que apliquen y seleccione en qué temporalidad ocurrió:
										</p>
										</div>

										<div class="form-group m-form__group row">
											<!--1. Agresión con químicos, armas blancas u otros objetos-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
													<label>1. <?=$datos['quest'][10][1]['reactivo']?></label>
													<select name="<?=$datos['quest'][10][1]['react_id_reactivo']?>" data-value="<?=isset($options[10]['val_opc'])?$options[10]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema1">
														<option value="" selected disabled><?=$datos['quest'][10][1]['opc_nombre']?></option>
														<option <?=(isset($options[10]['id_opcion'])&&($options[10]['id_opcion'] == $datos['quest'][10][2]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][10][2]['opc_valor']?>" value="<?=$datos['quest'][10][2]['opc_id_opcion']?>"><?=$datos['quest'][10][2]['opc_nombre']?> (<?=$datos['quest'][10][2]['opc_valor']?>)</option>
														<option <?=(isset($options[10]['id_opcion'])&&($options[10]['id_opcion'] == $datos['quest'][10][3]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][10][3]['opc_valor']?>" value="<?=$datos['quest'][10][3]['opc_id_opcion']?>"><?=$datos['quest'][10][3]['opc_nombre']?> (<?=$datos['quest'][10][3]['opc_valor']?>)</option>
														<option <?=(isset($options[10]['id_opcion'])&&($options[10]['id_opcion'] == $datos['quest'][10][4]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][10][4]['opc_valor']?>" value="<?=$datos['quest'][10][4]['opc_id_opcion']?>"><?=$datos['quest'][10][4]['opc_nombre']?> (<?=$datos['quest'][10][4]['opc_valor']?>)</option>
														<option <?=(isset($options[10]['id_opcion'])&&($options[10]['id_opcion'] == $datos['quest'][10][5]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][10][5]['opc_valor']?>" value="<?=$datos['quest'][10][5]['opc_id_opcion']?>"><?=$datos['quest'][10][5]['opc_nombre']?> (<?=$datos['quest'][10][5]['opc_valor']?>)</option>
														<option <?=(isset($options[10]['id_opcion'])&&($options[10]['id_opcion'] == $datos['quest'][10][6]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][10][6]['opc_valor']?>" value="<?=$datos['quest'][10][6]['opc_id_opcion']?>"><?=$datos['quest'][10][6]['opc_nombre']?> (<?=$datos['quest'][10][6]['opc_valor']?>)</option>
													</select>
											</div>
											<!--6. Amordazar o privar de la libertad-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>6. <?=$datos['quest'][11][7]['reactivo']?></label>
												<select name="<?=$datos['quest'][11][7]['react_id_reactivo']?>" data-value="<?=isset($options[11]['val_opc'])?$options[11]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema2">
													<option value="" selected disabled><?=$datos['quest'][11][7]['opc_nombre']?></option>
													<option <?=(isset($options[11]['id_opcion'])&&($options[11]['id_opcion'] == $datos['quest'][11][8]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][11][8]['opc_valor']?>" value="<?=$datos['quest'][11][8]['opc_id_opcion']?>"><?=$datos['quest'][11][8]['opc_nombre']?> (<?=$datos['quest'][11][8]['opc_valor']?>)</option>
													<option <?=(isset($options[11]['id_opcion'])&&($options[11]['id_opcion'] == $datos['quest'][11][9]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][11][9]['opc_valor']?>" value="<?=$datos['quest'][11][9]['opc_id_opcion']?>"><?=$datos['quest'][11][9]['opc_nombre']?> (<?=$datos['quest'][11][9]['opc_valor']?>)</option>
													<option <?=(isset($options[11]['id_opcion'])&&($options[11]['id_opcion'] == $datos['quest'][11][10]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][11][10]['opc_valor']?>" value="<?=$datos['quest'][11][10]['opc_id_opcion']?>"><?=$datos['quest'][11][10]['opc_nombre']?> (<?=$datos['quest'][11][10]['opc_valor']?>)</option>
													<option <?=(isset($options[11]['id_opcion'])&&($options[11]['id_opcion'] == $datos['quest'][11][11]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][11][11]['opc_valor']?>" value="<?=$datos['quest'][11][11]['opc_id_opcion']?>"><?=$datos['quest'][11][11]['opc_nombre']?> (<?=$datos['quest'][11][11]['opc_valor']?>)</option>
													<option <?=(isset($options[11]['id_opcion'])&&($options[11]['id_opcion'] == $datos['quest'][11][12]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][11][12]['opc_valor']?>" value="<?=$datos['quest'][11][12]['opc_id_opcion']?>"><?=$datos['quest'][11][12]['opc_nombre']?> (<?=$datos['quest'][11][12]['opc_valor']?>)</option>
												</select>
											</div>
										</div>

										<div class="form-group m-form__group row">
											<!--2. Apuñalar zonas vitales-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>2. <?=$datos['quest'][12][13]['reactivo']?></label>
												<select name="<?=$datos['quest'][12][13]['react_id_reactivo']?>" data-value="<?=isset($options[12]['val_opc'])?$options[12]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema3">
													<option value="" selected disabled><?=$datos['quest'][12][13]['opc_nombre']?></option>
													<option <?=(isset($options[12]['id_opcion'])&&($options[12]['id_opcion'] == $datos['quest'][12][14]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][12][14]['opc_valor']?>" value="<?=$datos['quest'][12][14]['opc_id_opcion']?>"><?=$datos['quest'][12][14]['opc_nombre']?> (<?=$datos['quest'][12][14]['opc_valor']?>)</option>
													<option <?=(isset($options[12]['id_opcion'])&&($options[12]['id_opcion'] == $datos['quest'][12][15]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][12][15]['opc_valor']?>" value="<?=$datos['quest'][12][15]['opc_id_opcion']?>"><?=$datos['quest'][12][15]['opc_nombre']?> (<?=$datos['quest'][12][15]['opc_valor']?>)</option>
													<option <?=(isset($options[12]['id_opcion'])&&($options[12]['id_opcion'] == $datos['quest'][12][16]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][12][16]['opc_valor']?>" value="<?=$datos['quest'][12][16]['opc_id_opcion']?>"><?=$datos['quest'][12][16]['opc_nombre']?> (<?=$datos['quest'][12][16]['opc_valor']?>)</option>
													<option <?=(isset($options[12]['id_opcion'])&&($options[12]['id_opcion'] == $datos['quest'][12][17]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][12][17]['opc_valor']?>" value="<?=$datos['quest'][12][17]['opc_id_opcion']?>"><?=$datos['quest'][12][17]['opc_nombre']?> (<?=$datos['quest'][12][17]['opc_valor']?>)</option>
													<option <?=(isset($options[12]['id_opcion'])&&($options[12]['id_opcion'] == $datos['quest'][12][18]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][12][18]['opc_valor']?>" value="<?=$datos['quest'][12][18]['opc_id_opcion']?>"><?=$datos['quest'][12][18]['opc_nombre']?> (<?=$datos['quest'][12][18]['opc_valor']?>)</option>
												</select>
											</div>
											<!--7. Violación-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>7. <?=$datos['quest'][13][19]['reactivo']?></label>
												<select name="<?=$datos['quest'][13][19]['react_id_reactivo']?>" data-value="<?=isset($options[13]['val_opc'])?$options[13]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema4">
													<option value="" selected disabled><?=$datos['quest'][13][19]['opc_nombre']?></option>
													<option <?=(isset($options[13]['id_opcion'])&&($options[13]['id_opcion'] == $datos['quest'][13][20]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][13][20]['opc_valor']?>" value="<?=$datos['quest'][13][20]['opc_id_opcion']?>"><?=$datos['quest'][13][20]['opc_nombre']?> (<?=$datos['quest'][13][20]['opc_valor']?>)</option>
													<option <?=(isset($options[13]['id_opcion'])&&($options[13]['id_opcion'] == $datos['quest'][13][21]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][13][21]['opc_valor']?>" value="<?=$datos['quest'][13][21]['opc_id_opcion']?>"><?=$datos['quest'][13][21]['opc_nombre']?> (<?=$datos['quest'][13][21]['opc_valor']?>)</option>
													<option <?=(isset($options[13]['id_opcion'])&&($options[13]['id_opcion'] == $datos['quest'][13][22]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][13][22]['opc_valor']?>" value="<?=$datos['quest'][13][22]['opc_id_opcion']?>"><?=$datos['quest'][13][22]['opc_nombre']?> (<?=$datos['quest'][13][22]['opc_valor']?>)</option>
													<option <?=(isset($options[13]['id_opcion'])&&($options[13]['id_opcion'] == $datos['quest'][13][23]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][13][23]['opc_valor']?>" value="<?=$datos['quest'][13][23]['opc_id_opcion']?>"><?=$datos['quest'][13][23]['opc_nombre']?> (<?=$datos['quest'][13][23]['opc_valor']?>)</option>
													<option <?=(isset($options[13]['id_opcion'])&&($options[13]['id_opcion'] == $datos['quest'][13][24]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][13][24]['opc_valor']?>" value="<?=$datos['quest'][13][24]['opc_id_opcion']?>"><?=$datos['quest'][13][24]['opc_nombre']?> (<?=$datos['quest'][13][24]['opc_valor']?>)</option>
												</select>
											</div>
										</div>

										<div class="form-group m-form__group row">
											<!--3. Quemaduras de segundo o tercer grado-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>3. <?=$datos['quest'][14][25]['reactivo']?></label>
												<select name="<?=$datos['quest'][14][25]['react_id_reactivo']?>" data-value="<?=isset($options[14]['val_opc'])?$options[14]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema5">
													<option value="" selected disabled><?=$datos['quest'][14][25]['opc_nombre']?></option>
													<option <?=(isset($options[14]['id_opcion'])&&($options[14]['id_opcion'] == $datos['quest'][14][26]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][14][26]['opc_valor']?>" value="<?=$datos['quest'][14][26]['opc_id_opcion']?>"><?=$datos['quest'][14][26]['opc_nombre']?> (<?=$datos['quest'][14][26]['opc_valor']?>)</option>
													<option <?=(isset($options[14]['id_opcion'])&&($options[14]['id_opcion'] == $datos['quest'][14][27]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][14][27]['opc_valor']?>" value="<?=$datos['quest'][14][27]['opc_id_opcion']?>"><?=$datos['quest'][14][27]['opc_nombre']?> (<?=$datos['quest'][14][27]['opc_valor']?>)</option>
													<option <?=(isset($options[14]['id_opcion'])&&($options[14]['id_opcion'] == $datos['quest'][14][28]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][14][28]['opc_valor']?>" value="<?=$datos['quest'][14][28]['opc_id_opcion']?>"><?=$datos['quest'][14][28]['opc_nombre']?> (<?=$datos['quest'][14][28]['opc_valor']?>)</option>
													<option <?=(isset($options[14]['id_opcion'])&&($options[14]['id_opcion'] == $datos['quest'][14][29]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][14][29]['opc_valor']?>" value="<?=$datos['quest'][14][29]['opc_id_opcion']?>"><?=$datos['quest'][14][29]['opc_nombre']?> (<?=$datos['quest'][14][29]['opc_valor']?>)</option>
													<option <?=(isset($options[14]['id_opcion'])&&($options[14]['id_opcion'] == $datos['quest'][14][30]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][14][30]['opc_valor']?>" value="<?=$datos['quest'][14][30]['opc_id_opcion']?>"><?=$datos['quest'][14][30]['opc_nombre']?> (<?=$datos['quest'][14][30]['opc_valor']?>)</option>
												</select>
											</div>
											<!--8. Aborto prematuro-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>8. <?=$datos['quest'][15][31]['reactivo']?></label>
												<select name="<?=$datos['quest'][15][31]['react_id_reactivo']?>" data-value="<?=isset($options[15]['val_opc'])?$options[15]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema6">
													<option value="" selected disabled><?=$datos['quest'][15][31]['opc_nombre']?></option>
													<option <?=(isset($options[15]['id_opcion'])&&($options[15]['id_opcion'] == $datos['quest'][15][32]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][15][32]['opc_valor']?>" value="<?=$datos['quest'][15][32]['opc_id_opcion']?>"><?=$datos['quest'][15][32]['opc_nombre']?> (<?=$datos['quest'][15][32]['opc_valor']?>)</option>
													<option <?=(isset($options[15]['id_opcion'])&&($options[15]['id_opcion'] == $datos['quest'][15][33]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][15][33]['opc_valor']?>" value="<?=$datos['quest'][15][33]['opc_id_opcion']?>"><?=$datos['quest'][15][33]['opc_nombre']?> (<?=$datos['quest'][15][33]['opc_valor']?>)</option>
													<option <?=(isset($options[15]['id_opcion'])&&($options[15]['id_opcion'] == $datos['quest'][15][34]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][15][34]['opc_valor']?>" value="<?=$datos['quest'][15][34]['opc_id_opcion']?>"><?=$datos['quest'][15][34]['opc_nombre']?> (<?=$datos['quest'][15][34]['opc_valor']?>)</option>
													<option <?=(isset($options[15]['id_opcion'])&&($options[15]['id_opcion'] == $datos['quest'][15][35]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][15][35]['opc_valor']?>" value="<?=$datos['quest'][15][35]['opc_id_opcion']?>"><?=$datos['quest'][15][35]['opc_nombre']?> (<?=$datos['quest'][15][35]['opc_valor']?>)</option>
													<option <?=(isset($options[15]['id_opcion'])&&($options[15]['id_opcion'] == $datos['quest'][15][36]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][15][36]['opc_valor']?>" value="<?=$datos['quest'][15][36]['opc_id_opcion']?>"><?=$datos['quest'][15][36]['opc_nombre']?> (<?=$datos['quest'][15][36]['opc_valor']?>)</option>
												</select>
											</div>
										</div>

										<div class="form-group m-form__group row">
											<!--4. Lesiones con armas de fuego-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>4. <?=$datos['quest'][16][37]['reactivo']?></label>
												<select name="<?=$datos['quest'][16][37]['react_id_reactivo']?>" data-value="<?=isset($options[16]['val_opc'])?$options[16]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema7">
													<option value="" selected disabled><?=$datos['quest'][16][37]['opc_nombre']?></option>
													<option <?=(isset($options[16]['id_opcion'])&&($options[16]['id_opcion'] == $datos['quest'][16][38]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][16][38]['opc_valor']?>" value="<?=$datos['quest'][16][38]['opc_id_opcion']?>"><?=$datos['quest'][16][38]['opc_nombre']?> (<?=$datos['quest'][16][38]['opc_valor']?>)</option>
													<option <?=(isset($options[16]['id_opcion'])&&($options[16]['id_opcion'] == $datos['quest'][16][39]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][16][39]['opc_valor']?>" value="<?=$datos['quest'][16][39]['opc_id_opcion']?>"><?=$datos['quest'][16][39]['opc_nombre']?> (<?=$datos['quest'][16][39]['opc_valor']?>)</option>
													<option <?=(isset($options[16]['id_opcion'])&&($options[16]['id_opcion'] == $datos['quest'][16][40]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][16][40]['opc_valor']?>" value="<?=$datos['quest'][16][40]['opc_id_opcion']?>"><?=$datos['quest'][16][40]['opc_nombre']?> (<?=$datos['quest'][16][40]['opc_valor']?>)</option>
													<option <?=(isset($options[16]['id_opcion'])&&($options[16]['id_opcion'] == $datos['quest'][16][41]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][16][41]['opc_valor']?>" value="<?=$datos['quest'][16][41]['opc_id_opcion']?>"><?=$datos['quest'][16][41]['opc_nombre']?> (<?=$datos['quest'][16][41]['opc_valor']?>)</option>
													<option <?=(isset($options[16]['id_opcion'])&&($options[16]['id_opcion'] == $datos['quest'][16][42]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][16][42]['opc_valor']?>" value="<?=$datos['quest'][16][42]['opc_id_opcion']?>"><?=$datos['quest'][16][42]['opc_nombre']?> (<?=$datos['quest'][16][42]['opc_valor']?>)</option>
												</select>
											</div>
											<!--9. Intento de asfixia o estrangulamiento-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>9. <?=$datos['quest'][17][43]['reactivo']?></label>
												<select name="<?=$datos['quest'][17][43]['react_id_reactivo']?>" data-value="<?=isset($options[17]['val_opc'])?$options[17]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema8">
													<option value="" selected disabled><?=$datos['quest'][17][43]['opc_nombre']?></option>
													<option <?=(isset($options[17]['id_opcion'])&&($options[17]['id_opcion'] == $datos['quest'][17][44]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][17][44]['opc_valor']?>" value="<?=$datos['quest'][17][44]['opc_id_opcion']?>"><?=$datos['quest'][17][44]['opc_nombre']?> (<?=$datos['quest'][17][44]['opc_valor']?>)</option>
													<option <?=(isset($options[17]['id_opcion'])&&($options[17]['id_opcion'] == $datos['quest'][17][45]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][17][45]['opc_valor']?>" value="<?=$datos['quest'][17][45]['opc_id_opcion']?>"><?=$datos['quest'][17][45]['opc_nombre']?> (<?=$datos['quest'][17][45]['opc_valor']?>)</option>
													<option <?=(isset($options[17]['id_opcion'])&&($options[17]['id_opcion'] == $datos['quest'][17][46]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][17][46]['opc_valor']?>" value="<?=$datos['quest'][17][46]['opc_id_opcion']?>"><?=$datos['quest'][17][46]['opc_nombre']?> (<?=$datos['quest'][17][46]['opc_valor']?>)</option>
													<option <?=(isset($options[17]['id_opcion'])&&($options[17]['id_opcion'] == $datos['quest'][17][47]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][17][47]['opc_valor']?>" value="<?=$datos['quest'][17][47]['opc_id_opcion']?>"><?=$datos['quest'][17][47]['opc_nombre']?> (<?=$datos['quest'][17][47]['opc_valor']?>)</option>
													<option <?=(isset($options[17]['id_opcion'])&&($options[17]['id_opcion'] == $datos['quest'][17][48]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][17][48]['opc_valor']?>" value="<?=$datos['quest'][17][48]['opc_id_opcion']?>"><?=$datos['quest'][17][48]['opc_nombre']?> (<?=$datos['quest'][17][48]['opc_valor']?>)</option>
												</select>
											</div>
										</div>

										<div class="form-group m-form__group row">
											<!--5. Otras lesiones que pusieron en riesgo su vida-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>5. <?=$datos['quest'][18][49]['reactivo']?></label>
												<select name="<?=$datos['quest'][18][49]['react_id_reactivo']?>" data-value="<?=isset($options[18]['val_opc'])?$options[18]['val_opc']:0?>" class="counter form-control m-input m-input--square violencia_extrema9">
													<option value="" selected disabled><?=$datos['quest'][18][49]['opc_nombre']?></option>
													<option <?=(isset($options[18]['id_opcion'])&&($options[18]['id_opcion'] == $datos['quest'][18][50]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][18][50]['opc_valor']?>" value="<?=$datos['quest'][18][50]['opc_id_opcion']?>"><?=$datos['quest'][18][50]['opc_nombre']?> (<?=$datos['quest'][18][50]['opc_valor']?>)</option>
													<option <?=(isset($options[18]['id_opcion'])&&($options[18]['id_opcion'] == $datos['quest'][18][51]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][18][51]['opc_valor']?>" value="<?=$datos['quest'][18][51]['opc_id_opcion']?>"><?=$datos['quest'][18][51]['opc_nombre']?> (<?=$datos['quest'][18][51]['opc_valor']?>)</option>
													<option <?=(isset($options[18]['id_opcion'])&&($options[18]['id_opcion'] == $datos['quest'][18][52]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][18][52]['opc_valor']?>" value="<?=$datos['quest'][18][52]['opc_id_opcion']?>"><?=$datos['quest'][18][52]['opc_nombre']?> (<?=$datos['quest'][18][52]['opc_valor']?>)</option>
													<option <?=(isset($options[18]['id_opcion'])&&($options[18]['id_opcion'] == $datos['quest'][18][53]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][18][53]['opc_valor']?>" value="<?=$datos['quest'][18][53]['opc_id_opcion']?>"><?=$datos['quest'][18][53]['opc_nombre']?> (<?=$datos['quest'][18][53]['opc_valor']?>)</option>
													<option <?=(isset($options[18]['id_opcion'])&&($options[18]['id_opcion'] == $datos['quest'][18][54]['opc_id_opcion']))?'selected':''?> data-opc_valor="<?=$datos['quest'][18][54]['opc_valor']?>" value="<?=$datos['quest'][18][54]['opc_id_opcion']?>"><?=$datos['quest'][18][54]['opc_nombre']?> (<?=$datos['quest'][18][54]['opc_valor']?>)</option>
												</select>
											</div>
											<!--10. Ninguna opcion-->
											<div class="col-xl-6 col-lg-6 m-form__group-sub">
												<label>10. Ninguna opción</label>
												<div>
													<span class="m-switch m-switch--outline m-switch--brand">
														<label>
															<input type="checkbox" id="sin_violencia">
															<span></span>
														</label>
													</span>
												</div>
											</div>
										</div>

									</div>
								</div>
<!--ANTECEDENTES-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_3">
									<div class="m-form__section m-form__section--first">
										<!--II. Antecedentes de violencia psicológica, física y sexual-->
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">II. <?=$datos['quest'][19][55]['subgrupo']?></h3>
										</div>

										<div class="form-group m-form__group row" id="counter2" data-value="<?=isset($options[19]['val_opc'])?$options[19]['val_opc']:0?>">
											<!--1. ¿Ha solicitado medidas de protección o presentado alguna denuncia previa contra él?-->
											<label class="col-xl-6 col-lg-6 col-form-label">1. <?=$datos['quest'][19][55]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No-->
														<input class="counter2" data-opc_valor="<?=$datos['quest'][19][55]['opc_valor']?>" type="radio" name="<?=$datos['quest'][19][55]['react_id_reactivo']?>" <?=((isset($options[19]['id_opcion']))&&($options[19]['id_opcion'] == $datos['quest'][19][55]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][19][55]['opc_id_opcion']?>"> (<?=$datos['quest'][19][55]['opc_valor']?>) <?=$datos['quest'][19][55]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Sí-->
														<input class="counter2" data-opc_valor="<?=$datos['quest'][19][56]['opc_valor']?>" type="radio" name="<?=$datos['quest'][19][56]['react_id_reactivo']?>" <?=((isset($options[19]['id_opcion']))&&($options[19]['id_opcion'] == $datos['quest'][19][56]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][19][56]['opc_id_opcion']?>"> (<?=$datos['quest'][19][56]['opc_valor']?>) <?=$datos['quest'][19][56]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row" id="counter3" data-value="<?=isset($options[20]['val_opc'])?$options[20]['val_opc']:0?>">
											<!--2. ¿Con qué frecuencia su pareja o ex pareja le agredió física o psicológicamente, en el último año?-->
											<label class="col-xl-6 col-lg-6 col-form-label">2. <?=$datos['quest'][20][57]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<!--No-->
														<input class="counter3" data-opc_valor="<?=$datos['quest'][20][57]['opc_valor']?>" type="radio" name="<?=$datos['quest'][20][57]['react_id_reactivo']?>" <?=((isset($options[20]['id_opcion']))&&($options[20]['id_opcion'] == $datos['quest'][20][57]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][20][57]['opc_id_opcion']?>"> (<?=$datos['quest'][20][57]['opc_valor']?>) <?=$datos['quest'][20][57]['opc_nombre']?>
														<span></span>
													</label>
													<!--En ocasiones-->
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input class="counter3" data-opc_valor="<?=$datos['quest'][20][58]['opc_valor']?>" type="radio" name="<?=$datos['quest'][20][58]['react_id_reactivo']?>" <?=((isset($options[20]['id_opcion']))&&($options[20]['id_opcion'] == $datos['quest'][20][58]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][20][58]['opc_id_opcion']?>"> (<?=$datos['quest'][20][58]['opc_valor']?>) <?=$datos['quest'][20][58]['opc_nombre']?>
														<span></span>
													</label>
													<!--Mensual-->
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input class="counter3" data-opc_valor="<?=$datos['quest'][20][59]['opc_valor']?>" type="radio" name="<?=$datos['quest'][20][59]['react_id_reactivo']?>" <?=((isset($options[20]['id_opcion']))&&($options[20]['id_opcion'] == $datos['quest'][20][59]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][20][59]['opc_id_opcion']?>"> (<?=$datos['quest'][20][59]['opc_valor']?>) <?=$datos['quest'][20][59]['opc_nombre']?>
														<span></span>
													</label>
													<!--Diario Semanal-->
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input class="counter3" data-opc_valor="<?=$datos['quest'][20][60]['opc_valor']?>" type="radio" name="<?=$datos['quest'][20][60]['react_id_reactivo']?>" <?=((isset($options[20]['id_opcion']))&&($options[20]['id_opcion'] == $datos['quest'][20][60]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][20][60]['opc_id_opcion']?>"> (<?=$datos['quest'][20][60]['opc_valor']?>) <?=$datos['quest'][20][60]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row" id="counter4" data-value="<?=isset($options[21]['val_opc'])?$options[21]['val_opc']:0?>">
											<!--3. En el último año, ¿las agresiones se han incrementado?-->
											<label class="col-xl-6 col-lg-6 col-form-label">3. <?=$datos['quest'][21][61]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<!--No-->
													<label class="m-radio m-radio--solid m-radio--brand">
														<input class="counter4" data-opc_valor="<?=$datos['quest'][21][61]['opc_valor']?>" type="radio" name="<?=$datos['quest'][21][61]['react_id_reactivo']?>" <?=((isset($options[21]['id_opcion']))&&($options[21]['id_opcion'] == $datos['quest'][21][61]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][21][61]['opc_id_opcion']?>"> (<?=$datos['quest'][21][61]['opc_valor']?>) <?=$datos['quest'][21][61]['opc_nombre']?>
														<span></span>
													</label>
													<!--Si-->
													<label class="m-radio m-radio--solid m-radio--brand">
														<input class="counter4" data-opc_valor="<?=$datos['quest'][21][62]['opc_valor']?>" type="radio" name="<?=$datos['quest'][21][62]['react_id_reactivo']?>" <?=((isset($options[21]['id_opcion']))&&($options[21]['id_opcion'] == $datos['quest'][21][62]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][21][62]['opc_id_opcion']?>"> (<?=$datos['quest'][21][62]['opc_valor']?>) <?=$datos['quest'][21][62]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row" id="counter5" data-value="<?=isset($options[22]['val_opc'])?$options[22]['val_opc']:0?>">
											<!--4. ¿Qué tipo de lesiones le causaron las agresiones físicas recibidas en este último año?-->
											<label class="col-xl-6 col-lg-6 col-form-label">4. <?=$datos['quest'][22][63]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6 row">
												<div class="m-radio-inline">
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<!--Ninguna-->
														<input class="counter5" data-opc_valor="<?=$datos['quest'][22][63]['opc_valor']?>" type="radio" name="<?=$datos['quest'][22][63]['react_id_reactivo']?>" <?=((isset($options[22]['id_opcion']))&&($options[22]['id_opcion'] == $datos['quest'][22][63]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][22][63]['opc_id_opcion']?>"> (<?=$datos['quest'][22][63]['opc_valor']?>) <?=$datos['quest'][22][63]['opc_nombre']?>
														<span></span>
													</label>
													<!--Lesiones como moretones o rasguños-->
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input class="counter5" data-opc_valor="<?=$datos['quest'][22][64]['opc_valor']?>"  type="radio" name="<?=$datos['quest'][22][64]['react_id_reactivo']?>"  <?=((isset($options[22]['id_opcion']))&&($options[22]['id_opcion'] == $datos['quest'][22][64]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][22][64]['opc_id_opcion']?>"> (<?=$datos['quest'][22][64]['opc_valor']?>) <?=$datos['quest'][22][64]['opc_nombre']?>
														<span></span>
													</label>
													<!--Lesiones como fracturas, golpes sin compromisos de zonas vitales-->
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input class="counter5" data-opc_valor="<?=$datos['quest'][22][65]['opc_valor']?>"  type="radio" name="<?=$datos['quest'][22][65]['react_id_reactivo']?>"  <?=((isset($options[22]['id_opcion']))&&($options[22]['id_opcion'] == $datos['quest'][22][65]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][22][65]['opc_id_opcion']?>"> (<?=$datos['quest'][22][65]['opc_valor']?>) <?=$datos['quest'][22][65]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row" id="counter6" data-value="<?=isset($options[23]['val_opc'])?$options[23]['val_opc']:0?>">
											<!--5. ¿Usted conoce si su pareja o ex pareja tiene antecedentes de haber agredido físicamente a sus ex parejas?-->
											<label class="col-xl-6 col-lg-6 col-form-label">5. <?=$datos['quest'][23][66]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No-->
														<input class="counter6" data-opc_valor="<?=$datos['quest'][23][66]['opc_valor']?>" type="radio" name="<?=$datos['quest'][23][66]['react_id_reactivo']?>" <?=((isset($options[23]['id_opcion']))&&($options[23]['id_opcion'] == $datos['quest'][23][66]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][23][66]['opc_id_opcion']?>"> (<?=$datos['quest'][23][66]['opc_valor']?>) <?=$datos['quest'][23][66]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Si-->
														<input class="counter6" data-opc_valor="<?=$datos['quest'][23][67]['opc_valor']?>" type="radio" name="<?=$datos['quest'][23][67]['react_id_reactivo']?>" <?=((isset($options[23]['id_opcion']))&&($options[23]['id_opcion'] == $datos['quest'][23][67]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][23][67]['opc_id_opcion']?>"> (<?=$datos['quest'][23][67]['opc_valor']?>) <?=$datos['quest'][23][67]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Desconoce-->
														<input class="counter6" data-opc_valor="<?=$datos['quest'][23][68]['opc_valor']?>" type="radio" name="<?=$datos['quest'][23][68]['react_id_reactivo']?>" <?=((isset($options[23]['id_opcion']))&&($options[23]['id_opcion'] == $datos['quest'][23][68]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][23][68]['opc_id_opcion']?>"> (<?=$datos['quest'][23][68]['opc_valor']?>) <?=$datos['quest'][23][68]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row" id="counter7" data-value="<?=isset($options[24]['val_opc'])?$options[24]['val_opc']:0?>">
											<!--6. ¿Su pareja o ex pareja ejerce violencia contra sus hijos/as, familiares u otras personas?-->
											<label class="col-xl-6 col-lg-6 col-form-label">6. <?=$datos['quest'][24][69]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No-->
														<input class="counter7" data-opc_valor="<?=$datos['quest'][24][69]['opc_valor']?>" type="radio" name="<?=$datos['quest'][24][69]['react_id_reactivo']?>" <?=((isset($options[24]['id_opcion']))&&($options[24]['id_opcion'] == $datos['quest'][24][69]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][24][69]['opc_id_opcion']?>"> (<?=$datos['quest'][24][69]['opc_valor']?>) <?=$datos['quest'][24][69]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Si-->
														<input class="counter7" data-opc_valor="<?=$datos['quest'][24][70]['opc_valor']?>" type="radio" name="<?=$datos['quest'][24][70]['react_id_reactivo']?>" <?=((isset($options[24]['id_opcion']))&&($options[24]['id_opcion'] == $datos['quest'][24][70]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][24][70]['opc_id_opcion']?>"> (<?=$datos['quest'][24][70]['opc_valor']?>) <?=$datos['quest'][24][70]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Desconoce-->
														<input class="counter7" data-opc_valor="<?=$datos['quest'][24][71]['opc_valor']?>" type="radio" name="<?=$datos['quest'][24][71]['react_id_reactivo']?>" <?=((isset($options[24]['id_opcion']))&&($options[24]['id_opcion'] == $datos['quest'][24][71]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][24][71]['opc_id_opcion']?>"> (<?=$datos['quest'][24][71]['opc_valor']?>) <?=$datos['quest'][24][71]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row" id="counter8" data-value="<?=isset($options[25]['val_opc'])?$options[25]['val_opc']:0?>">
											<!--7. ¿Su pareja o ex pareja le ha obligado alguna vez a tener relaciones sexuales?-->
											<label class="col-xl-6 col-lg-6 col-form-label">7. <?=$datos['quest'][25][72]['reactivo']?></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No-->
														<input class="counter8" data-opc_valor="<?=$datos['quest'][25][72]['opc_valor']?>" type="radio" name="<?=$datos['quest'][25][72]['react_id_reactivo']?>" <?=((isset($options[25]['id_opcion']))&&($options[25]['id_opcion'] == $datos['quest'][25][72]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][25][72]['opc_id_opcion']?>"> (<?=$datos['quest'][25][72]['opc_valor']?>) <?=$datos['quest'][25][72]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Sí-->
														<input class="counter8" data-opc_valor="<?=$datos['quest'][25][73]['opc_valor']?>" type="radio" name="<?=$datos['quest'][25][73]['react_id_reactivo']?>" <?=((isset($options[25]['id_opcion']))&&($options[25]['id_opcion'] == $datos['quest'][25][73]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][25][73]['opc_id_opcion']?>"> (<?=$datos['quest'][25][73]['opc_valor']?>) <?=$datos['quest'][25][73]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

									</div>
								</div>
<!--AMENAZAS-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_4">
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<!--III. Amenazas-->
											<h3 class="m-form__heading-title">III. <?=$datos['quest'][26][74]['subgrupo']?></h3>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter9" data-value="<?=isset($options[26]['val_opc'])?$options[26]['val_opc']:0?>">
										<!--8. ¿Su pareja o ex pareja le ha amenazado de muerte? ¿De qué manera le ha amenazado?-->
										<label class="col-xl-6 col-lg-6 col-form-label">8. <?=$datos['quest'][26][74]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6 row">
											<div class="m-radio-inline">
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter9" data-opc_valor="<?=$datos['quest'][26][74]['opc_valor']?>" type="radio" name="<?=$datos['quest'][26][74]['react_id_reactivo']?>" <?=((isset($options[26]['id_opcion']))&&($options[26]['id_opcion'] == $datos['quest'][26][74]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][26][74]['opc_id_opcion']?>"> (<?=$datos['quest'][26][74]['opc_valor']?>) <?=$datos['quest'][26][74]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Amenaza enviando mensajes por diversos medios (teléfono, email, notas)-->
													<input class="counter9" data-opc_valor="<?=$datos['quest'][26][75]['opc_valor']?>" type="radio" name="<?=$datos['quest'][26][75]['react_id_reactivo']?>" <?=((isset($options[26]['id_opcion']))&&($options[26]['id_opcion'] == $datos['quest'][26][75]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][26][75]['opc_id_opcion']?>"> (<?=$datos['quest'][26][75]['opc_valor']?>) <?=$datos['quest'][26][75]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Amenaza verbal con o sin testigos. (hogar o espacios públicos)-->
													<input class="counter9" data-opc_valor="<?=$datos['quest'][26][76]['opc_valor']?>" type="radio" name="<?=$datos['quest'][26][76]['react_id_reactivo']?>" <?=((isset($options[26]['id_opcion']))&&($options[26]['id_opcion'] == $datos['quest'][26][76]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][26][76]['opc_id_opcion']?>"> (<?=$datos['quest'][26][76]['opc_valor']?>) <?=$datos['quest'][26][76]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Amenaza usando objetos o armas de cualquier tipo-->
													<input class="counter9" data-opc_valor="<?=$datos['quest'][26][77]['opc_valor']?>" type="radio" name="<?=$datos['quest'][26][77]['react_id_reactivo']?>" <?=((isset($options[26]['id_opcion']))&&($options[26]['id_opcion'] == $datos['quest'][26][77]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][26][77]['opc_id_opcion']?>"> (<?=$datos['quest'][26][77]['opc_valor']?>) <?=$datos['quest'][26][77]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter10" data-value="<?=isset($options[27]['val_opc'])?$options[27]['val_opc']:0?>">
										<!--9. ¿Usted cree que su pareja o ex pareja la pueda matar?-->
										<label class="col-xl-6 col-lg-6 col-form-label">9. <?=$datos['quest'][27][78]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter10" data-opc_valor="<?=$datos['quest'][27][78]['opc_valor']?>" type="radio" name="<?=$datos['quest'][27][78]['react_id_reactivo']?>" <?=((isset($options[27]['id_opcion']))&&($options[27]['id_opcion'] == $datos['quest'][27][78]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][27][78]['opc_id_opcion']?>"> (<?=$datos['quest'][27][78]['opc_valor']?>) <?=$datos['quest'][27][78]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--Si-->
													<input class="counter10" data-opc_valor="<?=$datos['quest'][27][79]['opc_valor']?>" type="radio" name="<?=$datos['quest'][27][79]['react_id_reactivo']?>" <?=((isset($options[27]['id_opcion']))&&($options[27]['id_opcion'] == $datos['quest'][27][79]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][27][79]['opc_id_opcion']?>"> (<?=$datos['quest'][27][79]['opc_valor']?>) <?=$datos['quest'][27][79]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

								</div>
<!--CONTROL EXTREMO-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_5">
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">IV. <?=$datos['quest'][28][80]['subgrupo']?></h3>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter11" data-value="<?=isset($options[28]['val_opc'])?$options[28]['val_opc']:0?>">
										<!--10. ¿Usted considera que su pareja o ex pareja es celoso?-->
										<label class="col-xl-6 col-lg-6 col-form-label">10. <?=$datos['quest'][28][80]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter11" data-opc_valor="<?=$datos['quest'][28][80]['opc_valor']?>" type="radio" name="<?=$datos['quest'][28][80]['react_id_reactivo']?>" <?=((isset($options[28]['id_opcion']))&&($options[28]['id_opcion'] == $datos['quest'][28][80]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][28][80]['opc_id_opcion']?>"> (<?=$datos['quest'][28][80]['opc_valor']?>) <?=$datos['quest'][28][80]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--Si-->
													<input class="counter11" data-opc_valor="<?=$datos['quest'][28][81]['opc_valor']?>" type="radio" name="<?=$datos['quest'][28][81]['react_id_reactivo']?>" <?=((isset($options[28]['id_opcion']))&&($options[28]['id_opcion'] == $datos['quest'][28][81]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][28][81]['opc_id_opcion']?>"> (<?=$datos['quest'][28][81]['opc_valor']?>) <?=$datos['quest'][28][81]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group m-form__group row" id="counter12" data-value="<?=isset($options[29]['val_opc'])?$options[29]['val_opc']:0?>">
										<!--11. ¿Su pareja o ex pareja le ha dicho o cree que usted le engaña?-->
										<label class="col-xl-6 col-lg-6 col-form-label">11. <?=$datos['quest'][29][82]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6 row">
											<div class="m-radio-inline">
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--NO le ha dicho nada-->
													<input class="counter12" data-opc_valor="<?=$datos['quest'][29][82]['opc_valor']?>" type="radio" name="<?=$datos['quest'][29][82]['react_id_reactivo']?>" <?=((isset($options[29]['id_opcion']))&&($options[29]['id_opcion'] == $datos['quest'][29][82]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][29][82]['opc_id_opcion']?>"> (<?=$datos['quest'][29][82]['opc_valor']?>) <?=$datos['quest'][29][82]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--NO le ha dicho, pero cree-->
													<input class="counter12" data-opc_valor="<?=$datos['quest'][29][83]['opc_valor']?>" type="radio" name="<?=$datos['quest'][29][83]['react_id_reactivo']?>" <?=((isset($options[29]['id_opcion']))&&($options[29]['id_opcion'] == $datos['quest'][29][83]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][29][83]['opc_id_opcion']?>"> (<?=$datos['quest'][29][83]['opc_valor']?>) <?=$datos['quest'][29][83]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--SI le ha dicho que le engaña-->
													<input class="counter12" data-opc_valor="<?=$datos['quest'][29][84]['opc_valor']?>" type="radio" name="<?=$datos['quest'][29][84]['react_id_reactivo']?>" <?=((isset($options[29]['id_opcion']))&&($options[29]['id_opcion'] == $datos['quest'][29][84]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][29][84]['opc_id_opcion']?>"> (<?=$datos['quest'][29][84]['opc_valor']?>) <?=$datos['quest'][29][84]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group m-form__group row" id="counter13" data-value="<?=isset($options[30]['val_opc'])?$options[30]['val_opc']:0?>">
										<!--12. ¿Su pareja o ex pareja hace alguna de estas acciones para controla?-->
										<label class="col-xl-6 col-lg-6 col-form-label">
												12. <?=$datos['quest'][30][85]['reactivo']?> <br>
											<span><?=$datos['quest'][30][85]['react_ayuda']?></span>
										</label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Controla su forma de vestir y salidas del hogar-->
													<input class="counter13" data-opc_valor="<?=$datos['quest'][30][86]['opc_valor']?>" type="radio" name="<?=$datos['quest'][30][86]['react_id_reactivo']?>" <?=((isset($options[30]['id_opcion']))&&($options[30]['id_opcion'] == $datos['quest'][30][86]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][30][86]['opc_id_opcion']?>"> (<?=$datos['quest'][30][86]['opc_valor']?>) <?=$datos['quest'][30][86]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--La aísla de amistades y familiares-->
													<input class="counter13" data-opc_valor="<?=$datos['quest'][30][87]['opc_valor']?>" type="radio" name="<?=$datos['quest'][30][87]['react_id_reactivo']?>" <?=((isset($options[30]['id_opcion']))&&($options[30]['id_opcion'] == $datos['quest'][30][87]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][30][87]['opc_id_opcion']?>"> (<?=$datos['quest'][30][87]['opc_valor']?>) <?=$datos['quest'][30][87]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Restringe acceso a servicios de salud, trabajo o estudio.-->
													<input class="counter13" data-opc_valor="<?=$datos['quest'][30][88]['opc_valor']?>" type="radio" name="<?=$datos['quest'][30][88]['react_id_reactivo']?>" <?=((isset($options[30]['id_opcion']))&&($options[30]['id_opcion'] == $datos['quest'][30][88]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][30][88]['opc_id_opcion']?>"> (<?=$datos['quest'][30][88]['opc_valor']?>) <?=$datos['quest'][30][88]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--no-->
													<input class="counter13" data-opc_valor="<?=$datos['quest'][30][85]['opc_valor']?>" type="radio" name="<?=$datos['quest'][30][85]['react_id_reactivo']?>" <?=((isset($options[30]['id_opcion']))&&($options[30]['id_opcion'] == $datos['quest'][30][85]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][30][85]['opc_id_opcion']?>"> (<?=$datos['quest'][30][85]['opc_valor']?>) <?=$datos['quest'][30][85]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group m-form__group row" id="counter14" data-value="<?=isset($options[31]['val_opc'])?$options[31]['val_opc']:0?>">
										<!--13. ¿Su pareja o ex pareja desconfía de usted o la acosa? ¿Cómo le muestra su desconfianza o acoso?-->
										<label class="col-xl-6 col-lg-6 col-form-label">
													13. <?=$datos['quest'][31][89]['reactivo']?> <br>
											<span><?=$datos['quest'][31][89]['react_ayuda']?></span>
										</label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Llamadas insistentes y/o mensajes por diversos medios-->
													<input class="counter14" data-opc_valor="<?=$datos['quest'][31][90]['opc_valor']?>" type="radio" name="<?=$datos['quest'][31][90]['react_id_reactivo']?>" <?=((isset($options[31]['id_opcion']))&&($options[31]['id_opcion'] == $datos['quest'][31][90]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][31][90]['opc_id_opcion']?>"> (<?=$datos['quest'][31][90]['opc_valor']?>) <?=$datos['quest'][31][90]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Invade su privacidad (revisa llamadas y mensajes telefónicos, correo electrónico, etc.)-->
													<input class="counter14" data-opc_valor="<?=$datos['quest'][31][91]['opc_valor']?>" type="radio" name="<?=$datos['quest'][31][91]['react_id_reactivo']?>" <?=((isset($options[31]['id_opcion']))&&($options[31]['id_opcion'] == $datos['quest'][31][91]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][31][91]['opc_id_opcion']?>"> (<?=$datos['quest'][31][91]['opc_valor']?>) <?=$datos['quest'][31][91]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--La sigue o espía por lugares donde frecuenta (centro laboral, de estudios, etc.)-->
													<input class="counter14" data-opc_valor="<?=$datos['quest'][31][92]['opc_valor']?>" type="radio" name="<?=$datos['quest'][31][92]['react_id_reactivo']?>" <?=((isset($options[31]['id_opcion']))&&($options[31]['id_opcion'] == $datos['quest'][31][92]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][31][92]['opc_id_opcion']?>"> (<?=$datos['quest'][31][92]['opc_valor']?>) <?=$datos['quest'][31][92]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter14" data-opc_valor="<?=$datos['quest'][31][89]['opc_valor']?>" type="radio" name="<?=$datos['quest'][31][89]['react_id_reactivo']?>" <?=((isset($options[31]['id_opcion']))&&($options[31]['id_opcion'] == $datos['quest'][31][89]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][31][89]['opc_id_opcion']?>"> (<?=$datos['quest'][31][89]['opc_valor']?>) <?=$datos['quest'][31][89]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group m-form__group row" id="counter15" data-value="<?=isset($options[32]['val_opc'])?$options[32]['val_opc']:0?>">
										<!--14. ¿Su pareja o ex pareja utiliza a sus hijos/as para mantenerla a usted bajo control?-->
										<label class="col-xl-6 col-lg-6 col-form-label">14. <?=$datos['quest'][32][93]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter15" data-opc_valor="<?=$datos['quest'][32][93]['opc_valor']?>" type="radio" name="<?=$datos['quest'][32][93]['react_id_reactivo']?>" <?=((isset($options[32]['id_opcion']))&&($options[32]['id_opcion'] == $datos['quest'][32][93]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][32][93]['opc_id_opcion']?>"> (<?=$datos['quest'][32][93]['opc_valor']?>) <?=$datos['quest'][32][93]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--si-->
													<input class="counter15" data-opc_valor="<?=$datos['quest'][32][94]['opc_valor']?>" type="radio" name="<?=$datos['quest'][32][94]['react_id_reactivo']?>" <?=((isset($options[32]['id_opcion']))&&($options[32]['id_opcion'] == $datos['quest'][32][94]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][32][94]['opc_id_opcion']?>"> (<?=$datos['quest'][32][94]['opc_valor']?>) <?=$datos['quest'][32][94]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>
								</div>
<!--AGRAVANTES-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_6">
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">V. <?=$datos['quest'][33][95]['subgrupo']?></h3>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter16" data-value="<?=isset($options[33]['val_opc'])?$options[33]['val_opc']:0?>">
										<!--15. ¿Le ha dicho a su pareja que quiere separse de él? En caso de que haberlo hecho, ¿cómo reaccionó él?-->
										<label class="col-xl-6 col-lg-6 col-form-label">
														15. <?=$datos['quest'][33][95]['reactivo']?> <br>
											<span><?=$datos['quest'][33][95]['react_ayuda']?></span>
										</label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter16" data-opc_valor="<?=$datos['quest'][33][95]['opc_valor']?>" type="radio" name="<?=$datos['quest'][33][95]['react_id_reactivo']?>" <?=((isset($options[33]['id_opcion']))&&($options[33]['id_opcion'] == $datos['quest'][33][95]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][33][95]['opc_id_opcion']?>"> (<?=$datos['quest'][33][95]['opc_valor']?>) <?=$datos['quest'][33][95]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Aceptó separarse sin ningún problema-->
													<input class="counter16" data-opc_valor="<?=$datos['quest'][33][96]['opc_valor']?>" type="radio" name="<?=$datos['quest'][33][96]['react_id_reactivo']?>" <?=((isset($options[33]['id_opcion']))&&($options[33]['id_opcion'] == $datos['quest'][33][96]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][33][96]['opc_id_opcion']?>"> (<?=$datos['quest'][33][96]['opc_valor']?>) <?=$datos['quest'][33][96]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--Aceptó separarse pero no desea retirarse de la casa-->
													<input class="counter16" data-opc_valor="<?=$datos['quest'][33][97]['opc_valor']?>" type="radio" name="<?=$datos['quest'][33][97]['react_id_reactivo']?>" <?=((isset($options[33]['id_opcion']))&&($options[33]['id_opcion'] == $datos['quest'][33][97]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][33][97]['opc_id_opcion']?>"> (<?=$datos['quest'][33][97]['opc_valor']?>) <?=$datos['quest'][33][97]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--No aceptó separarse. Insiste en continuar con la relación-->
													<input class="counter16" data-opc_valor="<?=$datos['quest'][33][98]['opc_valor']?>" type="radio" name="<?=$datos['quest'][33][98]['react_id_reactivo']?>" <?=((isset($options[33]['id_opcion']))&&($options[33]['id_opcion'] == $datos['quest'][33][98]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][33][98]['opc_id_opcion']?>"> (<?=$datos['quest'][33][98]['opc_valor']?>) <?=$datos['quest'][33][98]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--No aceptó separarse, la amenaza con hacerle daño o matar a sus hijos/as-->
													<input class="counter16" data-opc_valor="<?=$datos['quest'][33][99]['opc_valor']?>" type="radio" name="<?=$datos['quest'][33][99]['react_id_reactivo']?>" <?=((isset($options[33]['id_opcion']))&&($options[33]['id_opcion'] == $datos['quest'][33][99]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][33][99]['opc_id_opcion']?>"> (<?=$datos['quest'][33][99]['opc_valor']?>) <?=$datos['quest'][33][99]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter17" data-value="<?=isset($options[34]['val_opc'])?$options[34]['val_opc']:0?>">
										<!--¿Actualmente vive usted con su pareja?-->
										<label class="col-xl-6 col-lg-6 col-form-label">16. <?=$datos['quest'][34][100]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6 row">
											<div class="m-radio-inline">
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--SÍ, viven juntos-->
													<input class="counter17 validacion_cruzada_1a" data-opc_valor="<?=$datos['quest'][34][100]['opc_valor']?>" type="radio" name="<?=$datos['quest'][34][100]['react_id_reactivo']?>" <?=((isset($options[34]['id_opcion']))&&($options[34]['id_opcion'] == $datos['quest'][34][100]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][34][100]['opc_id_opcion']?>"> (<?=$datos['quest'][34][100]['opc_valor']?>) <?=$datos['quest'][34][100]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--NO, ya no viven juntos, pero insiste en retomar la relación-->
													<input class="counter17 validacion_cruzada_1a" data-opc_valor="<?=$datos['quest'][34][101]['opc_valor']?>" type="radio" name="<?=$datos['quest'][34][101]['react_id_reactivo']?>" <?=((isset($options[34]['id_opcion']))&&($options[34]['id_opcion'] == $datos['quest'][34][101]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][34][101]['opc_id_opcion']?>"> (<?=$datos['quest'][34][101]['opc_valor']?>) <?=$datos['quest'][34][101]['opc_nombre']?>
													<span></span>
												</label>
												<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
													<!--NO, ya no viven juntos, y no insiste en retomar la relación-->
													<input class="counter17 validacion_cruzada_1a" data-opc_valor="<?=$datos['quest'][34][102]['opc_valor']?>" type="radio" name="<?=$datos['quest'][34][102]['react_id_reactivo']?>" <?=((isset($options[34]['id_opcion']))&&($options[34]['id_opcion'] == $datos['quest'][34][102]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][34][102]['opc_id_opcion']?>"> (<?=$datos['quest'][34][102]['opc_valor']?>) <?=$datos['quest'][34][102]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter18" data-value="<?=isset($options[35]['val_opc'])?$options[35]['val_opc']:0?>">
										<!--17. ¿Su pareja es consumidor habitual de alcohol o drogas? (Diario, semanal, mensual)-->
										<label class="col-xl-6 col-lg-6 col-form-label">17. <?=$datos['quest'][35][103]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter18" data-opc_valor="<?=$datos['quest'][35][103]['opc_valor']?>" type="radio" name="<?=$datos['quest'][35][103]['react_id_reactivo']?>" <?=((isset($options[35]['id_opcion']))&&($options[35]['id_opcion'] == $datos['quest'][35][103]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][35][103]['opc_id_opcion']?>"> (<?=$datos['quest'][35][103]['opc_valor']?>) <?=$datos['quest'][35][103]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--Si-->
													<input class="counter18" data-opc_valor="<?=$datos['quest'][35][104]['opc_valor']?>" type="radio" name="<?=$datos['quest'][35][104]['react_id_reactivo']?>" <?=((isset($options[35]['id_opcion']))&&($options[35]['id_opcion'] == $datos['quest'][35][104]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][35][104]['opc_id_opcion']?>"> (<?=$datos['quest'][35][104]['opc_valor']?>) <?=$datos['quest'][35][104]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter19" data-value="<?=isset($options[36]['val_opc'])?$options[36]['val_opc']:0?>">
										<!--18. ¿Su pareja o ex pareja posee o tiene acceso a un arma de fuego?-->
										<label class="col-xl-6 col-lg-6 col-form-label">18. <?=$datos['quest'][36][105]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--No-->
													<input class="counter19" data-opc_valor="<?=$datos['quest'][36][105]['opc_valor']?>" type="radio" name="<?=$datos['quest'][36][105]['react_id_reactivo']?>" <?=((isset($options[36]['id_opcion']))&&($options[36]['id_opcion'] == $datos['quest'][36][105]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][36][105]['opc_id_opcion']?>"> (<?=$datos['quest'][36][105]['opc_valor']?>) <?=$datos['quest'][36][105]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--Si-->
													<input class="counter19" data-opc_valor="<?=$datos['quest'][36][106]['opc_valor']?>" type="radio" name="<?=$datos['quest'][36][106]['react_id_reactivo']?>" <?=((isset($options[36]['id_opcion']))&&($options[36]['id_opcion'] == $datos['quest'][36][106]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][36][106]['opc_id_opcion']?>"> (<?=$datos['quest'][36][106]['opc_valor']?>) <?=$datos['quest'][36][106]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--Desconoce-->
													<input class="counter19" data-opc_valor="<?=$datos['quest'][36][107]['opc_valor']?>" type="radio" name="<?=$datos['quest'][36][107]['react_id_reactivo']?>" <?=((isset($options[36]['id_opcion']))&&($options[36]['id_opcion'] == $datos['quest'][36][107]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][36][107]['opc_id_opcion']?>"> (<?=$datos['quest'][36][107]['opc_valor']?>) <?=$datos['quest'][36][107]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group m-form__group row" id="counter20" data-value="<?=isset($options[37]['val_opc'])?$options[37]['val_opc']:0?>">
										<!--19. ¿Su pareja o ex pareja usa o ha usado un arma de fuego?-->
										<label class="col-xl-6 col-lg-6 col-form-label">19. <?=$datos['quest'][37][108]['reactivo']?></label>
										<div class="col-xl-6 col-lg-6">
											<div class="m-radio-inline row">
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--no-->
													<input class="counter20" data-opc_valor="<?=$datos['quest'][37][108]['opc_valor']?>" type="radio" name="<?=$datos['quest'][37][108]['react_id_reactivo']?>" <?=((isset($options[37]['id_opcion']))&&($options[37]['id_opcion'] == $datos['quest'][37][108]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][37][108]['opc_id_opcion']?>"> (<?=$datos['quest'][37][108]['opc_valor']?>) <?=$datos['quest'][37][108]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--si-->
													<input class="counter20" data-opc_valor="<?=$datos['quest'][37][109]['opc_valor']?>" type="radio" name="<?=$datos['quest'][37][109]['react_id_reactivo']?>" <?=((isset($options[37]['id_opcion']))&&($options[37]['id_opcion'] == $datos['quest'][37][109]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][37][109]['opc_id_opcion']?>"> (<?=$datos['quest'][37][109]['opc_valor']?>) <?=$datos['quest'][37][109]['opc_nombre']?>
													<span></span>
												</label>
												<label class="m-radio m-radio--solid m-radio--brand">
													<!--Desconoce-->
													<input class="counter20" data-opc_valor="<?=$datos['quest'][37][110]['opc_valor']?>" type="radio" name="<?=$datos['quest'][37][110]['react_id_reactivo']?>" <?=((isset($options[37]['id_opcion']))&&($options[37]['id_opcion'] == $datos['quest'][37][110]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][37][110]['opc_id_opcion']?>"> (<?=$datos['quest'][37][110]['opc_valor']?>) <?=$datos['quest'][37][110]['opc_nombre']?>
													<span></span>
												</label>
											</div>
										</div>
									</div>

								</div>
<!--ANEXO COMPLEMENTARIO-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_7">
        <!--grupo prioritario-->
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--Grupo Prioritario-->
												I. <?=$datos['quest'][38][111]['subgrupo']?>
											</h3>
										</div>
											<div class="form-group m-form__group" style="padding-left:20px;">
										  <!--1. ¿Pertenece a alguno de los siguientes grupos prioritarios?-->
										  <label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">1. <?=$datos['quest'][38][111]['reactivo']?></h3></label>
													<div class="row">
														<!--Está embarazada-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][111]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][111]['id_opcion']))&&($checkbox[38][111]['id_opcion'] == $datos['quest'][38][111]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][111]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][111]['opc_nombre']?></label>
														<!--Se encuentra desempleada-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][112]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][112]['id_opcion']))&&($checkbox[38][112]['id_opcion'] == $datos['quest'][38][112]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][112]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][112]['opc_nombre']?></label>
														<!--Mujer trans-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][113]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][113]['id_opcion']))&&($checkbox[38][113]['id_opcion'] == $datos['quest'][38][113]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][113]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][113]['opc_nombre']?></label>
													</div>
													<!--Dió a luz en los últimos 6 meses-->
													<div class="row">
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][114]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][114]['id_opcion']))&&($checkbox[38][114]['id_opcion'] == $datos['quest'][38][114]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][114]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][114]['opc_nombre']?></label>
														<!--Migrante o extranjera-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][115]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][115]['id_opcion']))&&($checkbox[38][115]['id_opcion'] == $datos['quest'][38][115]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][115]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][115]['opc_nombre']?></label>
														<!--Tiene una discapacidad-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][116]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][116]['id_opcion']))&&($checkbox[38][116]['id_opcion'] == $datos['quest'][38][116]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][116]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][116]['opc_nombre']?></label>
													</div>
													<!--Tiene hijas o hijos menores de 18 años-->
													<div class="row">
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][117]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][117]['id_opcion']))&&($checkbox[38][117]['id_opcion'] == $datos['quest'][38][117]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][117]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][117]['opc_nombre']?></label>
														<!--Indígena-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][118]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][118]['id_opcion']))&&($checkbox[38][118]['id_opcion'] == $datos['quest'][38][118]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][118]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][118]['opc_nombre']?></label>
														<!--Trabajadora sexual-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][119]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][119]['id_opcion']))&&($checkbox[38][119]['id_opcion'] == $datos['quest'][38][119]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][119]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][119]['opc_nombre']?></label>
													</div>
													<!--Tiene bajo su cuidado a a personas con discapacidad o adultas mayores-->
													<div class="row">
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input type="checkbox" class="checkbox_prioritario" name="<?=$datos['quest'][38][120]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][120]['id_opcion']))&&($checkbox[38][120]['id_opcion'] == $datos['quest'][38][120]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][120]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][120]['opc_nombre']?></label>
														<!--Ninguna-->
														<div class="col-xl-1 col-lg-1">
															<span class="m-switch m-switch--outline m-switch--brand">
																<label>
																	<input id="selectall" type="checkbox" name="<?=$datos['quest'][38][121]['react_id_reactivo']?>[]" <?=((isset($checkbox[38][121]['id_opcion']))&&($checkbox[38][121]['id_opcion'] == $datos['quest'][38][121]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][38][121]['opc_id_opcion']?>">
																	<span></span>
																</label>
															</span>
														</div>
														<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][38][121]['opc_nombre']?></label>
													</div>
											</div>
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
									</div>
				<!--Persona con discapacidad-->
 									<div class="m-form__section m-form__section--first">
 										<div class="m-form__heading">
 											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--II. PERSONA CON DISCAPACIDAD-->
 												II. <?=$datos['quest'][39][122]['subgrupo']?>
 											</h3>
 										</div>
 										<div class="form-group m-form__group row" style="padding-left:20px;">
										<!--2. Seleccione el tipo de discapacidad que tiene (puede seleccionar más de una opción)-->
										<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">2. <?=$datos['quest'][39][122]['reactivo']?> <?=$datos['quest'][39][122]['react_ayuda']?></h3></label>
											<!--Física-->
 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="discapacidad_check" name="<?=$datos['quest'][39][122]['react_id_reactivo']?>[]" <?=((isset($checkbox[39][122]['id_opcion']))&&($checkbox[39][122]['id_opcion'] == $datos['quest'][39][122]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][39][122]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
 											<label class="col-xl-1 col-lg-1 col-form-label"><?=$datos['quest'][39][122]['opc_nombre']?></label>
											<!--Sensorial-->
 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="discapacidad_check" name="<?=$datos['quest'][39][123]['react_id_reactivo']?>[]" <?=((isset($checkbox[39][123]['id_opcion']))&&($checkbox[39][123]['id_opcion'] == $datos['quest'][39][123]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][39][123]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
 											<label class="col-xl-1 col-lg-1 col-form-label"><?=$datos['quest'][39][123]['opc_nombre']?></label>
											<!--Psicosocial-->
 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="discapacidad_check" name="<?=$datos['quest'][39][124]['react_id_reactivo']?>[]" <?=((isset($checkbox[39][124]['id_opcion']))&&($checkbox[39][124]['id_opcion'] == $datos['quest'][39][124]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][39][124]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
 											<label class="col-xl-1 col-lg-1 col-form-label"><?=$datos['quest'][39][124]['opc_nombre']?></label>
											<!--Intelectual-->
 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="discapacidad_check" name="<?=$datos['quest'][39][125]['react_id_reactivo']?>[]" <?=((isset($checkbox[39][125]['id_opcion']))&&($checkbox[39][125]['id_opcion'] == $datos['quest'][39][125]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][39][125]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
 											<label class="col-xl-1 col-lg-1 col-form-label"><?=$datos['quest'][39][125]['opc_nombre']?></label>
											<!--Ninguna-->
											<div class="col-xl-1 col-lg-1">
												<span class="m-switch m-switch--outline m-switch--brand">
													<label>
														<input id="discapacidad_check" type="checkbox" name="<?=$datos['quest'][39][126]['react_id_reactivo']?>[]" <?=((isset($checkbox[39][126]['id_opcion']))&&($checkbox[39][126]['id_opcion'] == $datos['quest'][39][126]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][39][126]['opc_id_opcion']?>">
														<span></span>
													</label>
												</span>
											</div>
											<label class="col-xl-1 col-lg-1 col-form-label"><?=$datos['quest'][39][126]['opc_nombre']?></label>

 										</div>

 										<div class="m-separator m-separator--dashed m-separator--lg"></div>
 									</div>
				<!--embarazo-->
 									<div class="m-form__section m-form__section--first">
 										<div class="m-form__heading">
 											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--III. EMBARAZO-->
 												III. <?=$datos['quest'][40][127]['subgrupo']?>
 											</h3>
 										</div>
										<div class="form-group m-form__group row" style="padding-left:20px;">
										<!--3. ¿Su pareja o expareja la agredió de alguna de las siguientes formas mientras está embarazada?-->
										<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">3. <?=$datos['quest'][40][127]['reactivo']?> <?=$datos['quest'][40][127]['react_ayuda']?></h3></label>
 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="checkbox_emarazo" name="<?=$datos['quest'][40][127]['react_id_reactivo']?>[]" <?=((isset($checkbox[40][127]['id_opcion']))&&($checkbox[40][127]['id_opcion'] == $datos['quest'][40][127]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][40][127]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
											<!--Le ha golpeado en partes del cuerpo que no sea su vientre-->
 											<label class="col-xl-2 col-lg-2 col-form-label"><?=$datos['quest'][40][127]['opc_nombre']?></label>

 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="checkbox_emarazo" name="<?=$datos['quest'][40][128]['react_id_reactivo']?>[]" <?=((isset($checkbox[40][128]['id_opcion']))&&($checkbox[40][128]['id_opcion'] == $datos['quest'][40][128]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][40][128]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
											<!--Le ha golpeado en el vientre-->
 											<label class="col-xl-2 col-lg-2 col-form-label"><?=$datos['quest'][40][128]['opc_nombre']?></label>

 											<div class="col-xl-1 col-lg-1">
 												<span class="m-switch m-switch--outline m-switch--brand">
 													<label>
 														<input type="checkbox" class="checkbox_emarazo" name="<?=$datos['quest'][40][129]['react_id_reactivo']?>[]" <?=((isset($checkbox[40][129]['id_opcion']))&&($checkbox[40][129]['id_opcion'] == $datos['quest'][40][129]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][40][129]['opc_id_opcion']?>">
 														<span></span>
 													</label>
 												</span>
 											</div>
											<!--Le ha obligado a tomar alguna sustancia que pone o puso en riesgo su embarazo-->
 											<label class="col-xl-2 col-lg-2 col-form-label"><?=$datos['quest'][40][129]['opc_nombre']?></label>

											<div class="col-xl-1 col-lg-1">
												<span class="m-switch m-switch--outline m-switch--brand">
													<label>
														<input id="selectall_em" type="checkbox" name="<?=$datos['quest'][40][130]['react_id_reactivo']?>[]" <?=((isset($checkbox[40][130]['id_opcion']))&&($checkbox[40][130]['id_opcion'] == $datos['quest'][40][130]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][40][130]['opc_id_opcion']?>">
														<span></span>
													</label>
												</span>
											</div>
											<!--Ninguna-->
											<label class="col-xl-2 col-lg-2 col-form-label"><?=$datos['quest'][40][130]['opc_nombre']?></label>
									  </div>

 										<div class="m-separator m-separator--dashed m-separator--lg"></div>
 									</div>
				<!--Situación de hijas o hijos-->
 									<div class="m-form__section m-form__section--first">
 										<div class="m-form__heading">
 											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
 												IV. <?=$datos['quest'][41][0]['subgrupo']?>
 											</h3>
 										</div>
										<!--Imprime los campos guardados para hijos-->
										<?php
										if(isset($obtener_reactivos[41]['campo_unico']) && $obtener_reactivos[41]['campo_unico'] != "null"){
											$hijos = json_decode($obtener_reactivos[41]['campo_unico']);
										?>
										<div class="m-portlet__body">
											<div class="m-section">
												<span class="m-section__sub">
													<b>Hijos registrados:</b>
												</span>
												<div class="m-section__content">
													<table class="table table-sm m-table m-table--head-bg-brand">
														<thead class="thead-inverse">
															<tr>
																<th>#</th>
																<th>Sexo</th>
																<th>Edad</th>
																<th>Guardia y custodia</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$num = 1;
															foreach($hijos as $hijo){
															?>
															<tr>
																<th scope="row"><?=$num?></th>
																<td><?=$hijo->Sexo?></td>
																<td><?=$hijo->Edad?></td>
																<td><?=$hijo->guardia_custodia?></td>
															</tr>
															<?php
															$num++;
															}
															?>
														</tbody>
													</table>
												</div>
												<span class="m-section__sub">
													Estos registros ya estan guardados en el tamizaje, para <b>REMPLAZARLOS</b> puede usar el boton <b><i>+ agregar</i></b>, los nuevos registros remplazarán los actuales,
													para conservarlos no agregue nuevos registros.
												</span>
											</div>
										</div>
										<?php
										}
										?>

										<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">4. <?=$datos['quest'][41][0]['reactivo']?></h3></label>
										<div id="m_repeater_1">
											<div class="form-group  m-form__group row" id="m_repeater_1">
												<div id="repeater_hijos" data-repeater-list="<?=$datos['quest'][41][0]['react_id_reactivo']?>" class="col-lg-11">
													<div data-repeater-item class="form-group m-form__group row align-items-center">
														<div class="col-md-2">
															<div class="m-form__group m-form__group--inline">
																<div class="m-form__label">
																	<label>Sexo:</label>
																</div>
																<div class="m-form__control">
																	<select name="Sexo" class="form-control m-input m-input--square">
																		<option value="" selected disabled>Sexo</option>
																		<option value="Masculino">Masculino</option>
																		<option value="Femenino">Femenino</option>
																  </select>
																</div>
															</div>
															<div class="d-md-none m--margin-bottom-10"></div>
														</div>
														<div class="col-md-3">
															<div class="m-form__group m-form__group--inline">
																<div class="m-form__label">
																	<label class="m-label m-label--single">Edad:</label>
																</div>
																<div class="m-form__control">
																	<input type="text" class="touchspin form-control" name="Edad" value="">
																</div>
															</div>
															<div class="d-md-none m--margin-bottom-10"></div>
														</div>
														<div class="col-md-5">
															<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-md-3 col-form-label">Guardia y custodia:</label>
																	<div class="m-form__control col-xl-9 col-lg-9 col-md-9">
																		<select name="guardia_custodia" class="form-control m-input m-input--square">
																			<option value="" selected disabled>¿quien debe de tener la guardia y custodia?</option>
																			<option value="No existe decisión de algún órgano jurisdiccional">No existe decisión de algún órgano jurisdiccional</option>
																			<option value="Se decidió guardia y custodia a favor de la madre">Se decidió guardia y custodia a favor de la madre</option>
																			<option value="Se decidió guardia y custodia a favor del padre">Se decidió guardia y custodia a favor del padre</option>
																			<option value="Se decidió guardia y custodia a favor de otros familiares">Se decidió guardia y custodia a favor de otros familiares</option>
																			<option value="Se decidió guardia y custodia compartida">Se decidió guardia y custodia compartida</option>
																	  </select>
																	</div>
																<div class="d-md-none m--margin-bottom-10"></div>
															</div>
														</div>
														<div class="col-md-1">
															<div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
																<span>
																	<i class="la la-trash-o"></i>
																	<span>Eliminar</span>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div data-repeater-list="hijos" class="col-lg-1">
													<div class="col-md-1">
														<div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
															<span>
																<i class="la la-plus"></i>
																<span>Agregar</span>
															</span>
														</div>
													</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg"></div>

										<div class="form-group m-form__group row">
											<!--6. ¿Su pareja o expareja le imposibilita poder convivir o ver a sus hijas/hijos?-->
											<label class="col-xl-6 col-lg-6 col-form-label"><h3 class="pad_fix">6. <?=$datos['quest'][42][131]['reactivo']?></h3></label>
											<div class="col-xl-6 col-lg-6 row">
												<div class="m-radio-inline">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Su pareja no le permite ver a sus hijas/hijos y no hay guardia y custodia dictada por algún juez de lo familiar-->
														<input type="radio" name="<?=$datos['quest'][42][131]['react_id_reactivo']?>" <?=((isset($options[42]['id_opcion']))&&($options[42]['id_opcion'] == $datos['quest'][42][131]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][42][131]['opc_id_opcion']?>"> <?=$datos['quest'][42][131]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--La guardia y custodia es a favor del padre u otro familiar paterno, pero le imposibilita las convivencias con sus hijos o hijas-->
														<input type="radio" name="<?=$datos['quest'][42][132]['react_id_reactivo']?>" <?=((isset($options[42]['id_opcion']))&&($options[42]['id_opcion'] == $datos['quest'][42][132]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][42][132]['opc_id_opcion']?>"> <?=$datos['quest'][42][132]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No hay problemas para la convivencia con sus hijas/hijos-->
														<input type="radio" name="<?=$datos['quest'][42][133]['react_id_reactivo']?>" <?=((isset($options[42]['id_opcion']))&&($options[42]['id_opcion'] == $datos['quest'][42][133]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][42][133]['opc_id_opcion']?>"> <?=$datos['quest'][42][133]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

 										<div class="m-separator m-separator--dashed m-separator--lg"></div>
 									</div>
        <!--contexto de convivencia-->
									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--V. CONTEXTO DE CONVIVENCIA CON PAREJA O EXPAREJA-->
												V. <?=$datos['quest'][43][134]['subgrupo']?>
											</h3>
										</div>

										<div class="form-group m-form__group row">
											<!--7. ¿Actualmente vive con su pareja o expareja?-->
											<label class="col-xl-6 col-lg-6 col-form-label"><h3 class="pad_fix">7. <?=$datos['quest'][43][134]['reactivo']?></h3></label>
											<div class="col-xl-6 col-lg-6 row">
												<div class="m-radio-inline">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No-->
														<input readonly class="validacion_cruzada_1b" type="radio" name="<?=$datos['quest'][43][134]['react_id_reactivo']?>" <?=((isset($options[43]['id_opcion']))&&($options[43]['id_opcion'] == $datos['quest'][43][134]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][43][134]['opc_id_opcion']?>"> <?=$datos['quest'][43][134]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Si-->
														<input readonly class="validacion_cruzada_1b" type="radio" name="<?=$datos['quest'][43][135]['react_id_reactivo']?>" <?=((isset($options[43]['id_opcion']))&&($options[43]['id_opcion'] == $datos['quest'][43][135]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][43][135]['opc_id_opcion']?>"> <?=$datos['quest'][43][135]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<!--8. ¿De quién es propiedad la casa donde habita con su pareja o expareja?-->
											<label class="col-xl-6 col-lg-6 col-form-label"><h3 class="pad_fix">8. <?=$datos['quest'][44][136]['reactivo']?></h3></label>
											<div class="col-xl-6 col-lg-6">
												<div class="m-radio-inline row">
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<!--Es de su propiedad o de alguno de sus familiares de usted-->
														<input type="radio" name="<?=$datos['quest'][44][136]['react_id_reactivo']?>" <?=((isset($options[44]['id_opcion']))&&($options[44]['id_opcion'] == $datos['quest'][44][136]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][44][136]['opc_id_opcion']?>"> <?=$datos['quest'][44][136]['opc_nombre']?>
														<span></span>
													</label>
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<!--Es de su pareja o expareja-->
														<input type="radio" name="<?=$datos['quest'][44][137]['react_id_reactivo']?>" <?=((isset($options[44]['id_opcion']))&&($options[44]['id_opcion'] == $datos['quest'][44][137]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][44][137]['opc_id_opcion']?>"> <?=$datos['quest'][44][137]['opc_nombre']?>
														<span></span>
													</label>
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<!--Pertenece a la familia de su pareja o expareja-->
														<input type="radio" name="<?=$datos['quest'][44][138]['react_id_reactivo']?>" <?=((isset($options[44]['id_opcion']))&&($options[44]['id_opcion'] == $datos['quest'][44][138]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][44][138]['opc_id_opcion']?>"> <?=$datos['quest'][44][138]['opc_nombre']?>
														<span></span>
													</label>
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<!--La casa donde habita es rentada por usted o su pareja o expareja-->
														<input type="radio" name="<?=$datos['quest'][44][139]['react_id_reactivo']?>" <?=((isset($options[44]['id_opcion']))&&($options[44]['id_opcion'] == $datos['quest'][44][139]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][44][139]['opc_id_opcion']?>"> <?=$datos['quest'][44][139]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>
										<div class="form-group m-form__group row">
											<!--9. Seleccione los espacios que su pareja o expareja comparte con usted-->
											<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">9. <?=$datos['quest'][45][140]['reactivo']?> <?=$datos['quest'][45][140]['react_ayuda']?></h3></label>
											<div class="col-xl-12 col-lg-12 row">
												<div class="col-xl-12 col-lg-12 row m-radio-inline" style="padding-left:30px;">

													<div class="col-xl-1 col-lg-1">
														<span class="m-switch m-switch--outline m-switch--brand">
															<label>
																<!--Vive en la misma colonia donde vive su pareja/expareja o familiares de él-->
																<input class="checkbox_convivencia" type="checkbox" name="<?=$datos['quest'][45][140]['react_id_reactivo']?>[]" <?=((isset($checkbox[45][140]['id_opcion']))&&($checkbox[45][140]['id_opcion'] == $datos['quest'][45][140]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][45][140]['opc_id_opcion']?>">
																<span></span>
															</label>
														</span>
													</div>
													<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][45][140]['opc_nombre']?></label>

													<div class="col-xl-1 col-lg-1">
														<span class="m-switch m-switch--outline m-switch--brand">
															<label>
																<!--Trabaja en el mismo espacio laboral que su pareja/expareja-->
																<input class="checkbox_convivencia" type="checkbox" name="<?=$datos['quest'][45][141]['react_id_reactivo']?>[]" <?=((isset($checkbox[45][141]['id_opcion']))&&($checkbox[45][141]['id_opcion'] == $datos['quest'][45][141]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][45][141]['opc_id_opcion']?>">
																<span></span>
															</label>
														</span>
													</div>
													<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][45][141]['opc_nombre']?></label>

													<div class="col-xl-1 col-lg-1">
														<span class="m-switch m-switch--outline m-switch--brand">
															<label>
																<!--Acude a la misma escuela que su pareja/expareja-->
																<input class="checkbox_convivencia" type="checkbox" name="<?=$datos['quest'][45][142]['react_id_reactivo']?>[]" <?=((isset($checkbox[45][142]['id_opcion']))&&($checkbox[45][142]['id_opcion'] == $datos['quest'][45][142]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][45][142]['opc_id_opcion']?>">
																<span></span>
															</label>
														</span>
													</div>
													<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][45][142]['opc_nombre']?></label>

													<div class="col-xl-1 col-lg-1">
														<span class="m-switch m-switch--outline m-switch--brand">
															<label>
																<!--Su pareja/expareja frecuenta la colonia donde usted vive, trabaja o estudia-->
																<input class="checkbox_convivencia" type="checkbox" name="<?=$datos['quest'][45][143]['react_id_reactivo']?>[]" <?=((isset($checkbox[45][143]['id_opcion']))&&($checkbox[45][143]['id_opcion'] == $datos['quest'][45][143]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][45][143]['opc_id_opcion']?>">
																<span></span>
															</label>
														</span>
													</div>
													<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][45][143]['opc_nombre']?></label>

													<div class="col-xl-1 col-lg-1">
														<span class="m-switch m-switch--outline m-switch--brand">
															<label>
																<!--Ninguna de las anteriores-->
																<input id="selectallocurrencies" type="checkbox" name="<?=$datos['quest'][45][144]['react_id_reactivo']?>[]" <?=((isset($checkbox[45][144]['id_opcion']))&&($checkbox[45][144]['id_opcion'] == $datos['quest'][45][144]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][45][144]['opc_id_opcion']?>">
																<span></span>
															</label>
														</span>
													</div>
													<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][45][144]['opc_nombre']?></label>

												</div>
											</div>
										</div>
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
									</div>
				<!--situacion económica, patrimonial-->
 									<div class="m-form__section m-form__section--first">
 										<div class="m-form__heading">
 											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--VI. SITUACIÓN ECONÓMICA Y PATRIMONIAL-->
 												VI. <?=$datos['quest'][46][145]['subgrupo']?>
 											</h3>
 										</div>

										<div class="form-group m-form__group row">
											<!--10. ¿Cuenta con ingresos propios para cubrir los gastos del hogar, alimentos y, en su caso, manuntención de sus hijos?-->
											<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">10. <?=$datos['quest'][46][145]['reactivo']?></h3></label>
											<div class="col-xl-12 col-lg-12 row" style="padding-left:30px;">
												<div class="m-radio-inline" style="padding-left:15px;">
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input type="radio" name="<?=$datos['quest'][46][145]['react_id_reactivo']?>" <?=((isset($options[46]['id_opcion']))&&($options[46]['id_opcion'] == $datos['quest'][46][145]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][46][145]['opc_id_opcion']?>"> <?=$datos['quest'][46][145]['opc_nombre']?>
														<span></span>
													</label>
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input type="radio" name="<?=$datos['quest'][46][146]['react_id_reactivo']?>" <?=((isset($options[46]['id_opcion']))&&($options[46]['id_opcion'] == $datos['quest'][46][146]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][46][146]['opc_id_opcion']?>"> <?=$datos['quest'][46][146]['opc_nombre']?>
														<span></span>
													</label>
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input type="radio" name="<?=$datos['quest'][46][147]['react_id_reactivo']?>" <?=((isset($options[46]['id_opcion']))&&($options[46]['id_opcion'] == $datos['quest'][46][147]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][46][147]['opc_id_opcion']?>"> <?=$datos['quest'][46][147]['opc_nombre']?>
														<span></span>
													</label>
													<label class="col-xl-12 col-lg-12 m-radio m-radio--solid m-radio--brand">
														<input type="radio" name="<?=$datos['quest'][46][148]['react_id_reactivo']?>" <?=((isset($options[46]['id_opcion']))&&($options[46]['id_opcion'] == $datos['quest'][46][148]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][46][148]['opc_id_opcion']?>"> <?=$datos['quest'][46][148]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="form-group m-form__group row">
											<!--11. ¿Su pareja, expareja o familiar de él controla o tiene en su posesión objetos personales de su propiedad (documentos de identidad, objetos de hijiene y ropa, así como necesarios para trabajar)?-->
											<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">11. <?=$datos['quest'][47][149]['reactivo']?> <?=$datos['quest'][47][149]['react_ayuda']?></h3></label>
											<div class="col-xl-4 col-lg-4" style="padding-left:30px;">
												<div class="m-radio-inline">
													<!--Si, ¿Cuales Objetos?-->
													<label class="m-radio m-radio--solid m-radio--brand">
														<input id="cuales_objetos_on" type="radio" name="<?=$datos['quest'][47][149]['react_id_reactivo']?>" <?=((isset($options[47]['id_opcion']))&&($options[47]['id_opcion'] == $datos['quest'][47][149]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][47][149]['opc_id_opcion']?>"> <?=$datos['quest'][47][149]['opc_nombre']?>. <?=$datos['quest'][47][149]['opc_ayuda']?>
														<span></span>
													</label>
													<!--No-->
													<label class="m-radio m-radio--solid m-radio--brand">
														<input id="cuales_objetos_off" type="radio" name="<?=$datos['quest'][47][150]['react_id_reactivo']?>" <?=((isset($options[47]['id_opcion']))&&($options[47]['id_opcion'] == $datos['quest'][47][150]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][47][150]['opc_id_opcion']?>"> <?=$datos['quest'][47][150]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>
										<!--Cuales objetos estan en posesión de su exareja-->
										<?php
										$cuales_objetos_input = isset($obtener_reactivos[56]['campo_unico'])?'':"display: none;";
										?>
										<div class="form-group m-form__group row" id="cuales_objetos_input" style="<?=$cuales_objetos_input?>">
											<div class="col-lg-8 m-form__group-sub">
											<label class="form-control-label"><?=$datos['quest'][56][0]['reactivo']?>:</label>
												<input id="cuales_objetos" type="text" name="<?=$datos['quest'][56][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[56]['campo_unico'])?$obtener_reactivos[56]['campo_unico']:''?>">
												<span class="m-form__help"><?=$datos['quest'][56][0]['react_ayuda']?></span>
											</div>
										</div>
 										<div class="m-separator m-separator--dashed m-separator--lg"></div>
 									</div>
				<!--otros factores de riesgo-->
 									<div class="m-form__section m-form__section--first">
 										<div class="m-form__heading">
 											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--VII. OTROS FACTORES DE RIESGO-->
 												VII. <?=$datos['quest'][48][151]['subgrupo']?>
 											</h3>
 										</div>
										<div class="form-group m-form__group">
										<!--12. Seleccione los juicios o procedimientos iniciados contra su pareja, expareja o algún de familiar de él-->
										<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">12. <?=$datos['quest'][48][151]['reactivo']?></h3></label>
	 										<div class="row" style="padding-left:20px;">
	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Denuncia por violencia familiar-->
	 														<input type="checkbox" class="procedimientos_iniciados" name="<?=$datos['quest'][48][151]['react_id_reactivo']?>[]" <?=((isset($checkbox[48][151]['id_opcion']))&&($checkbox[48][151]['id_opcion'] == $datos['quest'][48][151]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][48][151]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][48][151]['opc_nombre']?>.</label>

	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Denuncia por algún delito violento (lesiones, amenazas, daño a la propiedad)-->
	 														<input type="checkbox" class="procedimientos_iniciados" name="<?=$datos['quest'][48][152]['react_id_reactivo']?>[]" <?=((isset($checkbox[48][152]['id_opcion']))&&($checkbox[48][152]['id_opcion'] == $datos['quest'][48][152]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][48][152]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][48][152]['opc_nombre']?>. <?=$datos['quest'][48][152]['opc_ayuda']?></label>

	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Juicio por guardia y custodia / alimentos-->
	 														<input type="checkbox" class="procedimientos_iniciados" name="<?=$datos['quest'][48][153]['react_id_reactivo']?>[]" <?=((isset($checkbox[48][153]['id_opcion']))&&($checkbox[48][153]['id_opcion'] == $datos['quest'][48][153]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][48][153]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][48][153]['opc_nombre']?>.</label>
	 										</div>
	 										<div class="row" style="padding-left:20px;">
	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Divorcio-->
	 														<input type="checkbox" class="procedimientos_iniciados" name="<?=$datos['quest'][48][154]['react_id_reactivo']?>[]" <?=((isset($checkbox[48][154]['id_opcion']))&&($checkbox[48][154]['id_opcion'] == $datos['quest'][48][154]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][48][154]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][48][154]['opc_nombre']?>.</label>

												<div class="col-xl-1 col-lg-1">
													<span class="m-switch m-switch--outline m-switch--brand">
														<label>
															<!--Otro ¿Cual?-->
															<input id="otros_procedimientos" type="checkbox" class="procedimientos_iniciados" name="<?=$datos['quest'][48][155]['react_id_reactivo']?>[]" <?=((isset($checkbox[48][155]['id_opcion']))&&($checkbox[48][155]['id_opcion'] == $datos['quest'][48][155]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][48][155]['opc_id_opcion']?>">
															<span></span>
														</label>
													</span>
												</div>
												<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][48][155]['opc_nombre']?>. <?=$datos['quest'][48][155]['opc_ayuda']?></label>

	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Ninguno-->
	 														<input id="procedimientos_iniciados" type="checkbox" name="<?=$datos['quest'][48][156]['react_id_reactivo']?>[]" <?=((isset($checkbox[48][156]['id_opcion']))&&($checkbox[48][156]['id_opcion'] == $datos['quest'][48][156]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][48][156]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][48][156]['opc_nombre']?>.</label>
	 										</div>
										</div>
										<!--Otro procedimiento judicial iniciado-->
										<?php
										$otros_procedimientos_input = isset($obtener_reactivos[55]['campo_unico'])?'':"display: none;";
										?>
										<div class="form-group m-form__group row" id="otros_procedimientos_input" style="<?=$otros_procedimientos_input?>">
											<div class="col-lg-8 m-form__group-sub">
											<label class="form-control-label"><?=$datos['quest'][55][0]['reactivo']?>:</label>
												<input id="otros_procedimientos_text" type="text" name="<?=$datos['quest'][55][0]['react_id_reactivo']?>"  class="form-control m-input" value="<?=isset($obtener_reactivos[55]['campo_unico'])?$obtener_reactivos[55]['campo_unico']:''?>">
												<span class="m-form__help"><?=$datos['quest'][55][0]['react_ayuda']?></span>
											</div>
										</div>
										<div class="form-group m-form__group">
										<!--13. ¿Su pareja o expareja cuenta con alguna de las siguientes características?-->
										<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">13. <?=$datos['quest'][49][157]['reactivo']?></h3></label>
	 										<div class="row" style="padding-left:20px;">
	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Ha sido detenido o sentenciado por algun delito-->
	 														<input type="checkbox" class="caracteristicas_pareja" name="<?=$datos['quest'][49][157]['react_id_reactivo']?>[]" <?=((isset($checkbox[49][157]['id_opcion']))&&($checkbox[49][157]['id_opcion'] == $datos['quest'][49][157]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][49][157]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][49][157]['opc_nombre']?>.</label>
	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Tiene conocimiento o sospecha de su pertenencia en algún grupo del crimen organizado o vínculo con narcomenudeo u otras actividades delictivas-->
	 														<input type="checkbox" class="caracteristicas_pareja" name="<?=$datos['quest'][49][158]['react_id_reactivo']?>[]" <?=((isset($checkbox[49][158]['id_opcion']))&&($checkbox[49][158]['id_opcion'] == $datos['quest'][49][158]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][49][158]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][49][158]['opc_nombre']?>.</label>
	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Trabaja con seguridad privada o fuerzas armadas (por ejemplo: ejército, guardia nacional, secretaría de seguridad pública o ciudadana)-->
	 														<input type="checkbox" class="caracteristicas_pareja" name="<?=$datos['quest'][49][159]['react_id_reactivo']?>[]" <?=((isset($checkbox[49][159]['id_opcion']))&&($checkbox[49][159]['id_opcion'] == $datos['quest'][49][159]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][49][159]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][49][159]['opc_nombre']?>.</label>
	 										</div>
	 										<div class="row" style="padding-left:20px;">
	 											<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Tiene problemas financieros o de estabilidad laboral-->
	 														<input type="checkbox" class="caracteristicas_pareja" name="<?=$datos['quest'][49][160]['react_id_reactivo']?>[]" <?=((isset($checkbox[49][160]['id_opcion']))&&($checkbox[49][160]['id_opcion'] == $datos['quest'][49][160]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][49][160]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][49][160]['opc_nombre']?>.</label>

												<div class="col-xl-1 col-lg-1">
	 												<span class="m-switch m-switch--outline m-switch--brand">
	 													<label>
															<!--Ninguna-->
	 														<input id="caracteristicas_pareja" type="checkbox" name="<?=$datos['quest'][49][161]['react_id_reactivo']?>[]" <?=((isset($checkbox[49][161]['id_opcion']))&&($checkbox[49][161]['id_opcion'] == $datos['quest'][49][161]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][49][161]['opc_id_opcion']?>">
	 														<span></span>
	 													</label>
	 												</span>
	 											</div>
	 											<label class="col-xl-3 col-lg-3 col-form-label"><?=$datos['quest'][49][161]['opc_nombre']?>.</label>
	 										</div>
										</div>
										<!--14. Número de personas y familias que viven donde habita-->
										<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">14.  Número de personas y familias que viven donde habita</h3></label>
										  <div class="form-group m-form__group row" style="padding-left:30px;">
												<div class="col-lg-3 m-form__group-sub">
													<!--¿Cuanta gente vive en su casa?-->
													<label class="form-control-label"><?=$datos['quest'][50][0]['reactivo']?></label>
													<input type="text" class="form-control m-input spin_riesgo" name="<?=$datos['quest'][50][0]['react_id_reactivo']?>" value="<?=isset($obtener_reactivos[50]['campo_unico'])?$obtener_reactivos[50]['campo_unico']:''?>">
													<span class="m-form__help"><?=$datos['quest'][50][0]['react_ayuda']?></span>
												</div>
												<div class="col-lg-3 m-form__group-sub">
													<!--¿Cuántos cuartos tiene su casa?-->
													<label class="form-control-label"><?=$datos['quest'][51][0]['reactivo']?></label>
													<input type="text" class="form-control m-input spin_riesgo" name="<?=$datos['quest'][51][0]['react_id_reactivo']?>" value="<?=isset($obtener_reactivos[51]['campo_unico'])?$obtener_reactivos[51]['campo_unico']:''?>">
													<span class="m-form__help"><?=$datos['quest'][51][0]['react_ayuda']?></span>
												</div>
												<div class="col-lg-6 m-form__group-sub">
													<!--¿Cuántas familias viven en el mismo predio/casa?-->
													<label class="form-control-label"><?=$datos['quest'][52][0]['reactivo']?></label>
													<input type="text" class="form-control m-input spin_riesgo" name="<?=$datos['quest'][52][0]['react_id_reactivo']?>" value="<?=isset($obtener_reactivos[52]['campo_unico'])?$obtener_reactivos[52]['campo_unico']:''?>">
													<span class="m-form__help"><?=$datos['quest'][52][0]['react_ayuda']?></span>
												</div>
										  </div>

 										<div class="m-separator m-separator--dashed m-separator--lg"></div>

 									</div>
        <!--redes de apoyo-->
									<div class="m-form__section m-form__section--first">
										<!--VIII. REDES DE APOYO-->
										<div class="m-form__heading">
											<h3 class="m-form__heading-title anexo_tamiz_mujeres">
												<!--VIII. REDES DE APOYO-->
												VIII. <?=$datos['quest'][53][162]['subgrupo']?>
											</h3>
										</div>
										<div class="form-group m-form__group row">
											<!--15. ¿Cuenta con apoyo de familiares y/o amigas(o)?-->
											<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">15. <?=$datos['quest'][53][162]['reactivo']?></h3></label>
											<div class="col-xl-12 col-lg-12 row">
												<div class="m-radio-inline" style="padding-left:30px;">
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Tiene familiares o amigas(os) que conocen de la situación de violencia en que se encuentra-->
														<input type="radio" name="<?=$datos['quest'][53][162]['react_id_reactivo']?>" <?=((isset($options[53]['id_opcion']))&&($options[53]['id_opcion'] == $datos['quest'][53][162]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][53][162]['opc_id_opcion']?>"> <?=$datos['quest'][53][162]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--Cuenta con familiares o amigas(os) que conocen y le apoyan durante la situación de violencia-->
														<input type="radio" name="<?=$datos['quest'][53][163]['react_id_reactivo']?>" <?=((isset($options[53]['id_opcion']))&&($options[53]['id_opcion'] == $datos['quest'][53][163]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][53][163]['opc_id_opcion']?>"> <?=$datos['quest'][53][163]['opc_nombre']?>
														<span></span>
													</label>
													<label class="m-radio m-radio--solid m-radio--brand">
														<!--No cuenta con familiares o amigas(os) que le brinden apoyo o conozcan de su situación de violencia-->
														<input type="radio" name="<?=$datos['quest'][53][164]['react_id_reactivo']?>" <?=((isset($options[53]['id_opcion']))&&($options[53]['id_opcion'] == $datos['quest'][53][164]['opc_id_opcion']))?'checked':''?> value="<?=$datos['quest'][53][164]['opc_id_opcion']?>"> <?=$datos['quest'][53][164]['opc_nombre']?>
														<span></span>
													</label>
												</div>
											</div>
										</div>

										<div class="m-separator m-separator--dashed m-separator--lg"></div>
								  </div>
								</div>
<!--OBSERVACIONES-->
								<div class="m-wizard__form-step" id="m_wizard_form_step_8">

									<div class="m-form__section m-form__section--first">
										<div class="m-form__heading">
											<h3 class="m-form__heading-title"><?=$datos['quest'][54][0]['reactivo']?></h3>
										</div>
									</div>

									<div class="form-group m-form__group">
										<label for="observaciones"> <?=$datos['quest'][54][0]['react_ayuda']?></label>
										<textarea class="form-control m-input" name="<?=$datos['quest'][54][0]['react_id_reactivo']?>" rows="15"><?=isset($obtener_reactivos[54]['campo_unico'])?$obtener_reactivos[54]['campo_unico']:''?></textarea>
									</div>

								</div>
							</div>
<!--BOTONES DE CONTROL-->
							<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
								<div class="m-form__actions">
									<div class="row">
										<div class="col-lg-6 m--align-left">
											<a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
												<span>
													<i class="la la-arrow-left"></i>&nbsp;&nbsp;
													<span>Regresar</span>
												</span>
											</a>
										</div>
										<div class="col-lg-6 m--align-right">
											<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="submit">
												<span>
													<i class="la la-check"></i>&nbsp;&nbsp;
													<span>Finalizar</span>
												</span>
											</a>
											<a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
												<span>
													<span>Continuar</span>&nbsp;&nbsp;
													<i class="la la-arrow-right"></i>
												</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>

/*Validacionpara ANEXO COMPLEMENTARIO >> Espacios compartidos*/
$("#selectallocurrencies").on("click", function() {
	$(".checkbox_convivencia").prop("checked", false);
});
$(".checkbox_convivencia").on("click", function() {
	$("#selectallocurrencies").prop("checked", false);
});

/*Validacionpara VIOLENCIA EXTREMA*/
$('.violencia_extrema1').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema2').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema3').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema4').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema5').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema6').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema7').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema8').on('change', function () {$("#sin_violencia").prop("checked", false);});
$('.violencia_extrema9').on('change', function () {$("#sin_violencia").prop("checked", false);});
$("#sin_violencia").on("click", function() {
    if($('#sin_violencia').prop('checked')){
			$(".violencia_extrema1").val('2')
			$(".violencia_extrema2").val('8')
			$(".violencia_extrema3").val('14')
			$(".violencia_extrema4").val('20')
			$(".violencia_extrema5").val('26')
			$(".violencia_extrema6").val('32')
			$(".violencia_extrema7").val('38')
			$(".violencia_extrema8").val('44')
			$(".violencia_extrema9").val('50')
		}else{
			$(".violencia_extrema1").val('')
			$(".violencia_extrema2").val('')
			$(".violencia_extrema3").val('')
			$(".violencia_extrema4").val('')
			$(".violencia_extrema5").val('')
			$(".violencia_extrema6").val('')
			$(".violencia_extrema7").val('')
			$(".violencia_extrema8").val('')
			$(".violencia_extrema9").val('')
		}
});

/*Validacionpara ANEXO COMPLEMENTARIO >> SITUACIÓN DE HIJAS O HIJOS*/
$(".hijos1").on("click", function() {
	$(".hijos2").prop("checked", false);
});
$(".hijos2").on("click", function() {
	$(".hijos1").prop("checked", false);
});


/*Validacionpara ANEXO COMPLEMENTARIO >> Otros factores de riesgo caracteristicas_pareja*/
$("#caracteristicas_pareja").on("click", function() {
	$(".caracteristicas_pareja").prop("checked", false);
});
$(".caracteristicas_pareja").on("click", function() {
	$("#caracteristicas_pareja").prop("checked", false);
});

/*Validacionpara ANEXO COMPLEMENTARIO >> SITUACIÓN ECONÓMICA Y PATRIMONIAL >> 11. ¿Su pareja, expareja o familiar de él controla ... */
$("#cuales_objetos_on, #cuales_objetos_off").on("click", function() {
	if( $('#cuales_objetos_on').prop('checked') ) {
	   $("#cuales_objetos_input").show(650);
		 $("#cuales_objetos_input").prop('disabled', false);
  }else{
	   $("#cuales_objetos_input").hide(650);
		 $("#cuales_objetos").val('');
		 $("#cuales_objetos_input").prop('disabled', true);
	}
});

/*Validacionpara ANEXO COMPLEMENTARIO >> Otros factores de riesgo procedimientos iniciados contra su pareja*/
$("#procedimientos_iniciados").on("click", function() {
	$(".procedimientos_iniciados").prop("checked", false);
	$("#otros_procedimientos_input").hide(650);
	$("#otros_procedimientos_input").prop('disabled', true);
	$("#otros_procedimientos_text").val('');
});
$(".procedimientos_iniciados").on("click", function() {
	$("#procedimientos_iniciados").prop("checked", false);
});
$("#otros_procedimientos").on("click", function() {
	if( $('#otros_procedimientos').prop('checked') ) {
	   $("#otros_procedimientos_input").show(650);
		 $("#otros_procedimientos_input").prop('disabled', false);
  }else{
	   $("#otros_procedimientos_input").hide(650);
		 $("#otros_procedimientos_input").prop('disabled', true);
		 $("#otros_procedimientos_text").val('');
	}
});

/*Validacionpara ANEXO COMPLEMENTARIO >> Persona con discapacidad*/
$("#discapacidad_check").on("click", function() {
	$(".discapacidad_check").prop("checked", false);
});
$(".discapacidad_check").on("click", function() {
	$("#discapacidad_check").prop("checked", false);
});

/*Validacionpara ANEXO COMPLEMENTARIO >> Grupo prioritario*/
$("#selectall").on("click", function() {
	$(".checkbox_prioritario").prop("checked", false);
});
$(".checkbox_prioritario").on("click", function() {
	$("#selectall").prop("checked", false);
});

/*Validacionpara ANEXO COMPLEMENTARIO >> Embarazo*/
$("#selectall_em").on("click", function() {
	$(".checkbox_emarazo").prop("checked", false);

});
$(".checkbox_emarazo").on("click", function() {
	$("#selectall_em").prop("checked", false);
});

var FormRepeater = {
    init: function() {
        $("#m_repeater_1").repeater({
            initEmpty: true,
            defaultValues: {
                "edad": "",
								"sexo": "",
								"guardia_custodia": ""

            },
            show: function() {
                $(this).slideDown()
								BootstrapTouchspin.init()
            },
            hide: function(e) {
                $(this).slideUp(e)
            },
						isFirstItemUndeletable: true
        })
    },
		list: function(){
				$("#m_repeater_1").repeater({
					setList: {
					        'text-input': 'set-a',
					        'inner-group': [{ 'inner-text-input': 'set-b' }]
				 }
				})
		}
};

var BootstrapTouchspin = {
    init: function() {
        $(".touchspin").TouchSpin({
            buttondown_class: "btn btn-secondary",
            buttonup_class: "btn btn-secondary",
            min: 0,
            max: 17,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10
        })
    }
};

var BootstrapSpinRiesgo = {
    init: function() {
        $(".spin_riesgo").TouchSpin({
            buttondown_class: "btn btn-secondary",
            buttonup_class: "btn btn-secondary",
            min: 0,
            max: 99,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10
        })
    }
};


jQuery(document).ready(function() {
    WizardTamizaje.init()
		FormRepeater.init()
		FormRepeater.list()
		BootstrapTouchspin.init()
		BootstrapSpinRiesgo.init()
});
</script>
