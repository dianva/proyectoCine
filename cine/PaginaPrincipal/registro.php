<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" href="" type="text/css" />
</head>
<body>
	<div id="formulario">
		<form method="post" action="#" enctype="multipart/form-data">
			<div>
                <label name= "nif">* DNI</label>
                <input name="nif" type="text" />
	        </div>
			<div>
                <label name= "nombre">* Nombre</label>
                <input name="nombre" type="text" />
	        </div>
			<div>
                <label name= "pas">* Contraseña</label>
                <input name="pas" type="password" />
	        </div>
			     
	        <div>
                <label name= "email">&nbsp;* Email</label>
                <input name="email" type="text" />
	        </div>   
            <div>
				<input type="submit" name="registro" value="Registrarse" />
			</div>
		</form>	
		<h3><a href="../index.php">Volver al inicio</a></h3>
	</div>

	<?php
	if ( isset($_POST['registro']) ) {
		// Si los campos obligatorios han sido cumplimentados
		 if ( !empty($_POST['nif']) && !empty($_POST['pas']) && !empty($_POST['nombre']) && !empty($_POST['nombre'])) {
				$nif=$_POST["nif"];
				$pas=$_POST["pas"];
				$nombre=$_POST["nombre"];
				$email=$_POST["email"];
				try{
				$base=new PDO('mysql:host=localhost;dbname=cine','root','');
				$base-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$base->exec("SET CHARACTER SET UTF8");
				$sql="INSERT INTO usuario (nif, password, nombre, email, saldo) VALUES
				('$nif','$pas','$nombre','$email', 0)";
				$resultado=$base->prepare($sql);
				$resultado->execute();
				echo "Registro insertado";
				}catch(Exception $e){
					die('Error:'. $e->getMessage());
				}finally{
					$base=null;
				}
		 } else {
			 // campo obligatorio sin rellenar
			 echo "<p>Hay campos vacios por rellenar</p>";
		 }			
	}
	/********************/

    ?>
   

    
</body>
</html>