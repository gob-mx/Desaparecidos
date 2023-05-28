<script>
$("#breadcrumb-title").append('<?=$datos['breadcrumbs']?>');
</script>

<object data="<?=env('APP_URL')?><?=$datos['path']?>?token=<?=Helpme::token()?>" type="application/pdf" style="min-height:100vh;width:100%"></object>

<style>
.m-body .m-content {
    padding: 5px;
}
</style>
