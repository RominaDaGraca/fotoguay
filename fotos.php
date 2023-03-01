<?php
// Include the database configuration file


session_start();

if (!isset($_SESSION['username'])) {
  header("location: login.php");
}

// Require/Include DB Connection
include 'conexion.php';

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
  session_destroy();
  header("location:login.php");
}


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
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <title>Vota Tu foto Favorita</title>

</head>

<body>


  <div class="text-center p-3 mb-2 text-white header">
    <h1>FotoGuay</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
      <input type="file" id="file" name="file">
      <input type="submit" name="submit" value="Subir foto">
    </form>
    <div class="container-fluid">
      <div>
        <a href="./?logout=true" class="text-light fw-bolder text-decoration-none"><i class="fa fa-sign-out"></i> <?= $_SESSION['username'] ?></a>
      </div>
    </div>
  </div>





  <div class="contenedor-galeria">
    <?php
    $consulta="SELECT I.id as idfoto,I.file_name,U.nombre,COUNT(V.id_usuario) as votos FROM `images` as I inner join usuario as U on I.id_usuario=U.id left join votos as V on I.id=V.id_imagen GROUP by V.id_imagen order by votos desc";
    $query = mysqli_query($conn, $consulta);
    if ($query->num_rows > 0) {
      $contenido = "";
      while ($row = $query->fetch_assoc()) {
        $imageURL = 'uploads/' . $row["file_name"];
        $contenido .= "
      <div class='caja-galeria imagenes'>
      <form  action='votar.php' method='post'>
      <input type='hidden' name='id_foto' value=".$row['idfoto'].">
      
      <img src='" . $imageURL . "' alt=''>
            <div class='caja-hover'>
            <span>".$row['votos']."</span>
            <i class='fa-solid fa-heart'></i>
            </div>
        </div></form>";
      }
    } else {
      $contenido = "<p>No hay imagenes...</p>";
    }
    echo $contenido;
    ?>
  </div>

  <!-- Fancybox JS -->
  <script src="@@path/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
      $('.fa-heart').click((e)=>{
       $(e.currentTarget.parentElement.parentElement).submit()
      })

    </script>

</body>

</html>