<?php
/* Función para comprobar el NIF */
function comprobarNif($nif) {
	// $mensajeNIF = NULL; 									// valores aceptados: 1, -1 y 0
	$digControl = "TRWAGMYFPDXBNJZSQVHLCKE";
	$expresionReg = '/^[0-9]{7,8}[a-z]{1}$/i';
	if ( preg_match($expresionReg, $nif) ) {
		$letra = strtoupper(substr($nif,-1));
		$num = (int)substr($nif,0,-1);
		$resto = $num%23;
		$pos = strpos($digControl, $letra);
		if ($resto==$pos) {
			$mensajeNIF = NULL; 			// NIF correcto
		} else {
			$mensajeNIF = "¡La letra del NIF no es válida!";
		}
	} else {
		$mensajeNIF = "¡Caracteres requeridos para el NIF no son válidos!"; 
	}
	// } else { $mensajeNIF = "¡La longitud del NIF es incorrecta!";  }
	return $mensajeNIF;
}

/* Función para comprobar el email */
function comprobarEmail($email) {
	$emailIncorrecto = NULL;
	// Un email debe permitir caracteres alfanumericos, algunos caracteres especiales( '-', '_', '.') seguido de una @ y un dominio 
	$expEmail = "/^[a-zA-Z0-9]+([[a-zA-Z0-9\.]+)*@([_a-z0-9\-]+\.)+([a-z])+$/i";
	if ( preg_match($expEmail, $email) ) {
		$emailIncorrecto = NULL; 	
	} else {
		$emailIncorrecto = "¡La dirección de correo no es válida!";
	}
	return $emailIncorrecto;
}

?>