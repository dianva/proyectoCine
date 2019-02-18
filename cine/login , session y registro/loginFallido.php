<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Login</title>
		<link rel="stylesheet" href="../css/index.css" type="text/css" />
		<link rel="stylesheet" href="../css/basico.css" type="text/css" />
	</head>

	<body>
    <h1>ERROR EN EL INICIO DE SESION</h1>
    <p id="error">Vuelve a intentarlo</p>
		<form method="post" action="comprueba_login.php">
			<div class="formulario">

				<div><label name="nif">NIF</label><input name="nif" type="text" /></div>
				<div><label name="password">PASS</label><input name="password" type="password" /></div>
                <div><input  class="loginRegistro" class="login" type="submit" name="login" value="LOGIN" /></div>
								<div><h3><a class="loginRegistro"  href="passOlvidada.php">¿Contraseña  olvidada?</a></h3>	</div>
							
	
		
</div>
</form>
	</body>
	
</html>
