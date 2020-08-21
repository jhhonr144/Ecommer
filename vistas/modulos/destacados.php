<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();

$ruta = "sin-categoria";

$banner = ControladorProductos::ctrMostrarBanner($ruta);

$titulo1 = json_decode($banner["titulo1"],true);
$titulo2 = json_decode($banner["titulo2"],true);
$titulo3 = json_decode($banner["titulo3"],true);

if($banner != null){

echo '<figure class="banner">

		<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">	

		<div class="textoBanner '.$banner["estilo"].'">
			
			<h1 style="color:'.$titulo1["color"].'">'.$titulo1["texto"].'</h1>

			<h2 style="color:'.$titulo2["color"].'"><strong>'.$titulo2["texto"].'</strong></h2>

			<h3 style="color:'.$titulo3["color"].'">'.$titulo3["texto"].'</h3>

		</div>

	</figure>';

}


$titulosModulos = array("ARTÍCULOS GRATUITOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
$rutaModulos = array("articulos-gratis","lo-mas-vendido","lo-mas-visto");

$base = 0;
$tope = 4;

if($titulosModulos[0] == "ARTÍCULOS GRATUITOS"){

$ordenar = "id";
$item = "precio";
$valor = 0;
$modo = "DESC";

$gratis = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[1] == "LO MÁS VENDIDO"){

$ordenar = "ventas";
$item = "estado";
$valor = 1;
$modo = "DESC";

$ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[2] == "LO MÁS VISTO"){

$ordenar = "vistas";
$item = "estado";
$valor = 1;
$modo = "DESC";

$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

$modulos = array($gratis, $ventas, $vistas);

for ($i = 0; $i < count($titulosModulos); $i ++) {
    echo '<div class="container-fluid well well-sm barraProductos">
			<div class="container">				
				<div class="row">					
					<div class="col-xs-12 organizarProductos">
						<div class="btn-group pull-right">
							 <button type="button" class="btn btn-default btnGrid" id="btnGrid' . $i . '">
							 	<i class="fa fa-th" aria-hidden="true"></i>  
								<span class="col-xs-0 pull-right"> GRID</span>
							 </button>
							 <button type="button" class="btn btn-default btnList" id="btnList' . $i . '">							 	
								<i class="fa fa-list" aria-hidden="true"></i> 
								<span class="col-xs-0 pull-right"> LIST</span>
							 </button>							
						</div>		
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid productos">	
			<div class="container">		
				<div class="row">
					<div class="col-xs-12 tituloDestacado">
						<div class="col-sm-6 col-xs-12">					
							<h1><small>' . $titulosModulos[$i] . ' </small></h1>
						</div>
						<div class="col-sm-6 col-xs-12">					
							<a href="' . $rutaModulos[$i] . ' ">								
								<button class="btn btn-default backColor pull-right">									
									VER MÁS <span class="fa fa-chevron-right"></span>
								</button>
							</a>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
				</div>
				<ul class="grid' . $i . '">';
    foreach ($modulos[$i] as $key => $value) {
        echo '<li class="col-md-3 col-sm-6 col-xs-12">
            <figure>								
		<a href="' . $value["ruta"] . '" class="pixelProducto">
                	<img src="' . $servidor . $value["portada"] . '" class="img-responsive">
        	</a>
            </figure>
            <h4>				
		<small>
		<a href="' . $value["ruta"] . '" class="pixelProducto">' . $value["titulo"] . '<br>                                                                                  
										<span style="color:rgba(0,0,0,0)">-</span>';

        if ($value["nuevo"] != 0) {

            echo '<span class="label label-warning fontSize">Nuevo</span> ';
        }

        if ($value["oferta"] != 0) {

            echo '<span class="label label-warning fontSize">' . $value["descuentoOferta"] . '% off</span>';
        }

        echo '</a>	

								</small>			

							</h4>

							<div class="col-xs-6 precio">';

        if ($value["precio"] == 0) {

            echo '<h2><small>GRATIS</small></h2>';
        } else {

            if ($value["oferta"] != 0) {

                echo '<h2>

											<small>
						
												<strong class="oferta">USD $' . $value["precio"] . '</strong>

											</small>

											<small>$' . $value["precioOferta"] . '</small>
										
										</h2>';
            } else {

                echo '<h2><small>USD $' . $value["precio"] . '</small></h2>';
            }
        }

        echo '</div>

							<div class="col-xs-6 enlaces">
								
								<div class="btn-group pull-right">
									
									<button type="button" class="btn btn-default btn-xs deseos" idProducto="' . $value["id"] . '" data-toggle="tooltip" title="Agregar a mi lista de deseos">
										
										<i class="fa fa-heart" aria-hidden="true"></i>

									</button>';

        if ($value["tipo"] == "virtual" && $value["precio"] != 0) {

            if ($value["oferta"] != 0) {

                echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="' . $value["id"] . '" imagen="' . $servidor . $value["portada"] . '" titulo="' . $value["titulo"] . '" precio="' . $value["precioOferta"] . '" tipo="' . $value["tipo"] . '" peso="' . $value["peso"] . '" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';
            } else {

                echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="' . $value["id"] . '" imagen="' . $servidor . $value["portada"] . '" titulo="' . $value["titulo"] . '" precio="' . $value["precio"] . '" tipo="' . $value["tipo"] . '" peso="' . $value["peso"] . '" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';
            }
        }

        echo '<a href="' . $value["ruta"] . '" class="pixelProducto">
									
										<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
											
											<i class="fa fa-eye" aria-hidden="true"></i>

										</button>	
									
									</a>
<!--xxxxxxxxxxxxxxxxxxxxxxx-->
<a onclick="initialize('.$value['lon'].','.$value['lat'].');"   data-toggle="modal" data-target="#exampleModal">

							  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver mapa">

							  		<i class="fa fa-map" aria-hidden="true"></i>

							  		</button>

						  		</a>	
                                                                <!--xxxxxxxxxxxxxxxxxxxxxxx-->
                                                     



                                                                <!--VVVVVVVVVVVVVVVVVVVVVVVVVV--> 

  
    <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0N2feQ74Fj_1DVmhUj_pRSB0Zqu8G94s"></script>
';
        
            echo '   <script> 
var map;
function initialize(lon,lat) {   

navigator.geolocation.getCurrentPosition(coords);
function coords(position){ 
var latx= position.coords.latitude;
var lonx=  position.coords.longitude; 
          initi(latx,lonx,lat,lon);
}
            
         

  
}
    </script>
    ';
       
       echo '  
          <script> 
          function initi(latx,lonx,lat,lon) {  
 var directionsService = new google.maps.DirectionsService();
   var directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
  icon: "https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png", 
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);  
   var request = {   
   destination: {lat:latx, lng: lonx },
       origin:{lat:lat, lng: lon},  
       travelMode: google.maps.DirectionsTravelMode.DRIVING
   };   
   directionsDisplay.setMap(map);
   directionsService.route(request, function(response, status) {
   alert
      if (status == google.maps.DirectionsStatus.OK) { 
         directionsDisplay.setDirections(response);
      }
   });
 
 
   /*son moblible y sale alado de los que son  
  var marker = new google.maps.Marker({
    position: {lat:latx, lng: lonx },
    draggable: true,
    labelContent: "A",
    title:"Hello World!"
  });
   var markeru = new google.maps.Marker({
    position: {lat:lat, lng: lon },
    draggable: true,
    labelContent: "B",
    title:"Hello World!"
  });
marker.setMap(map);
 markeru.setMap(map);*/
   }
          </script>';
    
        echo '

                                                                <!--vvvvvvvvvvvvvvvvvvvvvvvvv-->
								</div>

							</div>

						</li>';
    }

    echo '</ul>

				<ul class="list' . $i . '" style="display:none">';

    foreach ($modulos[$i] as $key => $value) {

        echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="' . $value["ruta"] . '" class="pixelProducto">
									
									<img src="' . $servidor . $value["portada"] . '" class="img-responsive">

								</a>

							</figure>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>

									<a href="' . $value["ruta"] . '" class="pixelProducto">

										<a href="' . $value["ruta"] . '" class="pixelProducto">
										
										' . $value["titulo"] . '<br>';

        if ($value["nuevo"] != 0) {

            echo '<span class="label label-warning">Nuevo</span> ';
        }

        if ($value["oferta"] != 0) {

            echo '<span class="label label-warning">' . $value["descuentoOferta"] . '% off</span>';
        }

        echo '</a>

								</small>

							</h1>

							<p class="text-muted">' . $value["titular"] . '</p>';

        if ($value["precio"] == 0) {

            echo '<h2><small>GRATIS</small></h2>';
        } else {

            if ($value["oferta"] != 0) {

                echo '<h2>

											<small>
						
												<strong class="oferta">USD $' . $value["precio"] . '</strong>

											</small>

											<small>$' . $value["precioOferta"] . '</small>
										
										</h2>';
            } else {

                echo '<h2><small>USD $' . $value["precio"] . '</small></h2>';
            }
        }

        echo '<div class="btn-group pull-left enlaces">
						  	
						  		<button type="button" class="btn btn-default btn-xs deseos"  idProducto="' . $value["id"] . '" data-toggle="tooltip" title="Agregar a mi lista de deseos">

						  			<i class="fa fa-heart" aria-hidden="true"></i>

						  		</button>';

        if ($value["tipo"] == "virtual" && $value["precio"] != 0) {

            if ($value["oferta"] != 0) {

                echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="' . $value["id"] . '" imagen="' . $servidor . $value["portada"] . '" titulo="' . $value["titulo"] . '" precio="' . $value["precioOferta"] . '" tipo="' . $value["tipo"] . '" peso="' . $value["peso"] . '" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';
            } else {

                echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="' . $value["id"] . '" imagen="' . $servidor . $value["portada"] . '" titulo="' . $value["titulo"] . '" precio="' . $value["precio"] . '" tipo="' . $value["tipo"] . '" peso="' . $value["peso"] . '" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';
            }
        }

        echo '<a href="' . $value["ruta"] . '" class="pixelProducto">

							  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>
                                                                <!--xxxxxxxxxxxxxxxxxxxxxxx-->
<a onclick="initialize();" class="pixelProducto">

							  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver MAPA">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>	
                                                                <!--xxxxxxxxxxxxxxxxxxxxxxx-->

							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';
    }

    echo '</ul>

			</div>

		</div>';
}
?>





<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog"  role="document" >
        <div class="modal-content" style="background: rgb(71, 186, 193); color: rgb(255, 255, 255);">
            <div class="modal-header" > 
                <h4  ><center><B>UBICACION DEL PRODUCTO DESEADO.</b></center></h4>
                <button style="
                        background: rgb(71, 186, 193);
background: -webkit-gradient(linear, 0 0, 0 bottom, from(#0ac2ea), to(#0ac2a0));
background: -moz-linear-gradient(#0ac2ea, #0ac2a0);
background: linear-gradient(#0ac2ea, #0ac2a0);
-pie-background: linear-gradient(#0ac2ea, #0ac2a0);

box-shadow: 5px -9px 3px #333;
-webkit-box-shadow: #666 0px 2px 3px;
-moz-box-shadow: #666 0px 2px 3px;
 
                        "type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div> 
            <div id="map-canvas" style="width: 100%;min-height: 400px;height: 100%;"></div>
            <div class="modal-footer">
                  
                <button style="
                        background: rgb(71, 186, 193);
background: -webkit-gradient(linear, 0 0, 0 bottom, from(#0ac2ea), to(#0ac2a0));
background: -moz-linear-gradient(#0ac2ea, #0ac2a0);
background: linear-gradient(#0ac2ea, #0ac2a0);
-pie-background: linear-gradient(#0ac2ea, #0ac2a0);

box-shadow: 5px -9px 3px #333;
-webkit-box-shadow: #666 0px 2px 3px;
-moz-box-shadow: #666 0px 2px 3px;
 
                        " type="button" class="btn navbar-btn mx-2 text-black btnn-outline-light  " draggable="true" data-dismiss="modal"><B>Entendido.</B></button>                
            </div>
        </div>
    </div>
</div>