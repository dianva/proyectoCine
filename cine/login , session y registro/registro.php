<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro</title>
	<link rel="stylesheet" href="" type="text/css" />
	<link rel="stylesheet" href="../css/basico.css" type="text/css" />
	<link rel="stylesheet" href="../css/registro.css" type="text/css" />
</head>
<body>

		<form method="post" action="#" enctype="multipart/form-data">
		<div class="registro">
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
				<input class="loginRegistro" type="submit" name="registro" value="Registrarse" />
			</div>
			
		</form>	
		<div><h3><a class="loginRegistro"  href="../index.html">Volver al inicio</a></h3></div>
		</div>

	<?php
	if ( isset($_POST['registro']) ) {
		$errores=0;
		$erroresDescripcion=[];
		$dni=$_POST["nif"];

		//funcciones para validar pendiente

	
		// Si los campos obligatorios han sido cumplimentados
		
		 if ( !empty($_POST['nif']) && !empty($_POST['pas']) && !empty($_POST['nombre']) && !empty($_POST['nombre'])) {
			if($errores==0){
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
			 //mostar errores
			 echo "<p>Se han cometido $errores errores: </p>";
			 foreach ($erroresDescripcion as $valor) {
				echo "<p>- $erroresDescripcion  </p>";
			}
			
		 }
		}else{
			 // campo obligatorio sin rellenar
			 echo "<p>Hay campos vacios por rellenar</p>";
		}			
	}
	/********************/

    ?>
   

    
</body>
</html>