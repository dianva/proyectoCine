<?php

class usuario{
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

//devuelve el nombre de la persona a la que conrresponde el dni pasado como parametro
public function darNombre($dni){
$consulta="select * from usuario where nif like '$dni' ;";
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    $cont=$resultados->rowCount();
for ($i=0; $i < $cont; $i++) {
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
    return $regto['nombre'];
}
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
}

//devuelve el saldo de la persona que se paso como parametro
public function darSaldo($dni){
    $consulta="select * from usuario where nif like '$dni' ;";
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
    $cont=$resultados->rowCount();
for ($i=0; $i < $cont; $i++) {
    $regto=$resultados->fetch(PDO::FETCH_ASSOC);
    return $regto['saldo'];
}
    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
}

//muestra el formulario para agregar más saldo a una determinada peronsa q ese ha pasado como parametro
public function formuAgregarSaldo($dni){
    $consulta="select * from usuario WHERE nif like '$dni';";
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();
        $regto=$resultados->fetch(PDO::FETCH_ASSOC);
        
echo "<div class='fichaUsuario'>
<p>DNI    : ". $dni."</p>
<p>Nombre : ". $regto['nombre']."</p>
<p>Email  : ". $regto['email']."</p>
<p>Saldo  : ". $regto['saldo']."€</p>
<form action='./principal.php' method='post'>
<h2>Si desea añadir saldo a su cuenta añádalo desde aquí</h2>
<ul>
    <li><input type='number' name='saldoMas'></li>
    <li><input type='hidden' name='saldo' value='".$regto['saldo']."'></li>
    <li><input type='hidden' name='menu' value='saldo'></li>
    <li> <button type='submit'>Añadir Saldo a la cuenta</button></li>
</ul>
</form>
<div>";

    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}


}
//modifica el saldo de la persona pasada como parametro por el saldo que se ha pasado por parametro

public function modificarSaldo($dni, $saldo){
    $consulta="UPDATE usuario SET saldo=$saldo WHERE nif like '$dni';";
    try{
        $resultados=$this->conex->prepare($consulta);
    $resultados->execute();

    }catch(PDOException $e){
        echo "<p>Consulta ejecutada: " .$consulta. "</p>";
        echo "<p class='error'>Descripción del error: " .$e->getMessage(). "</p>";

}
}
}

?>