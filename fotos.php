<?php
// Include the database configuration file


session_start();
if(!isset($_SESSION['session_name']) || (isset($_SESSION['session_name']) && empty($_SESSION['session_name'])))
header("location: login.php");
// Require/Include DB Connection
include 'conexion.php';
$query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");
if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
    session_destroy();
    header("location:login.php");
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   extract($_POST);
   $sql = "INSERT INTO `post_list` (`title`, `author`, `content`) VALUES ('{$conn->real_escape_string($title)}','{$conn->real_escape_string($session_name)}', '{$conn->real_escape_string($content)}')";
   $save= $conn->query($sql);
   if($save){
        echo "<script> alert('Post has been inserted successfully.'); location.replace('index.php'); </script>";
    }else{
        echo "<script> alert('Post has failed to insert. Error: '.$conn->error); location.replace('index.php'); </script>";
    }
    echo "<script> location.replace('index.php'); </script>";
}
if(isset($_GET['post_id'])){
   extract($_GET);
    $get = $conn->query("SELECT * FROM `like_list` where post_id = '{$post_id}' and session_name = '{$_SESSION['session_name']}'");
    if($get->num_rows > 0){
        $sql = "DELETE FROM `like_list` where post_id = '{$post_id}' and session_name = '{$_SESSION['session_name']}' ";
    }else{
        $sql = "INSERT INTO `like_list` set post_id = '{$post_id}', session_name = '{$_SESSION['session_name']}' ";
    }
    $process= $conn->query($sql);
    if($process){
        echo "<script> alert('Post Like has been updated.'); location.replace('index.php'); </script>";
    }else{
        echo "<script> alert('Post Like/Unlike has failed.'); location.replace('index.php'); </script>";
    }
    
}
if(isset($_GET['delete_post'])){
   extract($_GET);
    $sql = "DELETE FROM `post_list` where id = '{$delete_post}'";
    $delete = $conn->query($sql);
    if($delete){
        echo "<script> alert('Post has been deleted successfully.'); location.replace('index.php'); </script>";
    }else{
        echo "<script> alert('Post has failed to delete. Error: '.$conn->error); location.replace('index.php'); </script>";
    }
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
    <title>Vota Tu foto Favorita</title>
    
</head>
<body>
<script>
        start_loader()
</script>

  <div class="text-center p-3 mb-2 text-white header">
    <h1>FotoGuay</h1>
    <form  action="upload.php" method="post" enctype="multipart/form-data">
        <i class="fas fa-cloud-upload-alt" aria-hidden="true"></i>
        <input type="file" id="file" name="file">
        <input type="submit"  name="submit" value="Subir foto">
     </form>
  <div class="container-fluid">
    <div>
       <a href="./?logout=true" class="text-light fw-bolder text-decoration-none"><i class="fa fa-sign-out"></i> <?= $_SESSION['session_name'] ?></a>
    </div>
  </div>
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

  $imageURL = $conn->query("SELECT *,COALESCE((SELECT COUNT(id) FROM like_list where post_id = post_list.id), 0) as `likes` FROM `post_list` order by unix_timestamp(date_created) desc");
            while($row = $imageURL->fetch_assoc()):
                $is_liked = $conn->query("SELECT * FROM `like_list` where post_id = '{$row['id']}' and session_name = '{$_SESSION['session_name']}'")->num_rows;
?>

</div>

<!-- Fancybox JS -->
<script src="@@path/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>