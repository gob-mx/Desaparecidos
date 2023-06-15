<!--Section: Team v.1-->
<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / Carga Excel');
</script>

<div class="row">

  <div class="col-12 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if (1 == 1){
              ?>
                    <div class="profile-userpic" id="img_actual1">
                      <img src="../img/excel.png">
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
              CBP
            </span>
            <a href="" class="m-card-profile__email m-link">
              Comision de Busqueda de Personas CDMX
            </a>
          </div>
        </div>

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

      </div>
    </div>
  </div>

  <div class="col-12 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if (1 == 1){
              ?>
                    <div class="profile-userpic" id="img_actual2">
                      <img src="../img/excel.png">
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
              CNB
            </span>
            <a href="" class="m-card-profile__email m-link">
              Comision Nacional de Busqueda
            </a>
          </div>
        </div>

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

      </div>
    </div>
  </div>

  <div class="col-12 col-lg-4">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

              <?php
              if (1 == 1){
              ?>
                    <div class="profile-userpic" id="img_actual3">
                      <img src="../img/excel.png">
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
              FGJ
            </span>
            <a href="" class="m-card-profile__email m-link">
              Fiscalia General de Justicia de la CDMX - <i>SIGIPEA</i>
            </a>
          </div>
        </div>

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

      </div>
    </div>
  </div>

</div>
<script>
$(document).ready(function() {
  $("#m-dropzone-one").dropzone({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    url: "upload/dropzone/excel|cbp",   //contoller/metodo/folder
    paramName: "file",
    maxFiles: 5,
    maxFilesize: 64, // MB
    acceptedFiles: ".csv,.CSV",
    accept: function(file, done) {
        //console.log(file);
        done();
        $('#img_actual1').html('<img style="max-width: 120px!important;" src="img/gears2.svg">');
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");

        $.ajax({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: app_url + 'desaparecidos/upload_cbp/' + img[1],
          type: 'POST',
          dataType: 'json',
          success: function(resp_success){
            if (resp_success['resp'] == true) {
              $('#img_actual1').html('<center><img src="../img/excel.png"></center>');
    					swal('Se cargó su documento correctamente', '', "Actualizado!");
    				}
          },
          error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-CBP');}
        });
      });
    }
   });

   $("#m-dropzone-two").dropzone({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     url: "upload/dropzone/excel|cnb",   //contoller/metodo/folder
     paramName: "file",
     maxFiles: 5,
     maxFilesize: 64, // MB
     acceptedFiles: ".csv,.CSV",
     accept: function(file, done) {
         //console.log(file);
         done();
         $('#img_actual2').html('<img style="max-width: 120px!important;" src="img/gears2.svg">');
     },
     init: function() {
       this.on("success", function(statics,file) {
         var img = file.split("|");

         $.ajax({
           headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           url: app_url + 'desaparecidos/upload_cnb/' + img[1],
           type: 'POST',
           dataType: 'json',
           success: function(resp_success){
             if (resp_success['resp'] == true) {
               $('#img_actual2').html('<center><img src="../img/excel.png"></center>');
     					swal('Se cargó su documento correctamente', '', "Actualizado!");
     				}
           },
           error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-CNB');}
         });
       });
     }
    });

    $("#m-dropzone-three").dropzone({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: "upload/dropzone/excel|fgj",   //contoller/metodo/folder
      paramName: "file",
      maxFiles: 5,
      maxFilesize: 64, // MB
      acceptedFiles: ".csv,.CSV",
      accept: function(file, done) {
          //console.log(file);
          done();
          $('#img_actual3').html('<img style="max-width: 120px!important;" src="img/gears2.svg">');
      },
      init: function() {
        this.on("success", function(statics,file) {
          var img = file.split("|");

          $.ajax({
            headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: app_url + 'desaparecidos/upload_fgj/' + img[1],
            type: 'POST',
            dataType: 'json',
            success: function(resp_success){
              if (resp_success['resp'] == true) {
                $('#img_actual3').html('<center><img src="../img/excel.png"></center>');
      					swal('Se cargó su documento correctamente', '', "Actualizado!");
      				}
            },
            error: function(respuesta){ alerta('Alerta!','Error de conectividad de red UPLOAD-FGJ');}
          });
        });
      }
     });

});
</script>
