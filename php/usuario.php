<?php

class Usuario{
    public static $nif;
    public static $password;
    public static $email;
    public static $saldo;

    public static __construct($nif, $password, $email, $saldo){
        $this->db = Conexion::conexion_instancia(); 
        $this->$nif = $nif;
        $this->$password = $password;
        $this->$email = $email;
        $this->$saldo = $saldo;
    }

    public static devolverNombre($nif){
        $sql = "SELECT nombre from usuario where nif like $nif;";

        try{
            $resultados = $conex->prepare($sql);
            $resultados->execute();

            if($resultados->rowCount() > 0){
                $regto = $resultados->fetch(PDO::FETCH_ASSOC);
                foreach($regto as $clave => $valor){
                    if($clave == "nombre"){
                        return $valor;
                    }
                }
            }

        }catch(PDOException $e){
            echo "<p>Consulta ejecutada: " .$consulta. "</p>";
	        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";
        }
    }
}

//probar si funciona y seguir con los metodos

?>