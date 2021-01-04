<?php
require_once 'model/cliente.php';

class ClienteController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Cliente();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/cliente/cliente.php';
        require_once 'view/footer.php';
    }

    public function Crud()
    {
        $cli = new Cliente();

        if (isset($_REQUEST['id'])) {
            $cli = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/cliente/cliente-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        require_once 'model/usuario.php';
        $cli = new Cliente();
        $usu = new Usuario();

        $cli->id = $_REQUEST['id'];
        $cli->Identificacion = $_REQUEST['identificacion'];
        $cli->Nombre = $_REQUEST['Nombre'];
        $cli->Apellido = $_REQUEST['Apellido'];
        $cli->Telefono = $_REQUEST['Telefono'];
        $cli->Direccion = $_REQUEST['Direccion'];
        $cli->Correo = $_REQUEST['Correo'];

        if ($cli->id > 0) {
            $this->model->Actualizar($cli);
        } else {
            $usu->usuario = $_REQUEST['Correo'];
            $usu->clave = $_REQUEST['password'];
            $usu->rol = 2;
            $idUsu = $usu->Registrar($usu);
            if ($idUsu > 0) {
                $cli->usuario = $idUsu;
            }
            $this->model->Registrar($cli);
        }

        header('Location: ?c=Cliente');
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: ?c=Cliente');
    }
}