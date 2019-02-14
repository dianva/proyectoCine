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
<h1>PAGINA DE REGISTRO</h1>
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
			<div calss="datos">
			<input class="loginRegistro" type="submit" name="registro" value="Registrarse" /><br/>
			<input class="loginRegistro" type="submit" name="guardar" value="Guardar datos (dni.txt)"><br/>
		</div>  
		<div>
		<form action="" method="post">
		<label>Registro desde fichero(dni.txt): </label><input type="text" name="fichero" id="">
		<input type="submit" name="cargar" value="OK!">
		</form>
		</div>
           
			<div><h3><a class="loginRegistro"  href="../index.html">Volver al inicio</a></h3></div>
		</form>	
		</div>
	<?php
include("../funciones y objetos/funccionesRegistro.php");
?>
   
</body>
</html>