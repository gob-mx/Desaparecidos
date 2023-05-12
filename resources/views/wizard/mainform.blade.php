<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / GF SNTE 5 / Wizard');
</script>
						<div class="m-portlet m-portlet--full-height">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											GF SNTE 5
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
											<a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Get help with filling up this form">
												<i class="flaticon-info m--icon-font-size-lg3"></i>
											</a>
										</li>
									</ul>
								</div>
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
<!--ACTIVO O JUBILADO-->
														<div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_1">
															<div class="m-wizard__step-info">
																<a href="#" class="m-wizard__step-number">
																	<span><span>1</span></span>
																</a>
																<div class="m-wizard__step-line">
																	<span></span>
																</div>
																<div class="m-wizard__step-label">
																	Status
																</div>
															</div>
														</div>
<!--PERIODO DE PAGO-->
														<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_2">
															<div class="m-wizard__step-info">
																<a href="#" class="m-wizard__step-number">
																	<span><span>2</span></span>
																</a>
																<div class="m-wizard__step-line">
																	<span></span>
																</div>
																<div class="m-wizard__step-label">
																	Periodo de pago
																</div>
															</div>
														</div>
<!--COBERTURA-->
														<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_3">
															<div class="m-wizard__step-info">
																<a href="#" class="m-wizard__step-number">
																	<span><span>3</span></span>
																</a>
																<div class="m-wizard__step-line">
																	<span></span>
																</div>
																<div class="m-wizard__step-label">
																	Cobertura
																</div>
															</div>
														</div>
<!--FORMA DE PAGO-->
														<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_4">
															<div class="m-wizard__step-info">
																<a href="#" class="m-wizard__step-number">
																	<span><span>4</span></span>
																</a>
																<div class="m-wizard__step-line">
																	<span></span>
																</div>
																<div class="m-wizard__step-label">
																	Forma de pago
																</div>
															</div>
														</div>
<!--NUMERO DE BENEFICIARIOS-->
														<div class="m-wizard__step" m-wizard-target="m_wizard_form_step_5">
															<div class="m-wizard__step-info">
																<a href="#" class="m-wizard__step-number">
																	<span><span>5</span></span>
																</a>
																<div class="m-wizard__step-line">
																	<span></span>
																</div>
																<div class="m-wizard__step-label">
																	Beneficiarios
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-9 col-lg-12">
											<div class="m-wizard__form">
												<form class="m-form m-form--label-align-left- m-form--state-" id="wizard_as">
													<div class="m-portlet__body m-portlet__body--no-padding">
