<?php

class usuario
{
    private $conex;

    public function __construct() //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
    {
        $dns = 'mysql:host=localhost;dbname=cine;charset=utf8';
        $usuario = 'daw';
        $password = 'galileo';
        try {
            $this->conex = new PDO($dns, $usuario, $password);
            $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            printf("<h3 style='color:red'>Error al conectar la Base de Datos: %s </h3>", $e->getMessage());
        }
    }

    public function formularioMod($dni)
    {

        $consulta = "select * from usuario where nif like '$dni' ;";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();
            $regto = $resultados->fetch(PDO::FETCH_ASSOC);

            echo "<div class='fichaUsuario'>
<form action='./principal.php' method='post'>
<ul>
<fieldset>
    <legend>DNI    : ". $dni."</legend>
    <li>Nombre :</li> 
    <li><input type='text' name='nombre' value='". $regto['nombre']."'></li>
    <li>Email  : </li>
    <li><input type='text' name='email' value='". $regto['email']."'></li>
    <li>Saldo  : ". $regto['saldo']."€</li>
    <li>Nuevo Password :</li> 
    <li><input type='text' name='pass1' value=''></li>
    <li>repite Password :</li> 
    <input type='text' name='pass2' value=''></li>
        <input type='hidden' name='menu' value='modUsu'>
        <input type='hidden' name='mod' value='si'>
        <li><button type='submit'>Modificar usuario</button></li>
</fieldset>
</ul>
</form>
<div>";

        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }

    }

    public function darNombre($dni)
    {
        $consulta = "select * from usuario where nif like '$dni' ;";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();
            $cont = $resultados->rowCount();
            for ($i = 0; $i < $cont; $i++) {
                $regto = $resultados->fetch(PDO::FETCH_ASSOC);
                return $regto['nombre'];
            }
        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }
    }

    public function darSaldo($dni)
    {
        $consulta = "select * from usuario where nif like '$dni' ;";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();
            $cont = $resultados->rowCount();
            for ($i = 0; $i < $cont; $i++) {
                $regto = $resultados->fetch(PDO::FETCH_ASSOC);
                return $regto['saldo'];
            }
        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }
    }
    public function formuAgregarSaldo($dni)
    {
        $consulta = "select * from usuario WHERE nif like '$dni';";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();
            $regto = $resultados->fetch(PDO::FETCH_ASSOC);

            echo "<div class='fichaUsuario'>
<p>DNI    : " . $dni . "</p>
<p>Nombre : " . $regto['nombre'] . "</p>
<p>Email  : " . $regto['email'] . "</p>
<p>Saldo  : " . $regto['saldo'] . "€</p>
<form action='./principal.php' method='post'>
<h2>Si desea añadir saldo a su cuenta añádalo desde aquí</h2>
    <p><input type='number' name='saldoMas'></p>
    <input type='hidden' name='saldo' value='" . $regto['saldo'] . "'>
    <input type='hidden' name='menu' value='saldo'>
    <button type='submit'>Añadir Saldo a la cuenta</button>
</form>
<div>";

        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }


    }
    public function modificarSaldo($dni, $saldo)
    {
        $consulta = "UPDATE usuario SET saldo=$saldo WHERE nif like '$dni';";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();

        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }
    }

    public function actualizarUsu($dni, $nombre, $email, $pass)
    {
        $consulta = "UPDATE usuario SET nombre='$nombre', email='$email', password='$pass' WHERE nif like '$dni';";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();

        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }

    }
    public function actualizarUsuSinPass($dni, $nombre, $email)
    {
        $consulta = "UPDATE usuario SET nombre='$nombre', email='$email' WHERE nif like '$dni';";
        try {
            $resultados = $this->conex->prepare($consulta);
            $resultados->execute();

        } catch (PDOException $e) {
            echo "<p>Consulta ejecutada: " . $consulta . "</p>";
            echo "<p class='error'>Descripción del error: " . $e->getMessage() . "</p>";

        }
    }

    public function recordarPass($dni)
    {
    
            $consulta = "SELECT password FROM usuario WHERE nif like '$dni';";
            try {
                $resultados = $this->conex->prepare($consulta);
                $resultados->execute();
        while ($pass = $resultados->fetch()) {
            echo "<div><p>" . $pass['password']. "</p></div>";
        }
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
    }

}


?>