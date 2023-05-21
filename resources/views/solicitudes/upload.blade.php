<!--Section: Team v.1-->
<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / <a href="javascript:;" onclick="carga_archivo(\'contenedor_principal\',\'solicitudes/listado\');">GF SNTE 5</a> / Solicitud / Carga / <?=$datos['titular']?>');
</script>

<div class="row">

  <div class="col-xl-3 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if ($datos['ine_fallecido']){
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
              INE
            </span>
            <a href="" class="m-card-profile__email m-link">
              Fallecido
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
                <div class="m-dropzone dropzone" id="m-dropzone-one">
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
              if ($datos['acta_nac_fallecido']){
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
              Acta Nacimiento
            </span>
            <a href="" class="m-card-profile__email m-link">
              Fallecido
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
                <div class="m-dropzone dropzone" id="m-dropzone-two">
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
              if ($datos['acta_defuncion']){
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
              Acta Defunción
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
                <div class="m-dropzone dropzone" id="m-dropzone-three">
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
              if ($datos['fto_reclamacion']){
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
              Formato Reclamación
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
                <div class="m-dropzone dropzone" id="m-dropzone-four">
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
  $("#m-dropzone-one").dropzone({
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
          url: app_url + 'solicitudes/update_ine/<?=$datos['id_solicitud']?>/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual1').html('<center><img src="../img/circle_pdf.png"></center>');
    					swal('Se cargó su documento correctamente', '', "Actualizado!");
    				}
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-INE');}
        });
      });
    }
   });

   $("#m-dropzone-two").dropzone({
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
           url: app_url + 'solicitudes/update_act_nac/<?=$datos['id_solicitud']?>/' + img[1],
           type: 'POST',
           dataType: 'json',
           success: function(resp_success){
             if (resp_success['resp'] == true) {
               $('#img_actual2').html('<center><img src="../img/circle_pdf.png"></center>');
     					swal('Se cargó su documento correctamente', '', "Actualizado!");
     				}
           },
           error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-NAC');}
         });
       });
     }
    });

    $("#m-dropzone-three").dropzone({
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
            url: app_url + 'solicitudes/update_act_def/<?=$datos['id_solicitud']?>/' + img[1],
            type: 'POST',
            dataType: 'json',
            success: function(resp_success){
              if (resp_success['resp'] == true) {
                $('#img_actual3').html('<center><img src="../img/circle_pdf.png"></center>');
      					swal('Se cargó su documento correctamente', '', "Actualizado!");
      				}
            },
            error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-DEF');}
          });
        });
      }
     });

     $("#m-dropzone-four").dropzone({
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
             url: app_url + 'solicitudes/update_fto_rec/<?=$datos['id_solicitud']?>/' + img[1],
             type: 'POST',
             dataType: 'json',
             success: function(resp_success){
               if (resp_success['resp'] == true) {
                 $('#img_actual4').html('<center><img src="../img/circle_pdf.png"></center>');
       					swal('Se cargó su documento correctamente', '', "Actualizado!");
       				}
             },
             error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-REC');}
           });
         });
       }
      });

});
</script>
