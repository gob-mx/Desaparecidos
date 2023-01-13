<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
  </button>

  @include('plantilla/left_sidebar_menu')

  <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <?php //@include('plantilla/subheader')?>
    <div class="m-content" id="contenedor_principal">
        @include('inicio/index')
    </div>
  </div>

</div>

<?php
if($_SESSION['id_rol'] == 2){
?>
<script>
jQuery(document).ready(function() {
  $("#m_aside_left").remove();
  $('.m-footer').remove();
  //$("#m_header").remove();
  carga_archivo('contenedor_principal','tamizaje');
});
</script>
<style>
.m-header--fixed .m-body {
    padding-top: 70px!important;
}
</style>
<?php
}
?>
