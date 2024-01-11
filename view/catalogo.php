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
    <link rel="stylesheet" href="resources/css/table.css">

    <title>Catalogo</title>
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-black">
        <div class="container-fluid justify-content-center">
            <h3 class="col-lg-6 col-md-12 col-sm-12 col-12 text-center color">Proyecto Entorno Servidor</h3>
        </div>
    </nav>
    <section>
        <div class="margen">
            <div class="row">
                <div class="col-4 linea-vertical">
                    <p class="size">Biblioteca</p>
                    <hr>
                    <img src="resources/img/ad.png" alt="" class="admin">
                    <?php foreach ($this->model->nombreUsuario() as $key): ?>
                        <p class="size">
                            <?php echo $key->Usuario; ?>
                        </p>
                    <?php endforeach; ?>
                    <a href="" title="Cuenta" class="color" data-bs-toggle="modal" data-bs-target="#Modal-cuenta"><i
                            class="fa-solid fa-user"></i></a>
                    <a href="" title="Cerrar Sesion" class="color" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="fa-solid fa-power-off"></i></a>
                    <hr>
                    <!-- Modal de Sesion -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cerrar Sesion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="?view=cerrarLogin" method="post">
                                    <div class="modal-body">
                                        <b>¿Estas Seguro?</b><br>
                                        Se Cerrara la Sesion
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Si</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Modal de Cuenta -->

                    <div class="modal fade" id="Modal-cuenta" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Contraseña</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="card-body">
                                        <form action="?view=guardarContraseña" method="post">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="contraseña-actual"
                                                    id="contraseña-actual" placeholder="Contraseña Actual" required>
                                                <label for="contraseña-actual">Contraseña Actual</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="nueva-contraseña"
                                                    id="nueva-contraseña" placeholder="Nueva Contraseña" required>
                                                <label for="nueva-contraseña">Nueva Contraseña</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="confirmar-contraseña"
                                                    id="confirmar-contraseña" placeholder="Confirmar Contraseña"
                                                    required>
                                                <label for="confirmar-contraseña">Confirmar Contraseña</label>
                                            </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary"
                                        name="Guardar-contraseña">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav>
                        <ul>
                            <li><a href="?view=index" class="spaces"><i class="fa-solid fa-house top"></i>Dashboard</a>
                            </li>
                            <li><a href="#" class="spaces"><i class="fa-solid fa-briefcase space"></i>Administracion<i
                                        class="fa-solid fa-caret-down space"></i></a>
                                <ul>
                                    <li><a href="?view=autor" class="aling">Autor</a></li>
                                    <li><a href="?view=categoria" class="aling">Categoria</a></li>
                                    <li><a href="?view=editorial" class="aling">Editorial</a></li>
                                    <li><a href="?view=libro" class="aling">Nuevo Libro</a></li>
                                    <li><a href="?view=prestamo" class="aling">Prestamo</a></li>
                                </ul>
                            </li>
                            <li><a href="?view=cliente" class="spaces"><i
                                        class="fa-solid fa-user-tie space"></i>Clientes</a>
                            </li>

                            <li><a href="?view=catalogo" class="spaces"><i
                                        class="fa-solid fa-book space"></i>Catalogo</a>
                            </li>
                        </ul>
                    </nav>


                </div>
                <div class="col-9 custom-card-body">
                    <div class="container mt-1">
                        <div class="row">
                            <div class="col m-auto">
                                <div class="card border-0 shadow">
                                    <div class="card-body">

                                        <b class="aling">Libros</b><br>
                                        <form action="?view=idLibroCategoria" method="post">
                                            <div class="form-floating mb-3">
                                                <!--obtengo el id de la categoria y lo guardo en $msg -->
                                                <?php
                                                if (isset($_GET["msg"])) {
                                                    
                                                    $msg = $_GET["msg"];
                                                }else
                                                    if (isset($_SESSION["idCategoria"])) {
                                                    $msg = $_SESSION["idCategoria"];
                                                }?>
                                                <!--aqui en el select obtengo todas las categorias y las muestro para que se puede filtar por categoria -->
                                                <select class="form-select-sm" name="categoria" required>
                                                    <option disabled selected>Categorias</option>

                                                    <?php foreach ($this->model->listaCategoria() as $key):
                                                        if ($msg == $key->Id_categoria) {
                                                            $nombre = $key->Nombre;
                                                        }
                                                        ?>
                                                        <option value="<?php print($key->Id_categoria); ?>">
                                                            <?php print($key->Nombre); ?>
                                                        </option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="btn btn-primary"
                                                    name="buscar">Mostrar</button>
                                            </div>
                                        </form>

                                        <div class="table-wrapper">
                                            <!--Muestro el Nombre de la Categoria por la cual se esta filtrando la vista de libros -->
                                            <b class="aling">
                                                <?php if (isset($nombre)) {
                                                    echo $nombre;
                                                } else {
                                                    echo $nombre = "Todos";
                                                } ?>
                                            </b><br>
                                            <table class="table table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th>TITULO</th>
                                                        <th>AUTOR</th>
                                                        <th>DISPONIBILIDAD</th>
                                                        <th>EJEMPLARES</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if (isset($_SESSION['librosPorCategoria'])) {
                                                    $libros = $_SESSION['librosPorCategoria'];
                                                    foreach ($libros as $key): ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $key->Titulo; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $key->Nombre; ?>
                                                                <?php echo $key->Apellido; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $key->Disponibilidad; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $key->Ejemplares; ?>
                                                            </td>

                                                        </tr>
                                                    <?php endforeach;
                                                } else{?>
                                                <!--Muestro por defecto  todos los libros que hay cuando ingresa a la vista y
                                                 el no se a filtrado por ninguna categoria -->
                                                <?php foreach ($this->model->catalogo() as $key): ?>
                                                    <tr>
                                                    <td>
                                                                <?php echo $key->Titulo; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $key->Nombre; ?>
                                                                <?php echo $key->Apellido; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $key->Disponibilidad; ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $key->Ejemplares; ?>
                                                            </td>

                                                    </tr>
                                                <?php endforeach;} ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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