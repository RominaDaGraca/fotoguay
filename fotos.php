<?php

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
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <title>Vota Tu foto Favorita</title>
</head>

<body>

  <div class="text-center p-3 mb-2 text-white header">
    <h1>FotoGuay</h1>

    <form action="upload.php" method="post" id="subirFotoForm" class="iconos" enctype="multipart/form-data">
      <div class="image-upload">
        <label for="file_input">
          <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
        </label>
        <input type="file" id="file_input" name="file">
      </div>
    </form>

    <div class="container-fluid">
      <div>
        <a href="./?logout=true" class="text-light fw-bolder text-decoration-none"><i class="fa fa-sign-out"></i> <?= $_SESSION['username'] ?></a>
      </div>
    </div>
  </div>

  <div class="contenedor-galeria">
    <?php
    $consulta = "SELECT I.id as idfoto,I.file_name,U.nombre,COUNT(V.id_usuario) as votos FROM `images` as I inner join usuario as U on I.id_usuario=U.id left join votos as V on I.id=V.id_imagen GROUP by I.id order by votos desc";
    $query = mysqli_query($conn, $consulta);
    if ($query->num_rows > 0) {
      $contenido = "";
      while ($row = $query->fetch_assoc()) {
        $imageURL = 'uploads/' . $row["file_name"];
        $contenido .= "
      <div class='caja-galeria imagenes'>
      <form  action='votar.php' method='post'>
      <input type='hidden' name='id_foto' value=" . $row['idfoto'] . ">
      
      <img src='" . $imageURL . "' alt=''>
            <div class='caja-hover'>
            <span>" . $row['votos'] . "</span>
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Previsualización</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <img id="previsualizarImg" src="" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="btnSubirFoto" type="button" class="btn btn-primary">Subir foto</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('.fa-heart').click((e) => {
      $(e.currentTarget.parentElement.parentElement).submit()
    })
    $("#file_input").change((event) => {
      if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("previsualizarImg");
        preview.src = src;
      
      }
      $('#exampleModal').modal({
        show: true
      });
    })

    $("#btnSubirFoto").click(()=>{
      $("#subirFotoForm").submit()
    })
  </script>
</body>
</html>