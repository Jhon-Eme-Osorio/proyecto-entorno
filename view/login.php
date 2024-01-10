<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="resources/css/style.css">
  <title>Login</title>
</head>

<body>
  <nav class="navbar navbar-expand-xl navbar-dark bg-black">
    <div class="container-fluid justify-content-center">
      <h3 class="col-lg-6 col-md-12 col-sm-12 col-12 text-center color">Proyecto Entorno Servidor</h3>
    </div>
  </nav>
  <?php

  if ($msg === "Contraseña Incorrecta" || $msg === "Usuario Incorrecto") {
    echo '<div class="alert alert-danger alert-dismissible  role="alert">
        ' . $msg . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }

  ?>
  <section>
    <div class="container mt-5 pt-5">
      <div class="row">
        <div class="col-12 col-sm-7 col-md-6 m-auto">
          <div class="card border-0 shadow">
            <div class="card-body">
              <img src="resources/img/icono-biblioteca.png" width="150px" height="80px" alt=" Icono Biblioteca">
              <h3 style="text-align: center; ">Login</h3>
              <form action="?view=login" method="post">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                  <label for="usuario">Usuario</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" name="contraseña" placeholder="Contraseña" required>
                  <label for="contraseña">Contraseña</label>
                </div>
                <div class="form-check mb-3 mb-md-0">
                  <input class="form-check-input" type="checkbox" value="" name="loginCheck" />
                  <label class="form-check-label" for="loginCheck"> Recordarme</label>
                </div>
                <div class="text-center mt-3">
                  <input class="btn btn-primary" type="submit" value="Iniciar Sesion" name="sesion">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</body>

</html>