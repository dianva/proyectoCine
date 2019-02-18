<?php

class sala{
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
  // nos devuelve el nombre de la pelicula que se esta proyectando en la sala pasada como parametro

  public function saberNombrePeli($sala){
    $consulta="select p.titulo from sala s inner join pelicula p on s.id_peli=p.idPeli;";
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
    return $regto['titulo'];
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
  }
  //vemos todas las salas en las que actualmente se proyectan peliculas

    public function verSalas(){
        $consulta="select s.aforo, s.numSala, p.titulo,p.duracion, p.imagen, p.idPeli from sala s inner join pelicula p on s.id_peli=p.idPeli";

        try{
            $resultados=$this->conex->prepare($consulta);
        $resultados->execute();
        $cont=$resultados->rowCount();
        echo "<div id='cartelera'>";
    for ($i=0; $i < $cont; $i++) {
        $regto=$resultados->fetch(PDO::FETCH_ASSOC);
        echo "<div class='sala' id='".$regto['titulo']."'>";
            echo "<h2>".$regto['titulo']."</H2>";
            echo "<p>Sala: ".$regto['numSala']."</p>";
            echo "<img src='../".$regto['imagen']."' >";
            echo "<p><a href='./principal.php?numSala=".$regto['numSala']."&menu=verPeli&aforo=".$regto['aforo']."&idPeli=".$regto['idPeli']."'>Comprar entradas</a></p>";
        echo "</div>";
    }
    echo "</div>";
        }catch(PDOException $e){
            echo "<p>Consulta ejecutada: " .$consulta. "</p>";
	        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

    }
    }
        //veremos las butacas libres y ocupadas de la sala en un dia y hora determinado

    public function verButacas($numbutacas, $ocupadas, $sala, $dia, $hora){ 
                 $ocu=false;
                 echo '<form action="./principal.php" method="post">
                <h1>PANTALLA</h1>
                 <table><tr>';
//las butacas se colocaran en una tabla de 10 butacas por fila

                 $fil=0;
        for ($i=0; $i <$numbutacas ; $i++) { 
                foreach ($ocupadas as $key => $value) {
                        if($i == $value){
                            $ocu=true;
                        }
                }   
                if($fil==10){
                    echo '</tr><tr>';
                    $fil=0;
                }
                if($ocu){//dependiendo de si está o no ocupada la butaca mostraremos una u otra opción
                        echo '<td><img src="../Carteles/broja.jpg"></td>';
                    }else{//una butaca en azul y un checbox para pdoer comprarla
                        echo '<td><img src="../Carteles/bazul.jpg"><input type="checkbox"  name="butacas[]" value="'.$i.'"></td>';
                    }    
                   
                    $fil++;                
                $ocu=false;
            }
 echo '</tr></table>
 <input type="hidden" name="dia" value="'.$dia.'">
 <input type="hidden" name="hora" value="'.$hora.'">
 <button type="submit" name="comprarButacas" value="'.$sala.'">Comprar</button>            
 </form>
 <p><a href="./principal.php">VOLVER</a></p>
 ';
}
//nos devuelve el tipo de sala que es la sala pasada como parametro , si es vip , normal , atmos...
public function saberTipo($numSala){
    $consulta="select * from sala where numSala = $numSala;";
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
    return $regto['tipo'];
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
   }

}
?>
