<?php
require_once 'model/factura.php';
require_once 'model/cliente.php';
require_once 'model/detalle.php';
require_once 'model/producto.php';

class FacturaController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Factura();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/factura/factura.php';
        require_once 'view/footer.php';
    }

    public function Crud()
    {
        $fac = new Factura();
        $cli = new Cliente();
        $pro = new Producto();

        if (isset($_REQUEST['id'])) {
            $fac = $this->model->Obtener($_REQUEST['id']);
        }
        date_default_timezone_set('America/Guayaquil');
        $hoy = date("Y-m-d");

        require_once 'view/header.php';
        require_once 'view/factura/factura-editar.php';
        require_once 'view/footer.php';
    }

    public function Ver()
    {
        $fac = new Factura();
        $cli = new Cliente();
        $pro = new Producto();
        $det = new Detalle();

        if (isset($_REQUEST['id'])) {
            $fac = $this->model->Obtener($_REQUEST['id']);
        }
        date_default_timezone_set('America/Guayaquil');
        $hoy = date("Y-m-d");

        require_once 'view/header.php';
        require_once 'view/factura/factura-ver.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        $fac = new Factura();

        $fac->id = $_REQUEST['id'];
        $fac->fecha = $_REQUEST['fecha'];
        $fac->cliente = $_REQUEST['cliente'];
        $fac->total = $_REQUEST['total'];

        $fac->id > 0
            ? $this->model->Actualizar($fac)
            : $this->model->Registrar($fac);

        header('Location: ?c=Factura');
    }

    public function GuardarJSON()
    {
        $fac = new Factura();

        $fac->id = $_REQUEST['id'];
        $fac->fecha = $_REQUEST['fecha'];
        $fac->cliente = $_REQUEST['cliente'];
        $fac->total = $_REQUEST['total'];
        $resp = '';

        $fac->ObtenerNumero() <= $fac->id
            ? $resp = $this->model->Actualizar($fac)
            : $resp = $this->model->Registrar($fac);

        echo json_encode($resp, JSON_FORCE_OBJECT);
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: ?c=Factura');
    }
}