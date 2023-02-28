<?php
// Include the database configuration file
include 'conexion.php';

// Get images from the database
$query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="src/css/fotos.css">
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="@@path/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.css">
    <title>Vota Tu foto Favorita</title>
    
</head>
<body>
  <div class="text-center p-3 mb-2 text-white header">
    <h1>FotoGuay</h1>
    <form  action="upload.php" method="post" enctype="multipart/form-data">
    Sube tu foto: <input type="file" id="file" name="file">
    <input type="submit"  name="submit" value="Subir foto">
</form>
  </div>
   
  <div class="contenedor-galeria">
  <?php
  if($query->num_rows > 0){
    $contenido="";
    while($row = $query->fetch_assoc()){
      $imageURL = 'uploads/'.$row["file_name"];
      $contenido.="
      <div class='caja-galeria imagenes'>
      <img src='".$imageURL."' alt=''>
            <div class='caja-hover'>
            <i class='fa-solid fa-heart'></i>
            </div>
        </div>";
    }
  }else{
    $contenido="<p>No hay imagenes...</p>";
  }
  echo $contenido;
?>
</div>

<!-- Fancybox JS -->
<script src="@@path/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

