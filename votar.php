<?php
require('conexion.php');

$sql=( 'SELECT * FROM images WHERE id='.$_POST);

$votar="INSERT INTO votos (id_usuario, id_imagen) VALUE (?,?)";




?>