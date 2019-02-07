<?php
function listaEntradas($dni){
    try{
        
    }catch(){}
    $db= Conexion::conexion_instancia();
    $consulta="select * from entrada where dni_cliente like".$dni;
    






}


?>