<!--ACTIVO O JUBILADO-->
														<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
															<div class="m-form__section m-form__section--first">

																<div class="form-group m-form__group row">
																	<!--1. Status del Maestro-->
																	<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">Status del Maestro</h3></label>
																	<div class="col-xl-12 col-lg-12 row">
																		<div class="col-xl-12 col-lg-12 row m-radio-inline" style="padding-left:30px;">

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_activo" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Activo</label>

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_jubilado" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Jubilado</label>

																		</div>
																	</div>
																</div>

																<div class="form-group m-form__group row">
																	<!--2. Periodicidad de pago-->
																	<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">Periodicidad de pago</h3></label>
																	<div class="col-xl-12 col-lg-12 row">
																		<div class="col-xl-12 col-lg-12 row m-radio-inline" style="padding-left:30px;">

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_quincenal" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Quincenal</label>

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_mensual" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Mensual</label>

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_anual" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Anual</label>

																		</div>
																	</div>
																</div>

																<div class="form-group m-form__group row">
																	<!--3. Cobertura del plan-->
																	<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">Cobertura del plan</h3></label>
																	<div class="col-xl-12 col-lg-12 row">
																		<div class="col-xl-12 col-lg-12 row m-radio-inline" style="padding-left:30px;">

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_integral" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Integral</label>

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1 col-xl-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_basico" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Básico</label>

																		</div>
																	</div>
																</div>

																<div class="form-group m-form__group row">
																	<!--4. Forma de pago-->
																	<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix">Forma de pago</h3></label>
																	<div class="col-xl-12 col-lg-12 row">
																		<div class="col-xl-12 col-lg-12 row m-radio-inline" style="padding-left:30px;">

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_cheque" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Cheque</label>

																			<div class="col-4 col-sm-2 col-md-2 col-lg-1">
																				<span class="m-switch m-switch--outline m-switch--brand">
																					<label>
																						<input class="checkbox_transferencia" type="checkbox" name="name" value="value">
																						<span></span>
																					</label>
																				</span>
																			</div>
																			<label class="col-8 col-sm-10 col-md-2 col-lg-3 col-xl-2 col-form-label">Transferencia</label>

																		</div>
																	</div>
																</div>

																<!--5 Beneficiarios-->
																<label class="col-xl-12 col-lg-12 col-form-label"><h3 class="pad_fix2">Número de Beneficiarios</h3></label>
																  <div class="form-group m-form__group row" style="padding-left:30px;">
																		<div class="col-lg-3 m-form__group-sub">
																			<label class="form-control-label">Indique el número de Beneficiarios</label>
																			<input type="number" readonly class="form-control m-input spin_beneficiarios" name="name" value="1">
																			<span class="m-form__help">Use solo números</span>
																		</div>
																  </div>

															</div>
														</div>
<!--PERIODO DE PAGO-->
														<div class="m-wizard__form-step" id="m_wizard_form_step_2">
															<div class="m-form__section m-form__section--first">
																<div class="m-form__heading">
																	<h3 class="m-form__heading-title">Periodo de pago</h3>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="text" name="name" class="form-control m-input" placeholder="" value="Nick Stone">
																		<span class="m-form__help">Please enter your first and last names</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
																		<span class="m-form__help">We'll never share your email with anyone else</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Phone</label>
																	<div class="col-xl-9 col-lg-9">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																			<input type="text" name="phone" class="form-control m-input" placeholder="" value="1-541-754-3010">
																		</div>
																		<span class="m-form__help">Enter your valid phone in US phone format. E.g: 1-541-754-3010</span>
																	</div>
																</div>
															</div>
														</div>
<!--COBERTURA-->
														<div class="m-wizard__form-step" id="m_wizard_form_step_3">
															<div class="m-form__section m-form__section--first">
																<div class="m-form__heading">
																	<h3 class="m-form__heading-title">Cobertura</h3>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="text" name="name" class="form-control m-input" placeholder="" value="Nick Stone">
																		<span class="m-form__help">Please enter your first and last names</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
																		<span class="m-form__help">We'll never share your email with anyone else</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Phone</label>
																	<div class="col-xl-9 col-lg-9">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																			<input type="text" name="phone" class="form-control m-input" placeholder="" value="1-541-754-3010">
																		</div>
																		<span class="m-form__help">Enter your valid phone in US phone format. E.g: 1-541-754-3010</span>
																	</div>
																</div>
															</div>
														</div>
<!--FORMA DE PAGO-->
														<div class="m-wizard__form-step" id="m_wizard_form_step_4">
															<div class="m-form__section m-form__section--first">
																<div class="m-form__heading">
																	<h3 class="m-form__heading-title">Forma de pago</h3>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="text" name="name" class="form-control m-input" placeholder="" value="Nick Stone">
																		<span class="m-form__help">Please enter your first and last names</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
																		<span class="m-form__help">We'll never share your email with anyone else</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Phone</label>
																	<div class="col-xl-9 col-lg-9">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																			<input type="text" name="phone" class="form-control m-input" placeholder="" value="1-541-754-3010">
																		</div>
																		<span class="m-form__help">Enter your valid phone in US phone format. E.g: 1-541-754-3010</span>
																	</div>
																</div>
															</div>
														</div>
