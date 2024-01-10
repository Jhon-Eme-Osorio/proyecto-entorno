<?php
//incluyo el archivo de libro.php
include_once "model/dashboard.php";
include_once "model/datosAutor.php";
include_once "model/datosCategoria.php";
include_once "model/datosEditorial.php";
include_once "model/datosCliente.php";
include_once "model/datosAdmin.php";
include_once "model/datosPrestamo.php";
include_once "model/datosLibro.php";
class control
{

    public $model;
    //creo un constructor
    public function __construct()
    {
        //instancio la clase modelo
        $this->model = new dashboard();

    }
    //creo funcion para lanzar el index de mi proyecto
    public function index()
    {
        session_start();
        if (!isset($_SESSION["user-id"]) && isset($_COOKIE["usuario"])) {
            $_SESSION["user-id"] = $_COOKIE["usuario"];
            header("Location: ?view=home");
        } else if (isset($_SESSION["user-id"])) {
            header("Location: ?view=home");
        }
        $msg = "";
        if (isset($_SESSION["msg"])) {
            $msg = $_SESSION["msg"];
            unset($_SESSION["msg"]);
        }
        include_once "view/login.php";
    }
    //funcion para lanzar la vista home
    public function home()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }

        $admin = new admin();
        include_once "view/home.php";
    }

    //funcion para validar el login pasandole los datos del formulario al model sesion
    public function login()
    {
        $admin = new admin();
        $admin->setUsuario($_POST["usuario"]);
        $admin->setContraseña($_POST["contraseña"]);
        $admin->setRemember($_POST["loginCheck"]);
        $this->model->sesion($admin);


        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");

        } else if (isset($_SESSION["user-id"])) {
            header("Location: ?view=home");
        }
    }

    //funcion para cerrar Sesion
    public function cerrarLogin()
    {
        $this->model->cerrarSesion();
    }


    public function guardarContraseña()
    {
        $admin = new admin();
        $admin->setContraseña($_POST["contraseña-actual"]);
        $admin->setNuevaContraseña($_POST["nueva-contraseña"]);

        if ($_POST["nueva-contraseña"] == $_POST["confirmar-contraseña"]) {

            $contraseñaActualizada = $this->model->actualizarContraseña($admin);

            if ($contraseñaActualizada) {
                header("Location: ?view=home&msg=Contraseña Del Sistema Actualizada");
            } else {
                header("Location: ?view=home&msg=La Contraseña No coincide con La del Sistema / No Se Puede Modificar ");
            }
        } else {
            header("Location: ?view=home&msg=Nueva Contraseña y Confirmar Contraseña No coincide / No Se Puede Modificar ");
        }
    }
    //me lleva a la vista autor
    public function autor()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $autor = new autor();
        include_once "view/autor.php";
    }
    //me lleva al formulario para actualizar autor
    public function idAutor()
    {
        $autor = new autor();
        if (isset($_REQUEST["Id_autor"])) {
            $autor = $this->model->id_Autor($_REQUEST["Id_autor"]);
        }
        include_once "view/actualizarAutor.php";
    }

    public function guardarAutor()
    {
        $autor = new autor();
        $autor->setId($_POST["Id_autor"]);
        $autor->setNombre($_POST["nombre-autor"]);
        $autor->setApellido($_POST["apellido-autor"]);
        $autor->setFechaNacimiento($_POST["fecha-nacimiento-autor"]);

        $autor->Id > 0 ? $this->model->actualizarAutor($autor) : $this->model->registrarAutor($autor);
        //me redirige a la vista autor
        header("Location: ?view=autor");
        exit();
    }

    public function borrarAutor()
    {
        $this->model->eliminarAutor($_REQUEST["Id_autor"]);
        header("Location: ?view=autor&msg=Autor Eliminado");
        exit();
    }

    //me lleva a la vista categoria
    public function categoria()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $categoria = new categoria();
        include_once "view/categoria.php";
    }

    //me lleva al formulario para actualizar categoria
    public function idCategoria()
    {
        $categoria = new categoria();
        if (isset($_REQUEST["Id_categoria"])) {
            $categoria = $this->model->id_categoria($_REQUEST["Id_categoria"]);
        }
        include_once "view/actualizarCategoria.php";
    }

    public function guardarCategoria()
    {
        $categoria = new categoria();
        $categoria->setId($_POST["Id_categoria"]);
        $categoria->setNombre($_POST["nombre-categoria"]);
        $categoria->setDescripcion($_POST["descripcion-categoria"]);

        $categoria->Id > 0 ? $this->model->actualizarCategoria($categoria) : $this->model->registrarCategoria($categoria);
        //me redirige a la vista categoria
        header("Location: ?view=categoria");
        exit();
    }

    public function borrarCategoria()
    {
        $this->model->eliminarCategoria($_REQUEST["Id_categoria"]);
        header("Location: ?view=categoria&msg=Categoria Eliminada");
        exit();
    }

    //me lleva a la vista editorial
    public function editorial()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $editorial = new editorial();
        include_once "view/editorial.php";
    }

    //me lleva al formulario para actualizar editorial
    public function idEditorial()
    {
        $editorial = new editorial();
        if (isset($_REQUEST["Id_editorial"])) {
            $editorial = $this->model->id_editorial($_REQUEST["Id_editorial"]);
        }
        include_once "view/actualizarEditorial.php";
    }

    public function guardarEditorial()
    {
        $editorial = new editorial();
        $editorial->setId($_POST["Id_editorial"]);
        $editorial->setNombre($_POST["nombre-editorial"]);
        $editorial->setTelefono($_POST["telefono-editorial"]);

        $editorial->Id > 0 ? $this->model->actualizarEditorial($editorial) : $this->model->registrarEditorial($editorial);
        //me redirige a la vista editorial
        header("Location: ?view=editorial");
        exit();
    }

    public function borrarEditorial()
    {
        $this->model->eliminarEditorial($_REQUEST["Id_editorial"]);
        header("Location: ?view=editorial&msg=Editorial Eliminada");
        exit();
    }

    //me lleva a la vista cliente
    public function cliente()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $cliente = new cliente();
        include_once "view/cliente.php";
    }

    //me lleva al formulario para actualizar cliente
    public function idCliente()
    {
        $cliente = new cliente();
        if (isset($_REQUEST["Id_cliente"])) {
            $cliente = $this->model->id_cliente($_REQUEST["Id_cliente"]);
        }
        include_once "view/actualizarCliente.php";
    }

    public function guardarCliente()
    {
        $cliente = new cliente();
        $cliente->setId($_POST["Id_cliente"]);
        $cliente->setNombre($_POST["nombre-cliente"]);
        $cliente->setApellido($_POST["apellido-cliente"]);
        $cliente->setDireccion($_POST["direccion-cliente"]);
        $cliente->setTelefono($_POST["telefono-cliente"]);
        $cliente->setCorreo($_POST["correo-cliente"]);

        //aqui compruebo de que no se duplique el registro
        if ($this->model->duplicadoCliente($cliente->getNombre(), $cliente->getApellido())) {
            //aqui compruebo si hay un cliente con el mismo id y si lo hay actualiza
            if ($cliente->getId() > 0) {
                $this->model->actualizarCliente($cliente);
                header("Location: ?view=cliente&msg=El Cliente Se ha actualizado");
            } else {
                // Si no hay ID, significa que es un nuevo cliente y no debería mostrar el mensaje de duplicado
                header("Location: ?view=cliente&msg=El Cliente ya está registrado ");
                exit();
            }
        } else {
            //si no lo esta me  registra en la base de datos
            $this->model->registrarCliente($cliente);
            //me redirige a la vista cliente
            header("Location: ?view=cliente");
            exit();
        }


    }

    public function borrarCliente()
    {
        $this->model->eliminarCliente($_REQUEST["Id_cliente"]);
        header("Location: ?view=cliente&msg=Cliente Eliminado");
        exit();
    }

    //me lleva a la vista prestamo
    public function prestamo()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $prestamo = new prestamo();
        include_once "view/prestamo.php";
    }

    //me lleva al formulario para actualizar cliente

    public function devolver()
    {
        $prestamo = new prestamo();
        if (isset($_REQUEST["Id_prestamo"]) && isset($_REQUEST["Id_libro"])) {
            $resultado = $this->model->devolverLibro($_REQUEST["Id_prestamo"], $_REQUEST["Id_libro"]);

            if ($resultado) {
                header("Location: ?view=prestamo&msg=Libro devuelto");
            } else {
                header("Location: ?view=prestamo");
            }
        }

    }

    public function guardarPrestamo()
    {
        if (isset($_POST["libro"], $_POST["cliente"])) {
            $prestamo = new prestamo();
            $prestamo->setId($_POST["Id_prestamo"]);
            $prestamo->setFecha_prestamo($_POST["fecha-prestamo"]);
            $prestamo->setFecha_devolucion($_POST["fecha-devolucion"]);
            $prestamo->setId_libro($_POST["libro"]);
            $prestamo->setId_cliente($_POST["cliente"]);
            $prestamo->setEstado($_POST["estado"]);

            $this->model->registrarPrestamo($prestamo);
            //me redirige a la vista prestamo
            header("Location: ?view=prestamo");
            exit();
        } else {
            if ($_POST["libro"] == null && $_POST["cliente"] == null) {
                header("Location: ?view=prestamo&msg=Necesita tener registrado un Libro y un Cliente para registrar un Prestamo");
                exit();
            } else if ($_POST["libro"] == null) {
                header("Location: ?view=prestamo&msg=Necesita tener registrado un Libro para registrar un Prestamo");
                exit();

            } else if ($_POST["cliente"] == null) {

                header("Location: ?view=prestamo&msg=Necesita tener registrado un Cliente para registrar un Prestamo");
                exit();
            }
        }

    }

    //me lleva a la vista Libro
    public function libro()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $libro = new libro();
        $this->model->disponibilidad();
        include_once "view/libro.php";
    }

    //obtengo el id del libro y voy a la vista actualizar
    public function idLibro()
    {
        $libro = new libro();
        if (isset($_REQUEST["Id_libro"])) {
            $libro = $this->model->id_libro($_REQUEST["Id_libro"]);
        }
        include_once "view/actualizarLibro.php";
    }

    public function guardarLibro()
    {   //valido que se reciban los datos del formulario, 
        if (isset($_POST["categoria"], $_POST["editorial"], $_POST["autor"], $_POST["titulo"], $_POST["fecha-publicacion"], $_POST["disponible"], $_POST["ejemplares"])) {
            $libro = new libro();
            $libro->setId($_POST["Id_libro"]);
            $libro->setId_categoria($_POST["categoria"]);
            $libro->setId_editorial($_POST["editorial"]);
            $libro->setId_autor($_POST["autor"]);
            $libro->setTitulo($_POST["titulo"]);
            $libro->setAño_publicacion($_POST["fecha-publicacion"]);
            $libro->setDisponibilidad($_POST["disponible"]);
            $libro->setEjemplares($_POST["ejemplares"]);

            $libro->Id > 0 ? $this->model->actualizarLibro($libro) : $this->model->registrarLibro($libro);
            //me redirige a la vista libro
            header("Location: ?view=libro");
            exit();
        } else {
            // si no se recibe datos me indica en un mensaje la accion que debo realizar para registrar un libro
            if ($_POST["categoria"] == null && $_POST["editorial"] == null && $_POST["autor"] == null) {
                header("Location: ?view=libro&msg=Necesita Tener registrada una Categoria, Editorial y Autor para registrar un Libro");
                exit();
            } else if ($_POST["editorial"] == null && $_POST["autor"] == null) {
                header("Location: ?view=libro&msg=Necesita Tener registrada una Editorial y Autor para registrar un Libro");
                exit();

            } else if ($_POST["autor"] == null) {
                header("Location: ?view=libro&msg=Necesita Tener registrado un Autor para registrar un Libro");
                exit();

            }

        }

    }

    public function updateLibro()
    {
        $libro = new libro();
        $libro->setId($_POST["Id_libro"]);
        $libro->setTitulo($_POST["titulo"]);
        $libro->setId_autor($_POST["autor"]);
        $libro->setEjemplares($_POST["ejemplares"]);

        $this->model->actualizarLibro($libro);
        //me redirige a la vista libro
        header("Location: ?view=libro");
        exit();

    }

    public function borrarLibro()
    {
        $this->model->eliminarLibro($_REQUEST["Id_libro"]);
        header("Location: ?view=libro&msg=Libro Eliminado");
        exit();
    }

    public function catalogo()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }
        $libro = new libro();
        $this->model->disponibilidad();
        include_once "view/catalogo.php";
    }

    public function idLibroCategoria()
    {
        session_start();
        $libro = new libro();
        $idCategoria = $_POST["categoria"];
        $_SESSION["idCategoria"] = $idCategoria;

        $libros = $this->model->libroPorCategoria($idCategoria);

        $_SESSION['librosPorCategoria'] = $libros;
        //me redirige a la vista catalogo y le paso el id de la categoria
        header("Location: ?view=catalogo&msg=$idCategoria");
        exit();

    }

    //aqui genero un reporte de los clientes registrados en pdf
    public function reporteCliente()
    {
        session_start();
        if (!isset($_SESSION["user-id"])) {
            header("Location: ?view=index");
        }

        $cliente = $this->model->listaCliente();
        if(count($cliente) !== 0){
            include_once "view/reporteCliente.php";

        }else{
            header("Location: ?view=home&msg=No se puede Generar el reporte en pdf no hay datos en clientes");
        }
        
        
    }

     //aqui genero un reporte de los Libros registrados en pdf
     public function reporteLibro()
     {
         session_start();
         if (!isset($_SESSION["user-id"])) {
             header("Location: ?view=index");
         }
 
         $libro = $this->model->listaLibros();
         if(count($libro) !== 0){
             include_once "view/reporteLibro.php";
 
         }else{
             header("Location: ?view=home&msg=No se puede Generar el reporte en pdf no hay datos en Libro");
         }
         
         
     }

      //aqui genero un reporte de los Prestamos registrados en pdf
      public function reportePrestamos()
      {
          session_start();
          if (!isset($_SESSION["user-id"])) {
              header("Location: ?view=index");
          }
  
          $prestamo = $this->model->listaPrestamo();
          if(count($prestamo) !== 0){
              include_once "view/reportePrestamo.php";
  
          }else{
              header("Location: ?view=home&msg=No se puede Generar el reporte en pdf no hay datos en Prestamo");
          }
          
          
      }

    



}

?>