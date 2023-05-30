<script>
$("#breadcrumb-title").append('<?=$datos['breadcrumbs']?>');
</script>
<?php
if($datos['type'] == 'pdf'){
    echo '<object data="'.env('APP_URL').$datos['path'].'?token='.Helpme::token().'" type="application/pdf" style="min-height:100vh;width:100%"></object>';
}elseif($datos['type'] == 'jpg'){
 echo '<object data="'.$datos['path'].'" style="min-height:100vh;width:100%" type="image/jpg"></object>';
}elseif($datos['type'] == 'png'){
 echo '<object data="'.$datos['path'].'" style="min-height:100vh;width:100%" type="image/jpg"></object>';
}
?>

<style>
.m-body .m-content {
    padding: 5px;
}
</style>
