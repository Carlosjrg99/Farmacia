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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/pinzon1992/materialize_table_pagination/f9a8478f/js/pagination.js"></script>

	<title>farmacos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script src="js/validacion.js"></script>
</head>
<body>
	<div class="container">
		<h2>BUSQUEDA DE FÁRMACOS</h2>
		<form method="post" action="mantenedorFarmacos.php" onSubmit="return validaBuscar();">
                <div class="row">
                    <div class="input-field col s12">
						<h6>Laboratorio</h6>
                        <select name="laboratorioBuscar" id="laboratorio" class="browser-default">
					    <option disabled selected hidden>-seleccionar-</option>
						    <option value="Bayer">Bayer</option>
						    <option value="Chile">Chile</option>
						    <option value="Ferre">Ferre</option>
						    <option value="Pharma">Pharma</option>
                        </select>
                    </div>
                </div>
			<div class="input-field col s4">
			</div>
	        <button class="btn waves-effect waves-light" type="submit" name="Buscar">Buscar</button>
		</form>
		<form method="post" action="mantenedorFarmacos.php">
		    <center>
		    	<button class="btn waves-effect waves-light" type="submit" style="margin-top: 20px;">Listar</button>
		    </center>
		</form>


		<table border="1" class="responsive-table" id="myTable">
			<thead>
				<tr>
				    <th> Nombre </th>
				    <th> Laboratorio </th>
				    <th> Stock </th>
				    <th> Precio </th>
				    <th> Observación </th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(isset($_POST['Buscar']))
					{
						$laboratorio = $_POST['laboratorioBuscar'];
					    $sql = "SELECT cod_far, nom_far, lab_far, sto_far, pre_far, obs_far FROM farmaco WHERE lab_far = '$laboratorio' ORDER BY nom_far ASC";
					}
					else
					{
				    	$sql = "SELECT cod_far, nom_far, lab_far, sto_far, pre_far, obs_far FROM farmaco ORDER BY nom_far ASC";	
					}
				    $listar = $mysqli->query($sql);
				    while ( $registro = $listar->fetch_array() )
				    {
				?>
				<tr>
				    <td> <a href="mantenedorFarmacos.php?cod_far=<?php echo $registro['cod_far'] ?>"><?php echo $registro['nom_far'] ?></a> </td>
				    <td> <?php echo $registro['lab_far'] ?> </td>
				    <td> <?php echo $registro['sto_far'] ?> </td>
				    <td> <?php echo $registro['pre_far'] ?> </td>
				    <td> <?php echo $registro['obs_far'] ?> </td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="col-md-12 center text-center">
            <span class="left" id="total_reg"></span>
            <ul class="pagination pager" id="myPager"></ul>
        </div>
	</div>

	<div class="container">
		<h2  id="nuevo-farmaco">AGREGUE UN NUEVO FÁRMACO</h2>
		<form method="post" action="mantenedorFarmacos.php" onSubmit="return validaGuardar();">
			<div id="container">
				<div>
					<h6 for="nombre">NOMBRE</h6>
				</div>
				<div class="campo">
					<input type="text" name="nombre" id="nombre">
				</div>
				<div>
					<h6 for="laboratorioGuardar">LABORATORIO</h6>
				</div>
				<div class="campo">
                        <select name="laboratorioGuardar" id="laboratorioGuardar" class="browser-default">
					    <option disabled selected hidden>-seleccionar-</option>
						    <option value="Bayer">Bayer</option>
						    <option value="Chile">Chile</option>
						    <option value="Ferre">Ferre</option>
						    <option value="Pharma">Pharma</option>
                        </select>
		        </div>
		        <div>
					<h6 for="stock">STOCK</h6>
				</div>
				<div class="campo">
					<input type="number" name="stock" id="stock">
				</div>
				<div>
					<h6 for="precio">PRECIO</h6>
				</div>
				<div class="campo">
					<input type="number" name="precio" id="precio">
				</div>	
			</div>
			<div>
				<h6 for="stock">OBSERVACIÓN</h6>
			</div>	
				<textarea name="observacion" id="observacion"></textarea>
			<div id="guardado">
			    <button class="btn waves-effect waves-light" type="submit" name="Guardar">Guardar</button>
			    <button class="btn waves-effect waves-light" type="reset">Limpiar</button>
		    </div>
		</form>
	</div>

    <script type="text/javascript" src="js/materialize.min.js"></script>

	<script>
	    $(document).ready(function(){
	        $('#myTable').pageMe({
	            pagerSelector:'#myPager',
	            activeColor: 'teal',
	            prevText:'Anterior',
	            nextText:'Siguiente',
	            showPrevNext:true,
	            hidePageNumbers:false,
	            perPage:3
	        });
	    });
    </script>

</body>