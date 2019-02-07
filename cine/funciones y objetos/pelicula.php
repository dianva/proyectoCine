<?php


include_once('conexion.php');

    /*Función para insertar películas*/

   function insertarPelicula($idpelicula, $titulo, $duracion, $sinopsis, $imagen){

        $stmt = $db->prepare("INSERT INTO pelicula (idPeli, titulo, duracion, imagen, sinopsis) VALUES (:idPeli, :titulo, :duracion, :imagen, :sinopsis)");

        //Bind
        $stmt->bindParam(':idPeli',$idpelicula);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':duracion',$duracion);
        $stmt->bindParam(':sinopsis', $sinopsis);
        $stmt->bindParam(':imagen',$imagen);
        
        $stmt->execute();
    }

   



    /*Función para visualizar las películas*/
    function visualizarPeliculas(){

       try {
       
        $datos = Conexion::conexion_instancia()->query("select titulo, duracion, sinopsis, imagen from pelicula");
        
        $datos->setFetchMode(PDO::FETCH_ASSOC);
        
         echo "<table>";
         
        echo "<thead>";
        echo "<tr>";
            echo "<td>Titulo</td>";
            echo "<td>Duración</td>";
            echo "<td>Sinopsis</td>";
            echo "<td>Cartel de película</td>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        while($fila = $datos->fetch()){
            echo "<tr>";
            foreach ($fila as $indice => $campo) {
                
                echo "<td>".$campo."</td>";             
               
                if($indice == "imagen"){
                    echo "<td><img src='".$campo."'/></td>";
                }
               
            }
             echo "</tr>";
        }
        echo "</tbody><table>";

        
    }catch(PDOException $e){
        echo 'Error conectando con la base de datos: ' . $e->getMessage();
    }
 
}


echo visualizarPeliculas();


?>

