
<?php

/*=============================================
CREADOR DE IP
=============================================*/

//https://www.browserling.com/tools/random-ip

//$ip = $_SERVER['REMOTE_ADDR'];

$ip = "153.205.198.22";

//http://www.geoplugin.net/

$informacionPais = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);

$datosPais = json_decode($informacionPais);

$pais = $datosPais->geoplugin_countryName;
$codigo = $datosPais->geoplugin_countryCode;

$enviarIp = ControladorVisitas::ctrEnviarIp($ip, $pais, $codigo);

$totalVisitas = ControladorVisitas::ctrMostrarTotalVisitas();

?>

<!--=====================================
BREADCRUMB VISITAS
======================================-->
<div class="container-fluid well well-sm">

	<div class="container">
	
		<div class="row">

			<ul class="breadcrumb lead">

			<h2 class="pull-right"><small>Tu eres nuestro visitante # <?php echo $totalVisitas["total"];?></small></h2>

			</ul>

		</div>

	</div>

</div>

