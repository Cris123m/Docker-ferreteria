<?php
require_once 'model/detalle.php';

class DetalleController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Detalle();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/detalle/detalle.php';
        require_once 'view/footer.php';
    }

    public function Crud()
    {
        $det = new Detalle();

        if (isset($_REQUEST['id'])) {
            $det = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/detalle/detalle-editar.php';
        require_once 'view/footer.php';
    }

    public function GuardarJSON()
    {
        $det = new Detalle();

        $det->id = $_REQUEST['id'];
        $det->factura = $_REQUEST['factura'];
        $det->producto = $_REQUEST['producto'];
        $det->cantidad = $_REQUEST['cantidad'];
        $det->subtotal = $_REQUEST['subtotal'];
        $resp = '';

        $det->id > 0
            ? $resp = $this->model->Actualizar($det)
            : $resp = $this->model->Registrar($det);

        echo json_encode($resp, JSON_FORCE_OBJECT);

        //header('Location: ?c=Detalle');
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: ?c=Detalle');
    }

    public function JSONDetalles()
    {
        echo json_encode($this->model->Listar(), JSON_FORCE_OBJECT);
    }
}