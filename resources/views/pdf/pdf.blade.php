<?php
if($_SESSION['id_rol'] == 2){
?>
    <script>
    location.href ='<?=env('APP_URL')?><?=$datos['path']?>';
    </script>
<?php
}else{
?>
    <script>
    $("#breadcrumb-title").html('<?=env('APP_NAME')?>');
    $("#breadcrumb-title").append(' / PDF');
    </script>
    <object data="<?=env('APP_URL')?><?=$datos['path']?>" type="application/pdf" style="min-height:100vh;width:100%"></object>
<?php
}
?>
<style>
.m-body .m-content {
    padding: 5px;
}
</style>
