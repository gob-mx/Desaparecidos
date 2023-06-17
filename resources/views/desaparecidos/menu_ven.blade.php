<script>
$("#breadcrumb-title").html('<?=env('APP_NAME')?>');
$("#breadcrumb-title").append(' / FileControl / Menu');
</script>

<div class="m-portlet m-portlet--mobile">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<h3 class="m-portlet__head-text">
					Seleccione para visualizar
				</h3>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<style>
		    img.menu {
		        display: block;
		        max-width: 100%;
		        height: auto;
						margin: auto;
		    }
		</style>
		<!-- Image Map Generated by http://www.image-map.net/ -->
		<!--<img src="img/menu2.svg" usemap="#image-map" class="menu">
		<map name="image-map">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','fgj');" alt="FGJ" title="FGJ" coords="790,579,108" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cbp');" alt="CBP" title="CBP" coords="1582,136,104" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cnb');" alt="CNB" title="CNB" coords="192,122,112" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cbpfgj');" alt="CBP-FGJ" title="CBP-FGJ" coords="1497,529,69" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cnbfgj');" alt="CNB-FGJ" title="CNB-FGJ" coords="241,562,73" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cnbcbp');" alt="CNB-CBP" title="CNB-CBP" coords="860,139,69" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','unificada');" alt="CBP-CNB-FGJ" title="CBP-CNB-FGJ" coords="818,325,74" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cbpfgjdup');" alt="CBP-FGJ-DUP" title="CBP-FGJ-DUP" coords="1601,631,26" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cnbfgjdup');" alt="CNB-FGJ-DUP" title="CNB-FGJ-DUP" coords="114,437,28" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','cnbcbpdup');" alt="CNB-CBP-DUP" title="CNB-CBP-DUP" coords="742,60,30" shape="circle">
		    <area href="javascript:void(0);" onclick="carga_archivo('contenedor_principal','unificadadup');" alt="CBP-CNB-FGJ-DUP" title="CBP-CNB-FGJ-DUP" coords="675,402,34" shape="circle">
		</map>-->


		<!-- Image Map Generated by http://www.image-map.net/ -->
			<img src="img/menu.svg" usemap="#image-map" class="menu">
			<map name="image-map">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','fgj');" alt="FGJ" title="FGJ" href="" coords="332,450,107" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cbp');" alt="CBP" title="CBP" href="" coords="560,186,103" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cnb');" alt="CNB" title="CNB" href="" coords="142,196,102" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cbpfgj');" alt="CBP-FGJ" title="CBP-FGJ" href="" coords="550,394,62" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cnbcbp');" alt="CNB-CBP" title="CNB-CBP" href="" coords="351,103,59" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cnbfgj');" alt="CNB-FGJ" title="CNB-FGJ" href="" coords="122,393,62" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','unificada');" alt="CBP-CNB-FGJ" title="CBP-CNB-FGJ" href="" coords="371,250,68" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cbpfgjdup');" alt="CBP-FGJ-DUP" title="CBP-FGJ-DUP" href="" coords="623,473,26" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cnbfgjdup');" alt="CNB-FGJ-DUP" title="CNB-FGJ-DUP" href="" coords="53,326,27" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','cnbcbpdup');" alt="CNB-CBP-DUP" title="CNB-CBP-DUP" href="" coords="267,54,30" shape="circle">
			    <area href="javaScript:void(0);" onclick="carga_archivo('contenedor_principal','unificadadup');" alt="CBP-CNB-FGJ-DUP" title="CBP-CNB-FGJ-DUP" href="" coords="272,303,34" shape="circle">
			</map>

	</div>

</div>

<script>
    $(function () {
        ImageMap('img[usemap]');
    });
    function selectRegion(region) {
        document.querySelector("img").setAttribute('src', 'image-map-' + region + '.png');
    }

</script>
