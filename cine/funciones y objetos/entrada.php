<?php
class entrada{
    private $conex; 
  
    public function __construct() //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
    {
      $dns  ='mysql:host=localhost;dbname=cine;charset=utf8';
      $usuario = 'daw';
        $password = 'galileo';
        try {
          $this->conex = new PDO($dns, $usuario, $password);
          $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch(PDOException $e) {
           printf ("<h3 style='color:red'>Error al conectar la Base de Datos: %s </h3>", $e->getMessage());
       }
    }
  
   public function ComprobarEntradasSala($sala ,$dia, $hora){

    $consulta="select * from  entrada where dia like '$dia' and hora like '$hora' and numSala like '$sala'";
    $butacasOcupadas=Array();
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    $cont=$resultados->rowCount();
        
for ($i=0; $i < $cont; $i++) {
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
    $butacasOcupadas[$i]=   $regto['numButaca']; 
}
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
return $butacasOcupadas;
   }

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

return $precio;

}

public function mostrarEntradas($dni){
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
  