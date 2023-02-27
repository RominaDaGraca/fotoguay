<?php
//Conectar los votos con las imagenes

if(isset($_POST["action"]))
{
    function Conectarse()
{
    global $host, $puerto, $usuario, $contrasena, $baseDeDatos, $imagenes;

    $link = new mysqli($host,$usuario,$contrasena,$baseDeDatos);
    
    if ($link->connect_error) {
        echo "Error conectando a la base de datos.<br>";
        exit();
    } else {
        echo "Listo, estamos conectados.<br>";
    }

    return $link;
}

$link = Conectarse();

$imagenes=$_POST["imagenes"];
$votos=$_POST["votos"];

$queryInsert = "INSERT INTO $tabla (imagenes,votos) VALUE (?,?)";
$stm=$link->prepare($queryInsert);
$stm->bind_param("sd",$imagenes,$votos);

if ($stm->execute()) {
    header("Location: alta.html");
    exit();
} else {
    echo "No se ingresaron los votos. <br>";
}


}


























?>