<!DOCTYPE html>
<html lang="es" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			<?=env('APP_NAME')?>
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <!--begin::Base Styles -->
		<link href="<?=env('APP_URL')?>assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=env('APP_URL')?>assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?=env('APP_URL')?>css/app.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="<?=env('APP_URL')?>assets/demo/default/media/img/logo/favicon.ico?v=5" />
	</head>
	<!-- end::Head -->
	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid">
	            <div class="m-login__wrapper">
								<div style="text-align: center;" ><img width="230px" src="<?=env('APP_URL')?>assets/demo/default/media/img/logo/logo_login.jpg"></div>
	              <!--<div class="m-login__logo"><?=env('APP_NAME')?></div>-->

	              <!--Formulario de inicio de sesion-->
	              <div class="m-login__signin">
	                <div class="m-login__head">
	                  <h3 class="m-login__title">
	                    <br>Ingrese sus credenciales
	                  </h3>
	                </div>
	                <form class="m-login__form m-form" action="" id="form">
	                  <div class="form-group m-form__group">
	                    <input class="form-control m-input" type="text" placeholder="Usuario" name="usuario" id="usuario" autocomplete="off">
	                  </div>
	                  <div class="form-group m-form__group">
	                    <input type='password' class="form-control m-input m-login__form-input--last" placeholder="Contraseña" name="password" id="password">
	                  </div>
	                  <div class="row m-login__form-sub">
	                    <div class="col m--align-left">
	                      <label class="m-checkbox m-checkbox--focus">
	                        <input type="checkbox" name="remember">
	                        Recordarme
	                        <span></span>
	                      </label>
	                    </div>
	                    <!--<div class="col m--align-right">
	                      <a href="javascript:;" id="[DELTHIS]m_login_forget_password" class="m-link">
	                        ¿Olvidó&nbsp;su&nbsp;contraseña?
	                      </a>
	                    </div>-->
	                  </div>
	                  <div class="m-login__form-action">
	                    <span id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
	                      Ingresar
	                    </span>
	                  </div>
	                </form>
	              </div>
	            </div>
	          </div>
						<div class="m-stack__item m-stack__item--center">
	            <div class="m-login__account">
	              <span class="m-login__account-msg">
	                2017 &copy; <?=env('APP_NAME')?>
	              </span>
	              &nbsp;&nbsp;
	              <span href="javascript:;" id="[dis]m_login_signup" class="m-link m-link--focus m-login__account-link">
	                <?=env('SLOGAN_NAME')?>
	              </span>
	            </div>
	          </div>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center" style="background-image: url(<?=env('APP_URL')?>assets/app/media/img//bg/bg-8.jpg)">
					&nbsp;
				</div>
			</div>
		</div>

		<!-- end:: Page -->
	    <!--begin::Base Scripts -->
	  <script src="<?=env('APP_URL')?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	  <script src="<?=env('APP_URL')?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
	  <!--end::Base Scripts -->
	      <!--begin::Page Snippets -->
	  <script src="<?=env('APP_URL')?>assets/snippets/pages/user/login.js" type="text/javascript"></script>
	  <!--end::Page Snippets -->

	  <script>var app_url = '<?=env('APP_URL')?>';</script>

	  <script src="<?=env('APP_URL')?>assets/js/generales.js"></script>
	  <script src="<?=env('APP_URL')?>assets/js/common.js"></script>
	</body>

	<!-- end::Body -->






</html>
