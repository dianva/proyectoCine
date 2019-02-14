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
			echo "<h2>Registro OK!</h2>";
			}catch(Exception $e){
				die('Error:'. $e->getMessage());
			}finally{
				$base=null;
			}
	 } else {
		 //mostar errores
		 echo "<h2>Se han cometido $errores errores: </h2>";
		 foreach ($erroresDescripcion as $valor) {
			echo "<h2>- $erroresDescripcion  </h2>";
		}
		
	 }
	}else{
		 // campo obligatorio sin rellenar
		 echo "<h2>Se ha producido un error, rellene de nuevo correctamente todos los campos.</h2>";
	}			
}
/********************/
if(isset($_POST["guardar"])){
	if ( !empty($_POST['nif']) && !empty($_POST['pas']) && !empty($_POST['nombre']) && !empty($_POST['nombre'])) {

		$nif=$_POST["nif"];
		$pas=$_POST["pas"];
		$nombre=$_POST["nombre"];
		$email=$_POST["email"];

		$fichero="ficherosRegistro/$nif.txt";
		$handler=fopen($fichero,"a+");
		$fwriter=fwrite($handler,"$nif $pas $nombre $email");
	}else{
		echo "<h2>Se ha producido un error, rellene de nuevo correctamente todos los campos.</h2>";
	}
}
?>