<!--NUMERO DE BENEFICIARIOS-->
														<div class="m-wizard__form-step" id="m_wizard_form_step_5">
															<div class="m-form__section m-form__section--first">
																<div class="m-form__heading">
																	<h3 class="m-form__heading-title">Número de beneficiarios</h3>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="text" name="name" class="form-control m-input" placeholder="" value="Nick Stone">
																		<span class="m-form__help">Please enter your first and last names</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
																	<div class="col-xl-9 col-lg-9">
																		<input type="email" name="email" class="form-control m-input" placeholder="" value="nick.stone@gmail.com">
																		<span class="m-form__help">We'll never share your email with anyone else</span>
																	</div>
																</div>
																<div class="form-group m-form__group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">* Phone</label>
																	<div class="col-xl-9 col-lg-9">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																			<input type="text" name="phone" class="form-control m-input" placeholder="" value="1-541-754-3010">
																		</div>
																		<span class="m-form__help">Enter your valid phone in US phone format. E.g: 1-541-754-3010</span>
																	</div>
																</div>
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
						<script>

						/*Validacion para Status Maestro*/
						$(".checkbox_activo").on("click", function() {
							$(".checkbox_jubilado").prop("checked", false);
							$(".checkbox_quincenal").prop("checked", true);
							$(".checkbox_mensual").prop("checked", false);
							$(".checkbox_anual").prop("checked", false);
							$(".checkbox_integral").prop("checked", true);
							$(".checkbox_basico").prop("checked", false);
						});
						$(".checkbox_jubilado").on("click", function() {
							$(".checkbox_activo").prop("checked", false);
							$(".checkbox_quincenal").prop("checked", false);
						});

						/*Validacion para Periodo de pago*/
						$(".checkbox_quincenal").on("click", function() {
							$(".checkbox_mensual").prop("checked", false);
							$(".checkbox_anual").prop("checked", false);
							$(".checkbox_activo").prop("checked", true);
							$(".checkbox_jubilado").prop("checked", false);
							$(".checkbox_integral").prop("checked", true);
							$(".checkbox_basico").prop("checked", false);
						});
						$(".checkbox_mensual").on("click", function() {
							$(".checkbox_quincenal").prop("checked", false);
							$(".checkbox_anual").prop("checked", false);
							$(".checkbox_activo").prop("checked", false);
							$(".checkbox_jubilado").prop("checked", true);
						});
						$(".checkbox_anual").on("click", function() {
							$(".checkbox_quincenal").prop("checked", false);
							$(".checkbox_mensual").prop("checked", false);
							$(".checkbox_activo").prop("checked", false);
							$(".checkbox_jubilado").prop("checked", true);
						});

						/*Validacion para Cobertura*/
						$(".checkbox_integral").on("click", function() {
							$(".checkbox_basico").prop("checked", false);
						});
						$(".checkbox_basico").on("click", function() {
							$(".checkbox_integral").prop("checked", false);
							$(".checkbox_activo").prop("checked", false);
							$(".checkbox_jubilado").prop("checked", true);
							$(".checkbox_quincenal").prop("checked", false);
						});

						/*Validacion para Forma de pago*/
						$(".checkbox_cheque").on("click", function() {
							$(".checkbox_transferencia").prop("checked", false);
						});
						$(".checkbox_transferencia").on("click", function() {
							$(".checkbox_cheque").prop("checked", false);
						});

						var BootstrapSpinRiesgo = {
						    init: function() {
						        $(".spin_beneficiarios").TouchSpin({
						            buttondown_class: "btn btn-secondary",
						            buttonup_class: "btn btn-secondary",
						            min: 1,
						            max: 99,
						            step: 1,
						            decimals: 0,
						            boostat: 5,
						            maxboostedstep: 10
						        })
						    }
						};

						jQuery(document).ready(function() {
						    Wizard.init()
								BootstrapSpinRiesgo.init()
						});
						</script>
