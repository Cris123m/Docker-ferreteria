<?php
require_once 'model/producto.php';

class ProductoController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Producto();
    }

    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/producto/producto.php';
        require_once 'view/footer.php';
    }

    public function Crud()
    {
        $pro = new Producto();

        if (isset($_REQUEST['id'])) {
            $pro = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/producto/producto-editar.php';
        require_once 'view/footer.php';
    }

    public function Guardar()
    {
        $pro = new Producto();

        $pro->id = $_REQUEST['id'];
        $pro->nombreProducto = $_REQUEST['nombreProducto'];
        $pro->descripcion = $_REQUEST['descripcion'];
        $pro->precio = $_REQUEST['precio'];

        $pro->id > 0
            ? $this->model->Actualizar($pro)
            : $this->model->Registrar($pro);

        header('Location: ?c=Producto');
    }

    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: ?c=Producto');
    }

    public function JSONProductos()
    {
        echo json_encode($this->model->Listar(), JSON_FORCE_OBJECT);
    }
}