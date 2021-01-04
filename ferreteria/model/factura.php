<?php
class Factura
{
    private $pdo;

    public $id;
    public $fecha;
    public $cliente;
    public $total;

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

            $stm = $this->pdo->prepare("SELECT * FROM facturas");
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarXCliente($id)
    {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM facturas WHERE cliente_id = ?");
            $stm->execute(array($id));

            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM facturas WHERE id_factura = ?");


            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerNumero()
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT MAX(id_factura) idMayor FROM `facturas` WHERE 1");


            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("DELETE FROM facturas WHERE id_factura = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE facturas SET 
						fecha          = ?, 
						cliente_id     = ?,
                        total          = ?
				    WHERE id_factura   = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->fecha,
                        $data->cliente,
                        $data->total,
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Factura $data)
    {
        try {
            $sql = "INSERT INTO facturas (id_factura, fecha, cliente_id, total) 
		        VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->id,
                        $data->fecha,
                        $data->cliente,
                        $data->total,
                    )
                );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}