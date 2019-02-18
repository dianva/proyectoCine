<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
   
    <link rel="stylesheet" href="../css/principal.css" type="text/css"/>
    
   
    
    <title>principal</title>
    <style>
    
    </style>
</head>
<body>
<?php
session_start(); //iniciar sesion para el usuario logueado
//añadimos los archivos para incluirlos al programa
include("../funciones y objetos/usuario.php");
include("../funciones y objetos/funciones.php");
include("../funciones y objetos/entrada.php");
include("../funciones y objetos/sala.php");
//creamos un usuario para obtener su nombre en el apartado usuario
$usu=new usuario();
echo '<nav>
<div><a href="./principal.php?menu=verPeli">ver Películas</a></div>
<div><a href="./principal.php?menu=verEntradas">ver Entradas</a></div>
<div><a href="./principal.php?menu=saldo">Recargar saldo</a></div>
<div><a href="./principal.php?menu=modUsu">Usuario :'.$usu->darNombre($_SESSION["usuario"]).'</a></div>
<div><a href="../login , session y registro/cerrar_sesion.php">salir</a></div>
</nav>
';
//si puldamos cualquier opcion del menu entraremos en un switch donde dependiendo de la opcion pulsada realizara una funcion u otra.

if(isset($_REQUEST['menu'])){
   
    switch($_REQUEST['menu']){//al pulsar sobre ver peliculas){
        case "verPeli":
        $salas=new sala();
        if(isset($_REQUEST['numSala'])){//primero comprobaremos si hemos seleccionado un sala
            if(isset($_REQUEST['dia']) || isset($_REQUEST['hora'])){
                if($_REQUEST['dia']=="no" || $_REQUEST['hora']=="no"){
                    mostrarDiaHora();//nos mostrara el formulario con los select de nuevo
                    echo "<h2>Error , selecciona fecha y hora</h2>";
                }else{
                    //si hemos seleccionado una fecha y una hora
                    echo "<h2>seleccione las entradas que quiere comprar </h2>";
                    $entradas=new entrada();//crearemos un objeto entrada
                    //comprobaremos que butacas estan ocupadas
                   $ocupadas= $entradas-> ComprobarEntradasSala($_REQUEST['numSala'] ,$_REQUEST['dia'], $_REQUEST['hora']);
                    //en las salas nos mostrara las butacas libres y ocupadas
                   $salas->verButacas( $_REQUEST['aforo'], $ocupadas, $_REQUEST['numSala'],$_REQUEST['dia'] ,$_REQUEST['hora'] );
                }}else{mostrarDiaHora();} //si no se ha seleccinado un dia ni una hora nos mostrara ambos select
            }else{$salas->verSalas();}//si no hemos seleccionado una sala , nos mostrara todas las salas con peliculas.
    break;
    case "verEntradas"://si seleccionamos ver entradas compradas
            $ent=new entrada();//crearemos un objeto entrada
            $ent->mostrarEntradas($_SESSION["usuario"]);    //y con el parametro dni la funcion nos mostrara todas las enrtradas compradas de ese usuario    
        break;
        case "saldo"://en caso de querer añadir saldo
        if(isset($_REQUEST['saldoMas'])){//comprobamos si hemos añadido el saldo o es la primera vez que entramos
           //si hemos añadido saldo calculara el saldo que teniamos + el saldo añadido
            $saldoadd=$_REQUEST['saldoMas']+$_REQUEST['saldo'];
            echo "<h1 class='saldoTotal'> Saldo total: ".$saldoadd." €</h1>";
            $usu=new usuario();
            $usu->modificarSaldo($_SESSION["usuario"], $saldoadd);//y lo modificaremos en la base de datos gracias a la funcion en cuestión
        }else{//si es la primera vez , crearemos el usuario y mostraremos el formulario con los datos del usuario en cuestion.
            $usu=new usuario();
            $usu->formuAgregarSaldo($_SESSION["usuario"]);//funcion que muestra el formulario del usuario concreto que le pasamos como dni
        }
        break;
        case "modUsu"://si queremos modificar algun dato del usuario
        $usu=new usuario();
        if(isset($_REQUEST['mod'])){
            //si ya hemos modificado los datos , comprobara que el password no esté vacio
            if(!empty($_REQUEST['pass1']) && !empty($_REQUEST['pass2'])){
                if($_REQUEST['pass1']!=$_REQUEST['pass2']){//y que los dos passwords sean iguales
                    //si son diferentes se da un mensaje de error y solo se actualizan los campos que no sean el password
                        echo "<h2>El password tiene que ser el mismo en ambos campos</h2>";
                        echo "<h2>se Actualizarán los demás campos</h2>";
                        $usu-> actualizarUsuSinPass($_SESSION["usuario"], $_REQUEST['nombre'], $_REQUEST['email'] );   
                }else{//si se dan las dos cirscustancias se modfica la infor del usuario con la funcion adecuada
                    echo "<h2>Campos actualizados </h2>";
                    $usu-> actualizarUsu($_SESSION["usuario"], $_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['pass1']);  
                }
            }else{//si no hemos escrito nada en los password se modifican los demas campos
                echo "<h2>Campos actualizados </h2>";
                $usu-> actualizarUsuSinPass($_SESSION["usuario"], $_REQUEST['nombre'], $_REQUEST['email'] );  
            }  
        }else{//si es la primera vez que entramos en esta parte del menu se mostrara el formulario para dmodificar los datos
            $usu->formularioMod($_SESSION["usuario"]);
    
        }

        break;
    }


}

