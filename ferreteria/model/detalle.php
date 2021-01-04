<?php
class Detalle
{
    private $pdo;

    public $id;
    public $factura;
    public $producto;
    public $cantidad;
    public $subtotal;

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

            $stm = $this->pdo->prepare("SELECT * FROM detalles");
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
                ->prepare("SELECT * FROM detalles WHERE id_detalle = ?");


            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerXFactura($facturaId)
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM detalles WHERE factura_id = ?");
            $stm->execute(array($facturaId));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("DELETE FROM detalles WHERE id_detalle = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE detalles SET 
						factura_id    = ?, 
						producto_id   = ?,
                        cantidad      = ?,
                        subtotal      = ?
				    WHERE id_detalle  = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->factura,
                        $data->producto,
                        $data->cantidad,
                        $data->subtotal,
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Detalle $data)
    {
        try {
            $sql = "INSERT INTO detalles (factura_id, producto_id, cantidad, subtotal) 
		        VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->factura,
                        $data->producto,
                        $data->cantidad,
                        $data->subtotal,
                    )
                );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}