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
<h1>RECUPERAR CONTRASEÑA</h1>
		<form method="post" action="" enctype="multipart/form-data">
		<div class="registro">
	        <div>
                <label>&nbsp;* DNI</label>
				<input name="dni" type="text" />
				
			</div> 
            <div>	<input class="loginRegistro" type="submit" name="recordarPass" value="Recordar contraseña" /><br/></div>  
            <div><h3><a class="loginRegistro"  href="../index.html">Volver al inicio</a></h3></div>
		</form>
</div> 
	<?php
include("../funciones y objetos/usuario.php");

if(isset($_POST["recordarPass"])){
    $dni=$_POST["dni"];
    $usuario=new usuario();
    $usuario->recordarPass($dni);
    }
?>
   
</body>
</html>