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
        $this->titulo == $titulo;
        

    }




}

?>