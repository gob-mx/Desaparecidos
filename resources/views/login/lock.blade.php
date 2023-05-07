<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title><?=env('APP_NAME')?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Framedev"
            name="description" />
        <meta content="" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="<?=env('APP_URL')?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>css/login/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=env('APP_URL')?>css/login/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=env('APP_URL')?>css/login/lock-2.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?=env('APP_URL')?>assets/demo/default/media/img/logo/favicon.ico?v=2" />
    <body class="">
        <div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="javascript:;"><?=env('APP_NAME')?></a>
            </div>
            <div class="page-body">

                <?php
                if ($datos['avatar']){
                ?>
                      <img src="../plugs/timthumb.php?src=tmp/<?=$datos['avatar']?>&w=200">
                <?php
                }else{
                ?>
                      <img class="page-lock-img" src="<?=env('APP_URL')?>img/lock4.png" width="250px" alt="Candado">
                <?php
                }
                ?>



                <div class="page-lock-info">
                    <h1><?=$datos['usuario']['nombres']?></h1>
                    <span class="email"><?=$datos['correo']?></span>
                    <span class="locked"> Sesión asegurada </span>
                    <form class="form-inline">
                        <div class="input-group input-medium">
                            <input type="hidden" name="usuario" id="usuario" value="<?=$datos['username']?>">

							              <input class="form-control" type="password" placeholder="Contraseña" name="password" id="password" required="" autocomplete="off">

                            <span class="input-group-btn">
                                <a class="btn btn-primary loginfn" rel="nofollow">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>
                        <div class="relogin">
                            <a href="../">¿ No eres  <?=$datos['usuario']['nombres']?> ?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer-custom"> 2022 &copy; ASSEGURO <?=env('APP_NAME')?> </div>
        </div>
        <!--[if lt IE 9]>
		<script src="<?=env('APP_URL')?>assets/plugins/respond.min.js"></script>
		<script src="<?=env('APP_URL')?>assets/plugins/excanvas.min.js"></script>
		<script src="<?=env('APP_URL')?>assets/plugins/ie8.fix.min.js"></script>
		<![endif]-->
        <script src="<?=env('APP_URL')?>assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/pages/app.min.js" type="text/javascript"></script>
        <script src="<?=env('APP_URL')?>assets/pages/lock-2.js?v=1.1" type="text/javascript"></script>

		<script>var app_url = '<?=env('APP_URL')?>';</script>

		<script src="<?=env('APP_URL')?>assets/js/generales.js"></script>
		<script src="<?=env('APP_URL')?>assets/js/common.js"></script>
    </body>
    <script>
    function kill_session() {
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '../login/salir',
        type: 'POST',
        dataType: "json",
        success: function(respuesta){
          if(respuesta[0].resp='correcto'){
            console.log('SessionKill executed successful');
          }
        },
        error: function(){alerta('Alerta!','Error de conectividad de red SESSIONTIMEOUT-02');}
      });
    }
    kill_session();
    </script>

</html>
