<?php
require('conexion.php');

session_start();
if (isset($_SESSION["id"]) && isset($_POST["id_foto"])) {
    $idusuario = $_SESSION["id"];
    $idfoto = $_POST["id_foto"];
 
    $votar = "INSERT INTO votos (id_usuario, id_imagen) VALUE (?,?)";
    $stm = $conn->prepare($votar);
    $stm->bind_param("ii", $idusuario, $idfoto);
    try{
        $stm->execute();
    }catch(Exception $e){
        
    }
   
}
header("Location: fotos.php");
