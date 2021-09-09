<?php
	$mysqli = new MYSQLI('localhost','root','','farmacia');
	if (isset($_POST['Guardar']))
	{
		$nombre = $_POST['nombre'];
		$laboratorioGuardar = $_POST['laboratorioGuardar'];
		$stock = $_POST['stock'];
		$precio = $_POST['precio'];
		$observacion = $_POST['observacion'];
		$sql = "INSERT INTO farmaco (cod_far, nom_far, lab_far, sto_far, pre_far, obs_far) VALUES (null, '$nombre', '$laboratorioGuardar', '$stock', '$precio', '$observacion')";
		$agregar = $mysqli->query($sql);
	}
	if(isset($_GET['cod_far']))
	{
		$id = $_GET['cod_far'];
		$sql = "SELECT sto_far FROM farmaco WHERE cod_far = '$id'";
		$stock = $mysqli->query($sql);
		$stock = $stock->fetch_array();
		if(intval($stock[0]) > 0)
		{
			$sql = "UPDATE farmaco SET sto_far = sto_far-1 WHERE cod_far = '$id'";
			$modificar = $mysqli->query($sql);
		}
		else
		{
			echo '<script language="javascript">alert("No queda en stock")</script>';
		}
	}
?>

<!doctype html>
<head>
	<title>farmacos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script src="js/validacion.js"></script>
</head>
<body>
	<div class="container">
		<h2>BUSQUEDA DE FARMACOS</h2>
		<form method="post" action="mantenedorFarmacos.php" onSubmit="return validaBuscar();">
			<label for="laboratorioBuscar">
				Laboratorio
			</label>
	        <select name="laboratorioBuscar" id="laboratorio">
			    <option disabled selected hidden>-seleccionar-</option>
			    <option value="Bayer">Bayer</option>
			    <option value="Chile">Chile</option>
			    <option value="Ferre">Ferre</option>
			    <option value="Pharma">Pharma</option>
		    </select>
	        <button type="submit" name="Buscar">Buscar</button>
		</form>
		<form method="post" action="mantenedorFarmacos.php">
		    <center>
		    	<button type="submit" style="margin-top: 20px;">Listar</button>
		    </center>
		</form>
	</div>
	<div>
	<table border="1" class="container">
	<tr>
	    <th> Id </th>
	    <th> Nombre </th>
	    <th> Laboratorio </th>
	    <th> Stock </th>
	    <th> Precio </th>
	    <th> Observación </th>
	</tr>
	<?php
		if(isset($_POST['Buscar']))
		{
			$laboratorio = $_POST['laboratorioBuscar'];
		    $sql = "SELECT cod_far, nom_far, lab_far, sto_far, pre_far, obs_far FROM farmaco WHERE lab_far = '$laboratorio' ORDER BY sto_far DESC";
		}
		else
		{
	    	$sql = "SELECT cod_far, nom_far, lab_far, sto_far, pre_far, obs_far FROM farmaco ORDER BY sto_far DESC";	
		}
	    $listar = $mysqli->query($sql);
	    while ( $registro = $listar->fetch_array() )
	    {
	?>
	<tr>
	    <td> <?php echo $registro['cod_far'] ?> </td>
	    <td> <a href="mantenedorFarmacos.php?cod_far=<?php echo $registro['cod_far'] ?>"><?php echo $registro['nom_far'] ?></a> </td>
	    <td> <?php echo $registro['lab_far'] ?> </td>
	    <td> <?php echo $registro['sto_far'] ?> </td>
	    <td> <?php echo $registro['pre_far'] ?> </td>
	    <td> <?php echo $registro['obs_far'] ?> </td>
	</tr>
	<?php } ?>
	</table>
	</div>
	<div class="container">
		<h2>AGREGUE UN NUEVO FARMACO</h2>
		<form method="post" action="mantenedorFarmacos.php" onSubmit="return validaGuardar();">
			<div id="container">
				<div>
					<label for="nombre">NOMBRE</label>
				</div>
				<div class="campo">
					<input type="text" name="nombre" id="nombre">
				</div>
				<div>
					<label for="laboratorioGuardar">LABORATORIO</label>
				</div>
				<div class="campo">
			        <select name="laboratorioGuardar" id="laboratorioGuardar">
						<option disabled selected hidden>-seleccionar-</option>
				        <option value="Bayer">Bayer</option>
				        <option value="Chile">Chile</option>
				        <option value="Ferre">Ferre</option>
				        <option value="Pharma">Pharma</option>
			        </select>
		        </div>
		        <div>
					<label for="stock">STOCK</label>
				</div>
				<div class="campo">
					<input type="number" name="stock" id="stock">
				</div>
				<div>
					<label for="precio">PRECIO</label>
				</div>
				<div class="campo">
					<input type="number" name="precio" id="precio">
				</div>	
			</div>
			<div>
				<label for="stock">OBSERVACION</label>
			</div>	
				<textarea name="observacion" id="observacion"></textarea>
			<div id="guardado">
			    <button type="submit" name="Guardar">Guardar</button>
			    <button type="reset">Limpiar</button>
		    </div>
		</form>
	</div>
</body>