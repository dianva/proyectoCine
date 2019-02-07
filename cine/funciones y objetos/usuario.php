<?php

 /*función en la que pasas el dni y te devuelve el nombre*/
    function devolverNombre($nif){
        $conex = ConexionPDO::conexion_instancia();
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
            echo "<p>Consulta ejecutada: " .$sql. "</p>";
	        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";
        }
    }

    /*función para dar de alta un usuario*/ 
    function altaUsuario($nif, $nombre, $email, $password, $saldo){
        $conex = ConexionPDO::conexion_instancia();
        $sql = "INSERT INTO usuario (nif, nombre, email, password, saldo)
                VALUES ($nif, $nombre, $email, $password, $saldo);";
        
        try{
            $resultados = $conex->prepare($sql);
            $resultados->execute(); 

        }catch(PDOException $e){
            echo "<p>Consulta ejecutada: " .$sql. "</p>";
	        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

    }

    /*función para dar de baja un usuario*/ 
    function bajaUsuario($nif){
        $conex = ConexionPDO::conexion_instancia();
        $sql = "DELETE FROM entrada WHERE dni_cliente LIKE $nif;";
        $sql2 = "DELETE FROM usuario WHERE nif LIKE $nif;";

        try{
            $resultados = $conex->prepare($sql);
            $resultados->execute(); 
            if($resultado){
                $resultados = $conex->prepare($sql2);
                $resultados->execute(); 
            }

        }catch(PDOException $e){
            echo "<p>Consulta ejecutada: " .$sql. "</p>";
            echo "<p>Consulta ejecutada: " .$sql2. "</p>";
	        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";
        }
        
    }
    

    /*Función para ver los datos del usuario*/
    function verUsuario($nif){
        $conex = ConexionPDO::conexion_instancia();
        $sql = "SELECT nif, nombre, email, password, saldo FROM usuario WHERE nif LIKE $nif;";
        try{
            $resultados = $conex->prepare($sql);
            $resultados->execute();

            if($resultados->rowCount() > 0){
                $regto = $resultados->fetch(PDO::FETCH_ASSOC);
                return $regto;
            }    
        }catch(PDOException $e){
            echo "<p>Consulta ejecutada: " .$sql. "</p>";
	        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";
        }
    }
    /*función para modificar datos de  un usuario*/ 
    /*función para rellenar el saldo */
    /*función para comprar entradas */






?>