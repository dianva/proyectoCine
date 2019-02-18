<?php
class entrada{
    private $conex; 
  
    public function __construct() //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
    {
      $dns  ='mysql:host=localhost;dbname=cine;charset=utf8';
      $usuario = 'root';
        $password = '';
        try {
          $this->conex = new PDO($dns, $usuario, $password);
          $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch(PDOException $e) {
           printf ("<h3 style='color:red'>Error al conectar la Base de Datos: %s </h3>", $e->getMessage());
       }
    }
      //funcion que comprueba las butacas ocupadas de una determianda sala , a una determinada hora y determinado dia.
   public function ComprobarEntradasSala($sala ,$dia, $hora){

    $consulta="select * from  entrada where dia like '$dia' and hora like '$hora' and numSala like '$sala'";
    $butacasOcupadas=Array();
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    $cont=$resultados->rowCount();
        
for ($i=0; $i < $cont; $i++) {//cada butaca ocupada la añadimos al array 
    
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
    $butacasOcupadas[$i]=   $regto['numButaca']; 
}
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}//la funcion devuelve un array con el nº de cada butaca ocupada.

return $butacasOcupadas;
   }
   //funcion que compra una entrada de una sala, hora dia y el cliente que la compra

   public function comprarEntrada($numSala, $numButaca ,$dia, $hora, $dni_cliente ){
    $consulta="INSERT INTO `entrada`(`numButaca`, `dia`, `hora`, `numSala`, `dni_cliente`) VALUES ($numButaca,'$dia', '$hora',$numSala,'$dni_cliente');";

    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
   }
    //funcion para calcular el precio de la entrada dependiendo del tipo de sala que sea, (normal , vip, atmos...)
 
public function calcularPrecio($tipo, $numButacas){
$precio=0;
    switch($tipo){
case "normal":
$precio=5;
break;
case "vip":
$precio=7;
break;
case "atmos":
$precio=6;
break;
case "3d":
$precio=6;
break;
}
$precio=$numButacas*$precio;
// devuelve el precio total.
return $precio;

}

public function mostrarEntradas($dni){//muestra las entradas compradas del usuario pasado como parametro
$consulta="select * from entrada where dni_cliente like '".$dni."' ORDER by dia , hora;";
try{
    $resultados=$this->conex->prepare($consulta);
$resultados->execute();
$cont=$resultados->rowCount();
echo "<div class='entradasUsuario'> 
<h2>Entradas compradas del usuario $dni</h2>";
for ($i=0; $i < $cont; $i++) {
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
   echo "<div class='entrada'><p>Día : ".$regto['dia'] ."</p><p>Hora : ".$regto['hora'] ."</p>
   <p>Num. Sala : ".$regto['numSala'] ."</p><p>Butaca nº : ".$regto['numButaca'] ."</p></div>";
}

echo "</div>";
}catch(PDOException $e){
    echo "<p>Consulta ejecutada: " .$consulta. "</p>";
    echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}


}



  }
  ?>
  