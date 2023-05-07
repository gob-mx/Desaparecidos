<!--Section: Team v.1-->
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="m-portlet m-portlet--full-height  ">
      <div class="m-portlet__body" id="result_excel">
        <div class="m-card-profile">
          <div class="m-card-profile__pic">
            <div class="m-card-profile__pic-wrapper">

                    <div class="profile-userpic" id="avatar_actual">
                      <img src="../plugs/timthumb.php?src=../img/Excel-2-icon.png&w=300&h=300">
                    </div>

            </div>
          </div>
          <div class="m-card-profile__details">
            <span class="m-card-profile__name">
              Procesar Excel
            </span>
            <a href="javascript:void(0);" class="m-card-profile__email m-link">
              Arrastre un archivo de excel verificado para procesar los registros
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
                      Arrastra aqui el archivo para su procesamiento.
                    </h3>
                    <span class="m-dropzone__msg-desc">
                      Actualmente
                      <strong>
                        no
                      </strong>
                      se han subido archivos.
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
    url: "excel/upload_process/excel/procesar",<?php //excel/upload_process/estructura|del|directorio/permisos ?>
    paramName: "file",
    maxFiles: 1,
    maxFilesize: 128, // MB
    acceptedFiles: ".xls,.xlsx,.XLS,.XLSX,.csv,.CSV",
    accept: function(file, done) {
        //console.log(file);
        done();
        $('#avatar_actual').html('<img style="max-width: 300px!important;" src="img/image_processing20210914-26906-1iuycbf.gif">');
    },
    init: function() {
      this.on("success", function(statics,file) {
        var img = file.split("|");
        $.post( "excel/process/" + img[1], function( data ) {
           //swal(data, '', "Upload")
           $('#result_excel').html(data);
        });
      });
    }
   });
});
</script>
<style>
  .hoja {
    color: red;
  }
</style>
