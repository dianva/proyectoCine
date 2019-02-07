<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>principal</title>
</head>
<body>
<?php
session_start(); //iniciar sesion para el usuario logueado
//$_SESSION["usuario"]=$_REQUEST['dni'];//variable super global para el usuario y lo podemos utilizar en cualquier otra pagina del sitio
//$nombreUsu=metodo que devuelve el  nombre de usuario

$_SESSION["usuario"]="123456789A";//dni para probar la sesion
echo '<nav>
<div><a href="./principal.php?menu=verPeli">ver Películas</a></div>
<div><a href="./principal.php?menu=verEntradas">ver Entradas</a></div>
<div><a href="./principal.php?menu=saldo">Recargar saldo</a></div>
<div><a href="./modificar_usu.php">Usuario :'.$_SESSION["usuario"].'</a>
     <a href="./cerrar_sesion.php">salir</a></div>
</nav>
';

if(isset($_REQUEST['menu'])){
    switch($_REQUEST['menu']){
        case "verPeli":
        echo "peliculas";
        break;
        case "verEntradas":
        echo "entrada";
        break;
        case "saldo":
        echo "saldo";
        break;
    }


}

?>

 

</body>
</html>