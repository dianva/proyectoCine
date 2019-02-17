<?php
//funcion auxiliar que muestra el formulario para seleccionar un dia y una hora
//esta función se hizo a parte con la idea de poder ampliar la funcionalidad y dejar que se pudieran elegir dias y horas reales .
function mostrarDiaHora(){
    echo "<h2>Seleccion Día y Hora</h2>";
    echo "
    <form action='#' method='post'>
    <select name='dia' >
    <option value='no'>Selecciona Dia</option>
    <option value='2019-02-10'>Hoy</option>
    <option value='2019-02-11'>Mañana</option>
    <option value='2019-02-12'>Pasado Mañana</option>
    </select>
    <select name='hora' >
    <option value='no'>Selecciona Pase</option>
    <option value='16:00:00'>16:00</option>
    <option value='19:00:00'>19:00</option>
    <option value='21:00:00'>21:00</option>
    <input type='text' name='idPeli' value='".$_REQUEST['idPeli']."' hidden>
    <input type='text' name='menu' value='verPeli' hidden>
    <button type='submit'>Ver Butacas Disponibles</button>
    </select>";
}

?>


</form>