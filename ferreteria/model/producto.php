<?php
class Producto
{
    private $pdo;

    public $id;
    public $nombreProducto;
    public $descripcion;
    public $precio;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Listar()
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM productos");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM productos WHERE id_producto = ?");


            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("DELETE FROM productos WHERE id_producto = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE productos SET 
						nombreProducto          = ?, 
						descripcion        = ?,
                        precio        = ?
				    WHERE id_producto = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->nombreProducto,
                        $data->descripcion,
                        $data->precio,
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Producto $data)
    {
        try {
            $sql = "INSERT INTO productos (nombreProducto, descripcion, precio) 
		        VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->nombreProducto,
                        $data->descripcion,
                        $data->precio,
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}