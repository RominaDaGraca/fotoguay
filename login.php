<?php
if (isset($_POST['submit'])) {
    // Recuperación de los datos del formulario
    $username = $_POST['email'];
    $password = $_POST['password'];
  
    // Consulta para verificar si el usuario y la contraseña coinciden
    $sql = "SELECT * FROM usuario WHERE email='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
  
    // Comprobación del resultado de la consulta
    if (mysqli_num_rows($result) == 1) {
      // Inicio de sesión exitoso
      session_start();
      $_SESSION['email'] = $username;
      header("Location: fotos.php"); // Redirige a la página principal
      exit();
    } else {
      // Inicio de sesión fallido
      echo "Usuario o contraseña incorrectos";
    }
    
  }
  
  // Cierre de la conexión a la base de datos
  //mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/src/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Inicia Sessión</p>

                <form action="fotos.php" method="post" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                  <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="email">Correo</label>
                      <input type="text" id="email" name="email" class="form-control" placeholder="Introduce tu correo" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa-solid fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="password">Contraseña</label>
                      <input type="password" id="password" name="password" class="form-control" placeholder="Introduce tu contraseña" />
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                  </div>

                  <div class="text-center text-lg-start mt-4 pt-2">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Aún no tienes un usuario para votar? <a href="register.php"
                    class="link-danger">Regístrate </a></p>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://fotoguay.leonar.dev/src/img/playa.jpg" class="img-fluid" alt="">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>