if(isset($_REQUEST['comprarButacas'])){//si queremos comprar alguna butaca
    //crearemos los objetos correspondientes
    $usuario=new usuario();
    $sala=new sala();
    $entrada=new entrada();
    //añadimos el saldo del usuario a una variable
    $saldo=$usuario->darSaldo($_SESSION['usuario']);
    //y las butacas que hemos seleccionado para comprar
    $butacasAcomprar=$_REQUEST['butacas'];
    //tambien el tipo de sala que es(si es vip , normal ....) 
    $tipo=$sala-> saberTipo($_REQUEST['comprarButacas']);
    //calculamos el precio total de las entradas con todos los datos.
       $precioEntradas= $entrada->calcularPrecio($tipo,count($butacasAcomprar));

       //si el saldo del usuario es mayor al precio todal de las entradas , continuamos con la compra

if($saldo>$precioEntradas){
    echo "<h2>¿Esta seguro de comprar las entradas?</h2>";
      //mostramos el resumen de las entradas que se van a comprar
    for ($i=0; $i < count($butacasAcomprar); $i++) { 
        echo "<div class='entradas'>";
        echo "<p>Entrada : ".($i+1)."</p>";
        echo "<p>película: ".$sala->saberNombrePeli($_REQUEST['comprarButacas'])."</p>";
        echo "<p>sala nº : ".$_REQUEST['comprarButacas']."</p>";
        echo "<p>numero  : ".$butacasAcomprar[$i]."</p>";
        echo "<p>dia     : ".$_REQUEST['dia']."</p>";
        echo "<p>hora    : ".$_REQUEST['hora']."</p>";
        echo "</div>";
    }
        //y el precio total de las mismas , asi como el saldo final de la cuenta del usuario
    echo "<div id='totales'><p>TOTAL      : ".$precioEntradas."€</p>";
    echo "<p>SALDO      : ".$saldo."€</p>";
    echo "-----------------------------------------";
    echo "<p>SALDO FINAL: ".($saldo-$precioEntradas)."€</p>";
    echo "</div>";
        //mostramos un boton para confirmar la compra o para cancelarla
   echo' <form action="#" method="post">
<input type="hidden" name="dia"  value="'.$_REQUEST['dia'].'">
<input type="hidden" name="hora" value="'.$_REQUEST['hora'].'">
<input type="hidden" name="butacas" value="'.implode(" ",$butacasAcomprar).'">
<input type="hidden" name="sala" value="'.$_REQUEST['comprarButacas'].'">
<input type="hidden" name="saldoFinal" value="'.($saldo-$precioEntradas).'">
   <p> <button name="confirPagar" value="si" type="submit" >PAGAR</button> <p>
    </form>
    <p><a href="#">VOLVER</a></p>';
}else{//si el saldo es inferior mostramos mensaje
   echo "<h2>No tiene saldo Suficiente</h2>";
echo '<p><a href="./principal.php">VOLVER</a></p>';   
}}

if(isset($_REQUEST['confirPagar'])){//si confirmamos la compra
$entrada=new entrada();
$entradasCompradas=explode(" ", $_REQUEST['butacas']);//creamos un array con tpdas las entradas
for ($i=0; $i < count($entradasCompradas); $i++) { //y lo recorremos llamando a la funcion que compra una a una las entradas.
   $entrada->comprarEntrada($_REQUEST['sala'], $entradasCompradas[$i] ,$_REQUEST['dia'], $_REQUEST['hora'], $_SESSION['usuario'] );
}
$usuario=new usuario();
//modificamos el saldo del usuario para restarle el precio de las entradas
$usuario->modificarSaldo($_SESSION['usuario'], $_REQUEST['saldoFinal']);
//mostramos mensaje
echo "<h2>El pago se realizó correctamente.</h2>";
}

?>

 

</body>
</html>
