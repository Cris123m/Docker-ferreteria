<?php
require_once 'model/usuario.php';

class UsuarioController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Usuario();
    }

    public function Index()
    {
        require_once 'view/usuario/header.php';
        require_once 'view/usuario/usuario-login.php';
        require_once 'view/usuario/footer.php';
    }

    public function Crud()
    {
        $usu = new Usuario();

        if (isset($_REQUEST['id'])) {
            $usu = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/usuario/header.php';
        require_once 'view/cliente/cliente-editar.php';
        require_once 'view/usuario/footer.php';
    }

    public function Guardar()
    {
        $usu = new Usuario();

        $usu->id = $_REQUEST['id'];
        $usu->nombreUsuario = $_REQUEST['nombreUsuario'];
        $usu->descripcion = $_REQUEST['descripcion'];
        $usu->precio = $_REQUEST['precio'];

        $usu->id > 0
            ? $this->model->Actualizar($usu)
            : $this->model->Registrar($usu);

        header('Location: ?c=Usuario');
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: ?c=Usuario');
    }

    public function LoginJSON()
    {
        require_once 'model/cliente.php';

        $cli = new Cliente();
        $usuario = $_REQUEST['usuario'];
        $clave = $_REQUEST['password'];

        $usu = $this->model->Login($usuario, $clave);

        if (!isset($_SESSION)) {
            session_start();
        }

        if ($usu->rol_id == 2) {
            $_SESSION['cliente'] = $cli->ObtenerXUsuario($usu->id_usuario);
        }

        $_SESSION['usuario'] = $usu;

        echo json_encode($usu, JSON_FORCE_OBJECT);
    }

    public function Logout()
    {
        if (isset($_SESSION)) {
            session_destroy();
        }
        header('Location: ?c=Usuario');
    }

    public function JSONUsuarios()
    {
        echo json_encode($this->model->Listar(), JSON_FORCE_OBJECT);
    }
}