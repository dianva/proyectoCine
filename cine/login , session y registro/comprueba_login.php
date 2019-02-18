    <?php
    try{
        $base=new PDO("mysql:host=localhost; dbname=cine","root","");
        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM USUARIO WHERE nif=:nif AND password=:password"; //consulta
        $resultado=$base->prepare($sql);
        $nif=htmlentities(addslashes($_POST["nif"]));//evitar inyeccion sql
        $password=htmlentities(addslashes($_POST["password"]));//evitar inyeccion sql
        $resultado->bindValue(":nif",$nif);
        $resultado->bindValue(":password",$password);
        $resultado->execute();
        $numero_registro=$resultado->rowCount();
        if($numero_registro!=0){//si el usuario existe
            //deshabilitar el output_buffering
            session_start(); //iniciar sesion para el usuario logueado
            $_SESSION["usuario"]=$_POST["nif"];//variable super global para el usuario y lo podemos utilizar en cualquier otra pagina del sitio
   
            header("Location:../PaginaPrincipal/principal.php"); //redireccionamos a la pagina de bienvenida
        }else{ //si el usuario no existe
            //le hago volver a la pagina de nif
            header("Location:loginFallido.php"); 
        }
    }catch(Exception $e){
        die("Error:". $e->getMessage());
    };
    ?>