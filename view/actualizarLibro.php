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

    <title>Cliente</title>
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
                        <p class="size"><?php echo $key->Usuario; ?></p>
                    <?php endforeach; ?>
                    <a href="" title="Cuenta" class="color"><i class="fa-solid fa-user"></i></a>
                    <a href="" title="Cerrar Sesion" class="color" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"><i class="fa-solid fa-power-off"></i></a>
                    <hr>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cerrar Sesion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <b>¿Estas Seguro?</b><br>
                                    Se Cerrara la Sesion
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Salir</button>
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
                            <li><a href="?view=cliente" class="spaces"><i class="fa-solid fa-user-tie space"></i>Clientes</a>
                            </li>

                            <li><a href="?view=catalogo" class="spaces"><i class="fa-solid fa-book space"></i>Catalogo</a>
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

                                        <b class="aling">Libro</b><br>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            </div>
                                            <div class="modal-body">

                                                <div class="card-body">
                                                    <form action="?view=updateLibro" method="post">
                                                        <div class="form-floating mb-3">
                                                            <input type="hidden" class="form-control" name="Id_libro"
                                                                id="Id_libro"
                                                                value="<?php echo $libro->Id_libro; ?>" required>
                                                                <input type="text" class="form-control"
                                                                name="titulo" id="titulo"
                                                                placeholder="Titulo"
                                                                value="<?php echo $libro->Titulo; ?>" required>
                                                            <label for="titulo">Titulo</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                                    <select class="form-select" name="autor" required>
                                                                        <option disabled selected>Autor</option>
                                                                        <?php foreach ($this->model->listaAutor() as $key): ?>
                                                                            <option value="<?php print($key->Id_autor); ?>">
                                                                                <?php print($key->Nombre); ?>
                                                                                <?php print($key->Apellido); ?>
                                                                            </option>

                                                                        <?php endforeach; ?>
                                                                    </select>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control"
                                                                name="ejemplares" id="ejemplares"
                                                                placeholder="Ejemplares"
                                                                value="<?php echo $libro->Ejemplares; ?>" required>
                                                            <label for="ejemplares">Ejemplares</label>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="?view=libro" class="btn btn-secondary">Cancelar</a>&nbsp;
                                                <button type="submit" class="btn btn-primary"
                                                    name="Guardar-cliente">Guardar</button>
                                                </form>
                                            </div>
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