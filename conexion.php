<?php
  $host_name = 'localhost';
  $database = 'fotoguay';
  $user_name = 'root';
  $password = '';

  $conn = new mysqli($host_name, $user_name, $password, $database);

  if ($conn->connect_error) {
    die('<p>Error al conectar con servidor MySQL: '. $conn->connect_error .'</p>');
  }
?>