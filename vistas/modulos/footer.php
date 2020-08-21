<!--=====================================
FOOTER
======================================-->

<footer class="container-fluid">

	<div class="container">

		<div class="row">

		 	<!--=====================================
			CATEGORÍAS Y SUBCATEGORÍAS FOOTER
			======================================-->

			<div class="col-lg-5 col-md-6 col-xs-12 footerCategorias">

			<?php

				$url = Ruta::ctrRuta();

				$item = null;
				$valor = null;

				$categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

				foreach ($categorias as $key => $value) {

					if($value["estado"] != 0){

						echo '<div class="col-lg-4 col-md-3 col-sm-4 col-xs-12">

							<h4><a href="'.$url.$value["ruta"].'" class="pixelCategorias" titulo="'.$value["categoria"].'">'.$value["categoria"].'</a></h4>

							<hr>

							<ul>';

							$item = "id_categoria";

							$valor = $value["id"];

							$subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
							
							foreach ($subcategorias as $key => $value) {

								if($value["estado"] != 0){
							
									echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias" titulo="'.$value["subcategoria"].'">'.$value["subcategoria"].'</a></li>';

								}

							}

							echo '</ul>

						</div>';

					}

				}

			?>

			</div>

			<!--=====================================
			DATOS CONTACTO
			======================================-->

			<div class="col-md-3 col-sm-6 col-xs-12 text-left infoContacto">
				
				<h5>contáctenos en:</h5>

				<br>
				
				<h5>
					
					<i class="fa fa-phone-square" aria-hidden="true"></i> (302) 342-32-60

					<br><br>

					<i class="fa fa-envelope" aria-hidden="true"></i> paarcas@gmail.com

					<br><br>

					<i class="fa fa-map-marker" aria-hidden="true"></i>  Diagonal 21 No. 29-56 Sabanas del Valle

					<br><br>
					Valledupar | Cesar

				</h5>

				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.6357955667354!2d-73.26287288543969!3d10.450447892543245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e8ab9ee203ab5b3%3A0x67acd0380303e569!2sUniversidad+Popular+del+Cesar!5e0!3m2!1ses-419!2sco!4v1528338918922" width="200" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>

			</div>

			<!--=====================================
			FORMULARIO CONTÁCTENOS
			======================================-->

			<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12 formContacto">
				
				<h4>RESUELVA SU INQUIETUD</h4>

				<form role="form" method="post" onsubmit="return validarContactenos()">

			  		<input type="text" id="nombreContactenos" name="nombreContactenos" class="form-control" placeholder="Escriba su nombre" required> 

			   		<br>
	    	      
   					<input type="email" id="emailContactenos" name="emailContactenos" class="	form-control" placeholder="Escriba su correo electrónico" required>  

   					<br>
	    		     	          
	       			<textarea id="mensajeContactenos" name="mensajeContactenos" class="form-control" placeholder="Escriba su mensaje" rows="5" required></textarea>

	       			<br>
	    	
	       			<input type="submit" value="Enviar" class="btn btn-default backColor pull-right" id="enviar">         

				</form>

				<?php 

					$contactenos = new ControladorUsuarios();
					$contactenos -> ctrFormularioContactenos();

				?>

			</div>
			
		</div>

	</div>

</footer>


<!--=====================================
FINAL
======================================-->

