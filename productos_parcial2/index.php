<?php
	ob_start();
	require_once 'conexion.php';
	
	//PRODUCTOS
	$db_conexionP = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre, $port);
	$db_conexionP ->real_query("SELECT p.id_producto AS id, p.producto, m.marca, p.descripcion, p.precio_costo, p.precio_venta, p.existencia FROM productos AS p INNER JOIN marcas AS m ON p.id_marca = m.id_marca;");
	$resultadoP = $db_conexionP->use_result();

	//MARCAS	
	$db_conexionM = mysqli_connect($db_host,$db_user,$db_pass,$db_nombre, $port);
	$db_conexionM ->real_query("SELECT id_marca AS id, marca FROM marcas");
	$resultadoM = $db_conexionM->use_result();
?>

<!doctype html>
<html lang="en">
  <head>
	<title>Productos - Parcial2</title>
	<link rel="shortcut icon" href="imgs/iconProducto.png" />
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body background="imgs/fondo.png" style="background-size: cover; background-repeat: no-repeat; margin: 0px; height: 100%;">
  	<div class="container" style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
	  	<h1 class="text-center"> Formulario Productos </h1>
	</div>
	  <div class="container" style="padding:10px; background-color: white; width: 100%;">
		  <form class="d-flex" action="nuevo.php" method="POST">
			<div class="col">
			  <div class="row">  
			  	<div class="col-md-6">
					<label for="lbl_producto" class="form-label"><b>Producto</b></label>
					<input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="Desodorante/Cloro/Medicina" required>
				</div>

				<div class="col-md-6">
				  <label for="lbl_marca" class="form-label"><b>Marca</b></label>
				  <select class="form-select" name="drop_marca" id="drop_marca" required>
					<option value=0>--- Elija la Marca ---</option>
					
					<?php
						while($filaMarca = $resultadoM->fetch_assoc()){
							echo"<option value=". $filaMarca['id'] .">". $filaMarca['marca'] ."</option>";
						}
						$db_conexionM->close();
					?>

				  </select>
				</div>
			  </div>

			  <div class="row" style="margin-top: 1em;">
				<div class="col-md-6">
				<label for="lbl_pcosto" class="form-label"><b>Precio Costo</b></label>
					<input type="number" step="0.01" name="txt_pcosto" id="txt_pcosto" class="form-control" placeholder="8.25" required>
				</div>

				<div class="col-md-6">
					<label for="lbl_pventa" class="form-label"><b>Precio Venta</b></label>
					<input type="number" step="0.01" name="txt_pventa" id="txt_pventa" class="form-control" placeholder="14.50" required>
				</div>
			  </div>

			  <div class="row" style="margin-top: 1em;">

				<div class="col-md-6">
					<label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
					<textarea class="form-control" name="txt_descripcion" id="txt_descripcion" rows="3" placeholder="Descripcion del producto..."></textarea>
				</div>

				<div class="col-md-6">
					<label for="lbl_existencia" class="form-label"><b>Existencias</b></label>
					<input type="number" name="txt_existencia" id="txt_existencia" class="form-control" placeholder="100" required>
				</div>
			  </div>
				
				<div class="text-center" style="margin-top: 1em;">
					<input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="Agregar">
				</div>

			</div>
		  </form>
	  </div>
	  <div class="container" style="padding:10px; background-color: #1B1F78; color:white; margin-top: 2em;">
	  	<h1 class="text-center"> Lista de Productos </h1>
	  </div>
	  <div class="container" style="padding:10px; background-color: white; width: 100%;">
		  <br>

		  <table class="table table-striped table-inverse table-responsive">
			  <thead class="thead-inverse">
				  <tr>
					  <th>Producto</th>
					  <th>Marca</th>
					  <th>Descripcion</th>
					  <th>Precio Costo</th>
					  <th>Precio Venta</th>
					  <th>Existencias</th>
					  <th>Acciones</th>
				  </tr>
				  </thead>
				  <tbody>
				    
					<?php
						while($filaProducto = $resultadoP->fetch_assoc()){
							echo "<tr data-id=". $filaProducto['id'] .">";
								echo"<td>". $filaProducto['producto'] ."</td>";
								echo"<td>". $filaProducto['marca'] ."</td>";
								echo"<td>". $filaProducto['descripcion'] ."</td>";
								echo"<td>". $filaProducto['precio_costo'] ."</td>";
								echo"<td>". $filaProducto['precio_venta'] ."</td>";
								echo"<td>". $filaProducto['existencia'] ."</td>";
								echo"<td><a href='editar.php?id=".$filaProducto['id']."' class='btn btn-warning'>Editar</a></td>";
								echo"<td><a href='eliminar.php?id=".$filaProducto['id']."' class='btn btn-danger'>Eliminar</a></td>";
								
							echo"</tr>";
						}
						$db_conexionP->close();
					?>
				  </tbody>
		  </table>

	  </div>						

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
  <footer>

</html>
