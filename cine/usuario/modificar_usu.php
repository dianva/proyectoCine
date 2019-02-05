<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>modificar_usu</title>
</head>
<body>
<?php
session_start(); //iniciar sesion para el usuario logueado

datosUsu($_SESSION["usuario"]);


?>
<form action="" method="post">
<p>DNI:  </p>
<p>Nombre: <input type="text" name="nombre" ></p>
<p>@Email: <input type="text" name="Email" ></p>
<p>cambiar</p>
<p></p>
</form>


</body>
</html>