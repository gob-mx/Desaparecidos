<!--Section: Team v.1-->
<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/listado\');">GF SNTE 5</a> / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'beneficiarios/list/<?=$datos['id_solicitud']?>\');">Beneficiarios</a> / Carga / <?=$datos['beneficiario']?>');
</script>

<div class="row">

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['poliza_designacion']){
              ?>
                    <div class="profile-userpic" id="img_actual1">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual1">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Poliza Designación
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-1">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['comprobante_domicilio']){
              ?>
                    <div class="profile-userpic" id="img_actual2">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual2">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Comprobante Domicilio
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-2">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['comprobante_domicilio_extranjero']){
              ?>
                    <div class="profile-userpic" id="img_actual3">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual3">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Comprobante Domicilio Extranjero
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-3">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['ine']){
              ?>
                    <div class="profile-userpic" id="img_actual4">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual4">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              INE
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-4">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['fto_pld']){
              ?>
                    <div class="profile-userpic" id="img_actual5">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual5">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              PLD
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-5">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['fto_transferencia']){
              ?>
                    <div class="profile-userpic" id="img_actual6">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual6">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              FTO Transferencia
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-6">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['estado_cuenta']){
              ?>
                    <div class="profile-userpic" id="img_actual7">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual7">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Estado Cuenta
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-7">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['cedula_fiscal']){
              ?>
                    <div class="profile-userpic" id="img_actual8">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual8">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Cédula Fiscal
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-8">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['curp']){
              ?>
                    <div class="profile-userpic" id="img_actual9">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual9">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              CURP
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-9">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['comprobante_fiel']){
              ?>
                    <div class="profile-userpic" id="img_actual10">
                      <img src="../img/circle_pdf.png">
                   </div>
              <?php
              }else{
              ?>
                    <div class="profile-userpic" id="img_actual10">
                      <img src="../img/upload_files.png">
                   </div>
              <?php
              }
              ?>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Comprobante FIEL
            </span>
            <a href="" class="m-card-profile__email m-link">
              &nbsp;
            </a>
          </div>
        </div>

        <?php
        if(Helpme::tiene_permiso('Usuarios|upload_avatar')){
        ?>
        <form class="m-form m-form--fit m-form--label-align-right">
          <div class="m-portlet__body">
            <div class="form-group m-form__group row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="m-dropzone dropzone" id="m-dropzone-10">
                  <div class="m-dropzone__msg dz-message needsclick">
                    <h3 class="m-dropzone__msg-title">
                      Arrastra aqui o haz click para subir.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      No se han subido archivos.
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

</div>
<script>
$(document).ready(function() {
  $("#m-dropzone-1").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "upload/dropzone/documentos",   //contoller/metodo/folder
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 5, // MB
    acceptedFiles: "image/*,application/pdf", //imagenes y pdf
    accept: function(file, done) {
        //console.log(file);
        done();
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'beneficiarios/update_poliza_designacion/<?=$datos['id_beneficiario']?>/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual1').html('<center><img src="../img/circle_pdf.png"></center>');
    					swal('Se cargó su documento correctamente', '', "Actualizado!");
    				}
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-POL');}
        });
      });
    }
   });

  $("#m-dropzone-2").dropzone({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   url: "upload/dropzone/documentos",   //contoller/metodo/folder
   paramName: "file",
   maxFiles: 5,
   maxFilesize: 5, // MB
   acceptedFiles: "image/*,application/pdf", //imagenes y pdf
   accept: function(file, done) {
       //console.log(file);
       done();
   },
   init: function() {
     this.on("success", function(statics,file) {
       var img = file.split("|");

       $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: app_url + 'beneficiarios/update_comprobante_domicilio/<?=$datos['id_beneficiario']?>/' + img[1],
         type: 'POST',
         dataType: 'json',
         success: function(resp_success){
           if (resp_success['resp'] == true) {
             $('#img_actual2').html('<center><img src="../img/circle_pdf.png"></center>');
   					swal('Se cargó su documento correctamente', '', "Actualizado!");
   				}
         },
         error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-DOM-NAL');}
       });
     });
   }
  });

  $("#m-dropzone-3").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "upload/dropzone/documentos",   //contoller/metodo/folder
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 5, // MB
    acceptedFiles: "image/*,application/pdf", //imagenes y pdf
    accept: function(file, done) {
        //console.log(file);
        done();
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'beneficiarios/update_comprobante_domicilio_extranjero/<?=$datos['id_beneficiario']?>/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual3').html('<center><img src="../img/circle_pdf.png"></center>');
    					swal('Se cargó su documento correctamente', '', "Actualizado!");
    				}
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-DOM-EXT');}
        });
      });
    }
   });

  $("#m-dropzone-4").dropzone({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   url: "upload/dropzone/documentos",   //contoller/metodo/folder
   paramName: "file",
   maxFiles: 5,
   maxFilesize: 5, // MB
   acceptedFiles: "image/*,application/pdf", //imagenes y pdf
   accept: function(file, done) {
       //console.log(file);
       done();
   },
   init: function() {
     this.on("success", function(statics,file) {
       var img = file.split("|");

       $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: app_url + 'beneficiarios/update_ine/<?=$datos['id_beneficiario']?>/' + img[1],
         type: 'POST',
         dataType: 'json',
         success: function(resp_success){
           if (resp_success['resp'] == true) {
             $('#img_actual4').html('<center><img src="../img/circle_pdf.png"></center>');
   					swal('Se cargó su documento correctamente', '', "Actualizado!");
   				}
         },
         error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-INE-BEN');}
       });
     });
   }
  });

  $("#m-dropzone-5").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "upload/dropzone/documentos",   //contoller/metodo/folder
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 5, // MB
    acceptedFiles: "image/*,application/pdf", //imagenes y pdf
    accept: function(file, done) {
        //console.log(file);
        done();
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'beneficiarios/update_fto_pld/<?=$datos['id_beneficiario']?>/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual5').html('<center><img src="../img/circle_pdf.png"></center>');
    					swal('Se cargó su documento correctamente', '', "Actualizado!");
    				}
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-PLD');}
        });
      });
    }
   });

  $("#m-dropzone-6").dropzone({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   url: "upload/dropzone/documentos",   //contoller/metodo/folder
   paramName: "file",
   maxFiles: 5,
   maxFilesize: 5, // MB
   acceptedFiles: "image/*,application/pdf", //imagenes y pdf
   accept: function(file, done) {
       //console.log(file);
       done();
   },
   init: function() {
     this.on("success", function(statics,file) {
       var img = file.split("|");

       $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: app_url + 'beneficiarios/update_fto_transferencia/<?=$datos['id_beneficiario']?>/' + img[1],
         type: 'POST',
         dataType: 'json',
         success: function(resp_success){
           if (resp_success['resp'] == true) {
             $('#img_actual6').html('<center><img src="../img/circle_pdf.png"></center>');
             swal('Se cargó su documento correctamente', '', "Actualizado!");
           }
         },
         error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-TRANS');}
       });
     });
   }
  });

  $("#m-dropzone-7").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "upload/dropzone/documentos",   //contoller/metodo/folder
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 5, // MB
    acceptedFiles: "image/*,application/pdf", //imagenes y pdf
    accept: function(file, done) {
        //console.log(file);
        done();
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'beneficiarios/update_estado_cuenta/<?=$datos['id_beneficiario']?>/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual7').html('<center><img src="../img/circle_pdf.png"></center>');
             swal('Se cargó su documento correctamente', '', "Actualizado!");
           }
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-CTA');}
        });
      });
    }
   });

  $("#m-dropzone-8").dropzone({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   url: "upload/dropzone/documentos",   //contoller/metodo/folder
   paramName: "file",
   maxFiles: 5,
   maxFilesize: 5, // MB
   acceptedFiles: "image/*,application/pdf", //imagenes y pdf
   accept: function(file, done) {
       //console.log(file);
       done();
   },
   init: function() {
     this.on("success", function(statics,file) {
       var img = file.split("|");

       $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: app_url + 'beneficiarios/update_cedula_fiscal/<?=$datos['id_beneficiario']?>/' + img[1],
         type: 'POST',
         dataType: 'json',
         success: function(resp_success){
           if (resp_success['resp'] == true) {
             $('#img_actual8').html('<center><img src="../img/circle_pdf.png"></center>');
             swal('Se cargó su documento correctamente', '', "Actualizado!");
           }
         },
         error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-FIS');}
       });
     });
   }
  });

  $("#m-dropzone-9").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "upload/dropzone/documentos",   //contoller/metodo/folder
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 5, // MB
    acceptedFiles: "image/*,application/pdf", //imagenes y pdf
    accept: function(file, done) {
        //console.log(file);
        done();
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'beneficiarios/update_curp/<?=$datos['id_beneficiario']?>/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual9').html('<center><img src="../img/circle_pdf.png"></center>');
             swal('Se cargó su documento correctamente', '', "Actualizado!");
           }
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-CURP');}
        });
      });
    }
   });

  $("#m-dropzone-10").dropzone({
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   url: "upload/dropzone/documentos",   //contoller/metodo/folder
   paramName: "file",
   maxFiles: 5,
   maxFilesize: 5, // MB
   acceptedFiles: "image/*,application/pdf", //imagenes y pdf
   accept: function(file, done) {
       //console.log(file);
       done();
   },
   init: function() {
     this.on("success", function(statics,file) {
       var img = file.split("|");

       $.ajax({
         headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         url: app_url + 'beneficiarios/update_comprobante_fiel/<?=$datos['id_beneficiario']?>/' + img[1],
         type: 'POST',
         dataType: 'json',
         success: function(resp_success){
           if (resp_success['resp'] == true) {
             $('#img_actual10').html('<center><img src="../img/circle_pdf.png"></center>');
             swal('Se cargó su documento correctamente', '', "Actualizado!");
           }
         },
         error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-FIEL');}
       });
     });
   }
  });
});
</script>
