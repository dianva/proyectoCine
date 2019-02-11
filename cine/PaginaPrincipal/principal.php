<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>principal</title>
    <style>
    td>img{
        width:50px;
    }
    </style>
</head>
<body>
<?php
session_start(); //iniciar sesion para el usuario logueado

echo '<nav>
<div><a href="./principal.php?menu=verPeli">ver Películas</a></div>
<div><a href="./principal.php?menu=verEntradas">ver Entradas</a></div>
<div><a href="./principal.php?menu=saldo">Recargar saldo</a></div>
<div><a href="./principal.php?menu=modUsu">Usuario :'.$_SESSION["usuario"].'</a>
     <a href="../login , session y registro/cerrar_sesion.php">salir</a></div>
</nav>
';
include("../funciones y objetos/usuario.php");
//include("../funciones y objetos/pelicula.php");
include("../funciones y objetos/funciones.php");
include("../funciones y objetos/entrada.php");
include("../funciones y objetos/sala.php");
//include("../Conexion/conexion.php");
if(isset($_REQUEST['menu'])){
    switch($_REQUEST['menu']){
        case "verPeli":
        $salas=new sala();
        if(isset($_REQUEST['numSala'])){
            if(isset($_REQUEST['dia']) || isset($_REQUEST['hora'])){
                if($_REQUEST['dia']=="no" || $_REQUEST['hora']=="no"){
                    mostrarDiaHora();
                    echo "<h2>Error , selecciona fecha y hora</h2>";
                }else{
                    echo "<h2>seleccione las entradas que quiere comprar </h2>";
                    $entradas=new entrada();
                   $ocupadas= $entradas-> ComprobarEntradasSala($_REQUEST['numSala'] ,$_REQUEST['dia'], $_REQUEST['hora']);
                    $salas->verButacas( $_REQUEST['aforo'], $ocupadas, $_REQUEST['numSala'],$_REQUEST['dia'] ,$_REQUEST['hora'] );
                }}else{mostrarDiaHora();} 
                }else{$salas->verSalas();}
        break;
        case "verEntradas":
            $ent=new entrada();
            $ent->mostrarEntradas($_SESSION["usuario"]);        
        break;
        case "saldo":
        if(isset($_REQUEST['saldoMas'])){
            $saldoadd=$_REQUEST['saldoMas']+$_REQUEST['saldo'];
            echo "saldo total".$saldoadd;
            $usu=new usuario();
            $usu->modificarSaldo($_SESSION["usuario"], $saldoadd);
        }else{
            $usu=new usuario();
            $usu->formuAgregarSaldo($_SESSION["usuario"]);
        }
        break;
        case "modUsu":
        $usu=new usuario();
        if(isset($_REQUEST['mod'])){
            if(!empty($_REQUEST['pass1']) && !empty($_REQUEST['pass2'])){
                if($_REQUEST['pass1']!=$_REQUEST['pass2']){
                        echo "<h2>El password tiene que ser el mismo en ambos campos</h2>";
                        echo "<h2>se Actualizarán los demás campos</h2>";
                        $usu-> actualizarUsuSinPass($_SESSION["usuario"], $_REQUEST['nombre'], $_REQUEST['email'] );   
                }else{
                    echo "<h2>Campos actualizados </h2>";
                    $usu-> actualizarUsu($_SESSION["usuario"], $_REQUEST['nombre'], $_REQUEST['email'], $_REQUEST['pass1']);  
                }
            }else{
                echo "<h2>Campos actualizados </h2>";
                $usu-> actualizarUsuSinPass($_SESSION["usuario"], $_REQUEST['nombre'], $_REQUEST['email'] );  
            }  
        }else{
            $usu->formularioMod($_SESSION["usuario"]);
    
        }

        break;
    }


}


if(isset($_REQUEST['comprarButacas'])){
    $usuario=new usuario();
    $sala=new sala();
    $entrada=new entrada();
    $saldo=$usuario->darSaldo($_SESSION['usuario']);
    $butacasAcomprar=$_REQUEST['butacas'];
    $tipo=$sala-> saberTipo($_REQUEST['comprarButacas']);
       $precioEntradas= $entrada->calcularPrecio($tipo,count($butacasAcomprar));

if($saldo>$precioEntradas){
    echo "<h2>¿Esta seguro de comprar las entradas?</h2>";
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
    echo "<div id='totales'><p>TOTAL      : ".$precioEntradas."€</p>";
    echo "<p>SALDO      : ".$saldo."€</p>";
    echo "-----------------------------------------";
    echo "<p>SALDO FINAL: ".($saldo-$precioEntradas)."€</p>";
    echo "</div>";
   echo' <form action="#" method="post">
<input type="hidden" name="dia"  value="'.$_REQUEST['dia'].'">
<input type="hidden" name="hora" value="'.$_REQUEST['hora'].'">
<input type="hidden" name="butacas" value="'.implode(" ",$butacasAcomprar).'">
<input type="hidden" name="sala" value="'.$_REQUEST['comprarButacas'].'">
<input type="hidden" name="saldoFinal" value="'.($saldo-$precioEntradas).'">
   <p> <button name="confirPagar" value="si" type="submit" >PAGAR</button> <p>
    </form>
    <p><a href="#">VOLVER</a></p>';
}else{
   echo "<h2>No tiene saldo Suficiente</h2>";
echo '<p><a href="./principal.php">VOLVER</a></p>';   
}}

if(isset($_REQUEST['confirPagar'])){
$entrada=new entrada();
$entradasCompradas=explode(" ", $_REQUEST['butacas']);
for ($i=0; $i < count($entradasCompradas); $i++) { 
   $entrada->comprarEntrada($_REQUEST['sala'], $entradasCompradas[$i] ,$_REQUEST['dia'], $_REQUEST['hora'], $_SESSION['usuario'] );
}
$usuario=new usuario();
$usuario->modificarSaldo($_SESSION['usuario'], $_REQUEST['saldoFinal']);
echo "<h2>El pago se realizó correctamente.</h2>";
}

?>

 

</body>
</html>
