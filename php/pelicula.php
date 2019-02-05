<?php

class Pelicula{

    private $db;				// instancia a la conexión

	public function __construct() {
		$this->db = Conexion::conexion_instancia();
	}
	
	public function __destruct() {
		echo "<p style='color:#DEDEDE'>Objeto destruido</p>";
	}

    private $idPelicula;
    private $titulo;
    private $duracion;
    private $sinopsis;
    private $imagen;

    public function __construct($idPelicula, $titulo, $duracion, $sinopsis, $imagen){
        $this->db = Conexion::conexion_instancia(); /*Para crear conexion cada vez que se cree un objeto*/

        $this->idPelicula = $idPelicula;
        $this->titulo = $titulo;
        $this->duracion = $duracion;
        $this->sinopsis = $sinopsis;
        $this->imagen = $imagen; 
       
    }

    //Getters

    public function getidPelicula(){
        return $this->idPelicula;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getDuracion(){
        return $this->duracion;
    }
    public function getSinopsis(){
        return $this->sinopsis;
    }
    public function getImagen(){
        return $this->imagen;
    }


    /*Función para insertar películas*/

    public function insertarPelicula($idpelicula, $titulo, $duracion, $sinopsis, $imagen){

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
    public static function visualizarPeliculas(){
        $stmt = $db->prepare("select `titulo`, `duracion`, `sinopsis`, `imagen` from pelicula;");
        // Especificamos el fetch mode antes de llamar a fetch()
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //Ejecutamos
        $stmt->execute();

        /*array con todos los valores*/
        return $stmt->fetch();

        
    }
 
}

?>

