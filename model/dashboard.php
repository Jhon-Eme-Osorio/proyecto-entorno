<?php
include_once "model/datosAutor.php";
include_once "model/datosCategoria.php";
include_once "model/datosEditorial.php";
include_once "model/datosCliente.php";
include_once "model/datosAdmin.php";
include_once "model/datosPrestamo.php";
include_once "model/datosLibro.php";
class dashboard
{
    //creo una variable que usare para conexion de la base
    public $conect;

    public $disponible = 0;
    //creo constructor para la conexion
    public function __construct()
    {
        try {
            //uso la variable y guardo en ella, llamdando directamente la clase conexion  y de ahi la funcion conectar
            $this->conect = conexion::conectar();

        } catch (PDOException $e) {
            die("Error " . $e->getMessage());
        }
    }

    //creo una funcion para cada una de las tarjetas que hay en el dashboard
    //y obtener el total de registros 
    public function dashboardCliente()
    {
        try {
            $query = "SELECT * FROM `cliente`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function dashboardCategorias()
    {
        try {
            $query = "SELECT * FROM `categoria` WHERE Id_categoria <> 1";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function dashboardLibros()
    {
        try {
            $query = "SELECT SUM(Ejemplares + Ejemplar_prestado) AS total_libros FROM `libro`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            return $result->total_libros;

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function dashboardPrestamos()
    {
        try {
            $query = "SELECT * FROM `prestamo`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function nombreUsuario(){
        try {
            $query = "SELECT * FROM `administrador`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function sesion(admin $login)
    {

        session_start();
        // Verificar que la contraseña actual coincide
        $query = "SELECT `Contraseña`, `Id_administrador` FROM `administrador`";
        $stmt = $this->conect->prepare($query);
        $stmt->execute();
        $consult = $stmt->fetch(PDO::FETCH_ASSOC);

        $passw = $consult['Contraseña'];
        $remember = $login->getRemember();


        $query = "SELECT Id_administrador, Usuario, Contraseña FROM `administrador` WHERE Usuario = ? AND Contraseña = ? ";
        $stmt = $this->conect->prepare($query);
        $stmt->execute(
            array(
                $login->getUsuario(),
                $passw
            )
        );
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result !== false) {

            if (count($result) > 0 && password_verify($login->getContraseña(), $passw)) {
                //aqui creo una sesion para el administrador
                $_SESSION["user-id"] = $result["Id_administrador"];
                if (isset($remember)) {
                    //se crea una cookie para mantener la sesion iniciada por un tiempo en este caso una hora 
                    //aunque se cierre el navegador
                    setcookie("usuario", $_SESSION["user-id"], time() + 360, "/");
                }

            } else {
                $_SESSION["msg"] = "Contraseña Incorrecta";
                header("Location: ?view=index");
                exit();
            }

        } else {
            $_SESSION["msg"] = "Usuario Incorrecto";
            header("Location: ?view=index");
            exit();
        }
    }

    //cierro la session
    public function cerrarSesion()
    {
        session_start();
        session_unset();
        session_destroy();
        setcookie("usuario", $_SESSION["user-id"], time() - 1, "/");
        header("Location: ?view=index");
    }



    //Actualizar la Contraseña del Admin
    public function actualizarContraseña(admin $dashboard)
    {
        try {
            // Verificar que la contraseña actual coincide
            $query = "SELECT `Contraseña`, `Id_administrador` FROM `administrador`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $passw = $result['Contraseña'];

            if ($result !== false && password_verify($dashboard->getContraseña(), $passw)) {

                // Actualizar la contraseña
                $query = "UPDATE `administrador` SET `Contraseña` = ? WHERE Id_administrador = ?";
                $stmt = $this->conect->prepare($query);
                $stmt->execute([
                    password_hash($dashboard->getNuevaContraseña(), PASSWORD_BCRYPT),
                    $result['Id_administrador']
                ]);
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }





    //esta funcion es para obtener los autores registrados
    public function listaAutor()
    {
        try {
            $query = "SELECT * FROM `autor`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function registrarAutor(autor $dashboard)
    {
        try {
            $longitud = 15;
            //aqui valido que nombre o apellido no superen los 15 caracteres
            if (strlen($dashboard->getNombre()) <= $longitud) {
                if (strlen($dashboard->getApellido()) <= $longitud) {
                    $query = "INSERT INTO `autor` (`Nombre`, `Apellido`, `Fecha_nacimiento`) VALUES (?, ?, ?);";
                    $this->conect->prepare($query)->execute(
                        array(
                            $dashboard->getNombre(),
                            $dashboard->getApellido(),
                            $dashboard->getFechaNacimiento(),
                        )
                    );
                    header("Location: ?view=autor");
                    exit();
                } else {
                    header("Location: ?view=autor&msg=El apellido no puede ser demasiado largo");
                    exit();
                }
            } else {
                header("Location: ?view=autor&msg=El nombre no puede ser demasiado largo");
                exit();
            }


        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function eliminarAutor($id)
    {
        try {
            $query = "DELETE FROM `autor` WHERE Id_autor = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function id_Autor($id)
    {
        try {
            $query = "SELECT * FROM `autor` WHERE Id_autor = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function actualizarAutor($dashboard)
    {
        try {
            $longitud = 15;
            if (strlen($dashboard->getNombre()) <= $longitud) {
                if (strlen($dashboard->getApellido()) <= $longitud) {
                    $query = "UPDATE `autor` SET `Nombre`=?,`Apellido`=?,`Fecha_nacimiento`=? WHERE  Id_autor = ?";
                    $this->conect->prepare($query)->execute(
                        array(
                            $dashboard->getNombre(),
                            $dashboard->getApellido(),
                            $dashboard->getFechaNacimiento(),
                            $dashboard->getId()
                        )
                    );

                } else {
                    header("Location: ?view=autor&msg=El apellido no puede actualizarse es demasiado largo");
                    exit();
                }
            } else {
                header("Location: ?view=autor&msg=El nombre no puede actualizarse es demasiado largo");
                exit();
            }

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    //esta funcion es para obtener las categorias registradas y pasarlas al select de catalogo
    public function listaCategoria()
    {
        try {
            $query = "SELECT * FROM `categoria`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    //esta funcion es para obtener las categorias registradas
    public function listaCategorias()
    {
        try {
            $query = "SELECT * FROM `categoria` WHERE Id_categoria <> 1";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function registrarCategoria(categoria $dashboard)
    {
        try {
            $longitud = 25;
            //aqui valido que nombre  no supere los 25 caracteres
            if (strlen($dashboard->getNombre()) <= $longitud) {
                $query = "INSERT INTO `categoria` (`Nombre`, `Descripcion`) VALUES (?, ?);";
                $this->conect->prepare($query)->execute(
                    array(
                        $dashboard->getNombre(),
                        $dashboard->getDescripcion(),
                    )
                );
            } else {
                header("Location: ?view=categoria&msg=El nombre no puede ser demasiado largo");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function eliminarCategoria($id)
    {
        try {
            $query = "DELETE FROM `categoria` WHERE Id_categoria = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function id_categoria($id)
    {
        try {
            $query = "SELECT * FROM `categoria` WHERE Id_categoria = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function actualizarCategoria($dashboard)
    {
        try {
            $longitud = 25;
            //aqui valido que nombre  no supere los 25 caracteres
            if (strlen($dashboard->getNombre()) <= $longitud) {
                $query = "UPDATE `categoria` SET `Nombre`=?,`Descripcion`=? WHERE  Id_categoria = ?";
                $this->conect->prepare($query)->execute(
                    array(
                        $dashboard->getNombre(),
                        $dashboard->getDescripcion(),
                        $dashboard->getId()
                    )
                );

            } else {
                header("Location: ?view=categoria&msg=El nombre no puede actualizarse es demasiado largo");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    //esta funcion es para obtener las editoriales registradas
    public function listaEditorial()
    {
        try {
            $query = "SELECT * FROM `editorial`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function registrarEditorial(editorial $dashboard)
    {
        try {
            $longitud = 20;
            $longitudTelefono = 10;
            //aqui valido que nombre  no supere los 20 caracteres
            if (strlen($dashboard->getNombre()) <= $longitud) {
                if (strlen($dashboard->getTelefono()) <= $longitudTelefono) {
                    $query = "INSERT INTO `editorial` (`Nombre`, `Telefono`) VALUES (?, ?);";
                    $this->conect->prepare($query)->execute(
                        array(
                            $dashboard->getNombre(),
                            $dashboard->getTelefono(),
                        )
                    );
                } else {
                    header("Location: ?view=editorial&msg=El Telefono no debe ser mayor a 9 digitos");
                    exit();
                }
            } else {
                header("Location: ?view=editorial&msg=El nombre no puede ser demasiado largo");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function eliminarEditorial($id)
    {
        try {
            $query = "DELETE FROM `editorial` WHERE Id_editorial = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function id_editorial($id)
    {
        try {
            $query = "SELECT * FROM `editorial` WHERE Id_editorial = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function actualizarEditorial($dashboard)
    {
        try {
            $longitud = 20;
            $longitudTelefono = 10;
            //aqui valido que nombre  no supere los 20 caracteres
            if (strlen($dashboard->getNombre()) <= $longitud) {
                if (strlen($dashboard->getTelefono()) <= $longitudTelefono) {
                    $query = "UPDATE `editorial` SET `Nombre`=?,`Telefono`=? WHERE  Id_editorial = ?";
                    $this->conect->prepare($query)->execute(
                        array(
                            $dashboard->getNombre(),
                            $dashboard->getTelefono(),
                            $dashboard->getId()
                        )
                    );

                } else {
                    header("Location: ?view=editorial&msg=El Telefono no debe ser mayor a 9 digitos");
                    exit();
                }

            } else {
                header("Location: ?view=editorial&msg=El nombre no puede actualizarse es demasiado largo");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }


    //esta funcion es para obtener los clientes registrados
    public function listaCliente()
    {
        try {
            $query = "SELECT * FROM `cliente`";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function duplicadoCliente($nombre, $apellido)
    {
        try {
            $query = "SELECT * FROM `cliente` WHERE Nombre = ? AND Apellido = ? ";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($nombre, $apellido));
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function registrarCliente(cliente $dashboard)
    {
        try {
            $longitud = 15;
            $longitudDireccion = 30;
            $longitudTelefono = 10;
            $correo = "/^(.+)@(gmail\.com|hotmail\.com)$/";
            //aqui valido que los datos antes del registro en la tabla cliente
            if (strlen($dashboard->getNombre()) <= $longitud) {
                if (strlen($dashboard->getApellido()) <= $longitud) {
                    if (strlen($dashboard->getDireccion()) <= $longitudDireccion) {
                        if (strlen($dashboard->getTelefono()) <= $longitudTelefono) {
                            if (preg_match($correo, $dashboard->getCorreo())) {
                                $query = "INSERT INTO `cliente`(`Nombre`, `Apellido`, `Direccion`, `Telefono`, `Correo`) VALUES (?, ?, ?, ?, ?);";
                                $this->conect->prepare($query)->execute(
                                    array(
                                        $dashboard->getNombre(),
                                        $dashboard->getApellido(),
                                        $dashboard->getDireccion(),
                                        $dashboard->getTelefono(),
                                        $dashboard->getCorreo(),
                                    )
                                );
                            } else {
                                header("Location: ?view=cliente&msg=Formato de correo no valido, Solo se permite correos de gmail o hotmail");
                                exit();
                            }
                        } else {
                            header("Location: ?view=cliente&msg=El Telefono no debe ser mayor a 9 digitos");
                            exit();
                        }
                    } else {
                        header("Location: ?view=cliente&msg=La direccion no puede ser demasiada larga");
                        exit();
                    }

                } else {
                    header("Location: ?view=cliente&msg=El Apellido no puede ser demasiado largo");
                    exit();
                }
            } else {
                header("Location: ?view=cliente&msg=El nombre no puede ser demasiado largo");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function eliminarCliente($id)
    {
        try {
            $query = "DELETE FROM `cliente` WHERE Id_cliente = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function id_cliente($id)
    {
        try {
            $query = "SELECT * FROM `cliente` WHERE Id_cliente = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function actualizarCliente($dashboard)
    {
        try {
            $longitud = 15;
            $longitudDireccion = 30;
            $longitudTelefono = 10;
            $correo = "/^(.+)@(gmail\.com|hotmail\.com)$/";
            //aqui valido que los datos antes de actualizar el registro en la tabla cliente
            if (strlen($dashboard->getNombre()) <= $longitud) {
                if (strlen($dashboard->getApellido()) <= $longitud) {
                    if (strlen($dashboard->getDireccion()) <= $longitudDireccion) {
                        if (strlen($dashboard->getTelefono()) <= $longitudTelefono) {
                            if (preg_match($correo, $dashboard->getCorreo())) {
                                $query = "UPDATE `cliente` SET `Nombre`= ?,`Apellido`= ?,`Direccion`= ?,`Telefono`= ?,`Correo`= ? 
                        WHERE  Id_cliente = ?";
                                $this->conect->prepare($query)->execute(
                                    array(
                                        $dashboard->getNombre(),
                                        $dashboard->getApellido(),
                                        $dashboard->getDireccion(),
                                        $dashboard->getTelefono(),
                                        $dashboard->getCorreo(),
                                        $dashboard->getId()
                                    )
                                );
                            } else {
                                header("Location: ?view=cliente&msg=Formato de correo no valido, Solo se permite correos de gmail o hotmail");
                                exit();
                            }

                        } else {
                            header("Location: ?view=cliente&msg=El Telefono no debe ser mayor a 9 digitos");
                            exit();
                        }
                    } else {
                        header("Location: ?view=cliente&msg=La direccion no puede ser demasiada larga");
                        exit();
                    }
                } else {
                    header("Location: ?view=cliente&msg=El Apellido no puede ser demasiado largo");
                    exit();
                }
            } else {
                header("Location: ?view=cliente&msg=El nombre no puede ser demasiado largo");
                exit();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    //esta funcion es para obtener los prestamos registrados
    public function listaPrestamo()
    {
        try {
            $query = "SELECT `prestamo`.`Id_prestamo`, `prestamo`.`Fecha_prestamo`, `prestamo`.`Fecha_devolucion`, `prestamo`.`Estado`, `libro`.`Id_libro`, `libro`.`Titulo`, `cliente`.`Nombre`, `cliente`.`Apellido` FROM `prestamo` LEFT JOIN `libro` ON `prestamo`.`Id_libro` = `libro`.`Id_libro` LEFT JOIN `cliente` ON `prestamo`.`Id_cliente` = `cliente`.`Id_cliente`;";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            $consult = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $consult;

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function devolverLibro($id, $idLibro)
    {
        try {

            $this->disponibilidad($id);
            $query = "SELECT `prestamo`.`Id_prestamo`, `prestamo`.`Id_libro`, `prestamo`.`Estado`, `libro`.`Id_libro`, `libro`.`Titulo` FROM `prestamo` LEFT JOIN `libro` ON `prestamo`.`Id_libro` = `libro`.`Id_libro`;";
            //$query = "SELECT `prestamo`.`Id_prestamo`, `prestamo`.`Id_libro`, `prestamo`.`Estado`, `libro`.`Id_libro`, `libro`.`Titulo` FROM `prestamo` LEFT JOIN `libro` ON `prestamo`.`Id_libro` = `libro`.`Id_libro` WHERE `prestamo`.`Id_prestamo` = ? AND `prestamo`.`Id_libro` = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $result) {

                if ($result["Estado"] == 1) {

                    $query = "UPDATE `prestamo` SET `Estado`= 0 WHERE Id_libro = ? AND Id_prestamo = ?";
                    $stmt = $this->conect->prepare($query);
                    $stmt->execute([$idLibro, $id]);

                    $query = "UPDATE `libro` SET `Ejemplares`= `Ejemplares` +1, `Ejemplar_prestado`= `Ejemplar_prestado` -1  
                          WHERE Id_libro = ? AND `Ejemplar_prestado` > 0";
                    $this->conect->prepare($query)->execute(
                        array(
                            $idLibro
                        )
                    );
                    return true;

                }
            }
            return false;


        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }



    public function registrarPrestamo(prestamo $dashboard)
    {
        try {

            $query = "SELECT `Id_libro`, `Ejemplares`, `Ejemplar_prestado`, `Disponibilidad` FROM `libro` WHERE `Id_libro` = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($dashboard->getId_libro()));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($result && $result["Ejemplares"] > 0) {
                $query = "INSERT INTO `prestamo`(`Fecha_prestamo`, `Fecha_devolucion`, `Id_libro`, `Id_cliente`, `Estado`)
                              VALUES (?, ?, ?, ?, ? );";
                $this->conect->prepare($query)->execute(
                    array(
                        $dashboard->getFecha_prestamo(),
                        $dashboard->getFecha_devolucion(),
                        $dashboard->getId_libro(),
                        $dashboard->getId_cliente(),
                        $dashboard->getEstado()
                    )
                );

                $query = "UPDATE `libro` SET `Ejemplares`= `Ejemplares` -1, `Ejemplar_prestado`= `Ejemplar_prestado` +1  
                          WHERE Id_libro = ? AND `Ejemplares` > 0";
                $this->conect->prepare($query)->execute(
                    array(
                        $dashboard->getId_libro()
                    )
                );
                header("Location: ?view=prestamo");
                exit();

            } else {


                header("Location: ?view=prestamo&msg=Libro no Disponible Intente en otro Momento");
                exit();

            }

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }





    //verifica si hay ejemplares disponibles del libro y si no lo hay pone disponibilidad en No
    public function disponibilidad()
    {
        $query = "SELECT `Id_libro`, `Disponibilidad`, `Ejemplares` FROM `libro` WHERE  Ejemplares > 0";
        $stmt = $this->conect->prepare($query);
        $stmt->execute();
        $consult = $stmt->fetch(PDO::FETCH_ASSOC);

        
            $query = "UPDATE `libro` SET `Disponibilidad`= 'Si' WHERE `Ejemplares` > 0";
            $this->conect->prepare($query)->execute();

            $query1 = "UPDATE `libro` SET `Disponibilidad`= 'No' WHERE  `Ejemplares` = 0";
            $this->conect->prepare($query1)->execute();

    }

    //esta funcion es para obtener los libros registrados
    public function listaLibros()
    {
        try {
            $query = "SELECT `libro`.`Id_libro`, `categoria`.`Nombre`, `editorial`.`Nombre`, `autor`.`Nombre`, `autor`.`Apellido`, `libro`.`Titulo`, `libro`.`Año_publicacion`, `libro`.`Disponibilidad`, `libro`.`Ejemplares` FROM `libro` LEFT JOIN `categoria` ON `libro`.`Id_categoria` = `categoria`.`Id_categoria` LEFT JOIN `editorial` ON `libro`.`Id_editorial` = `editorial`.`Id_editorial` LEFT JOIN `autor` ON `libro`.`Id_autor` = `autor`.`Id_autor`;";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function libroPorCategoria($idCategoria){
        try {

            if($idCategoria > 1){
                $query = "SELECT `categoria`.`Id_categoria`,`autor`.`Nombre`, `autor`.`Apellido`, `libro`.`Titulo`, `libro`.`Disponibilidad`, `libro`.`Ejemplares` FROM `libro` LEFT JOIN `categoria` ON `libro`.`Id_categoria` = `categoria`.`Id_categoria` LEFT JOIN `autor` ON `libro`.`Id_autor` = `autor`.`Id_autor` WHERE `categoria`.`Id_categoria` = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($idCategoria));
            return $stmt->fetchAll(PDO::FETCH_OBJ);

            }else{

                $query = "SELECT `categoria`.`Id_categoria`,`autor`.`Nombre`, `autor`.`Apellido`, `libro`.`Titulo`, `libro`.`Disponibilidad`, `libro`.`Ejemplares` FROM `libro` LEFT JOIN `categoria` ON `libro`.`Id_categoria` = `categoria`.`Id_categoria` LEFT JOIN `autor` ON `libro`.`Id_autor` = `autor`.`Id_autor` ";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

            }
            

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

    }

    public function catalogo(){
        try {

                $query = "SELECT `categoria`.`Id_categoria`,`autor`.`Nombre`, `autor`.`Apellido`, `libro`.`Titulo`, `libro`.`Disponibilidad`, `libro`.`Ejemplares` FROM `libro` LEFT JOIN `categoria` ON `libro`.`Id_categoria` = `categoria`.`Id_categoria` LEFT JOIN `autor` ON `libro`.`Id_autor` = `autor`.`Id_autor` ";
            $stmt = $this->conect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);            

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

    }


    public function registrarLibro(libro $dashboard)
    {
        try {
                 $query = "INSERT INTO `libro`(`Id_categoria`, `Id_editorial`, `Id_autor`, `Titulo`, `Año_publicacion`, `Disponibilidad`, `Ejemplares`) VALUES (?, ?, ?, ?, ?, ?, ?);";
                $this->conect->prepare($query)->execute(
                        array(
                            $dashboard->getId_categoria(),
                            $dashboard->getId_editorial(),
                            $dashboard->getId_autor(),
                            $dashboard->getTitulo(),
                            $dashboard->getAño_publicacion(),
                            $dashboard->getDisponibilidad(),
                            $dashboard->getEjemplares()

                        )
                    );
                
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function eliminarLibro($id)
    {
        try {
            $query = "DELETE FROM `libro` WHERE Id_libro = ?";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));

        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function id_libro($id)
    {
        try {
            $query = "SELECT `Id_libro`, `Titulo`, `Id_autor`, `Ejemplares` FROM `libro` WHERE Id_libro = ? ";
            $stmt = $this->conect->prepare($query);
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function actualizarLibro($dashboard)
    {
        try {
            
                    $query = "UPDATE `libro` SET `Titulo`= ?, `Id_autor`= ?, `Ejemplares`= ? WHERE Id_libro = ?";
                    $this->conect->prepare($query)->execute(
                        array(
                            $dashboard->getTitulo(),
                            $dashboard->getId_autor(),
                            $dashboard->getEjemplares(),
                            $dashboard->getId()
                        )
                    );
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }


}

?>