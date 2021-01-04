<?php
class Cliente
{
    private $pdo;

    public $id;
    public $Identificacion;
    public $Nombre;
    public $Apellido;
    public $Telefono;
    public $Direccion;
    public $Correo;
    public $usuario;

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

            $stm = $this->pdo->prepare("SELECT * FROM clientes");
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
                ->prepare("SELECT * FROM clientes WHERE id_cliente = ?");


            $stm->execute(array($id));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerXUsuario($id)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM clientes WHERE usuario_id = ?");


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
                ->prepare("DELETE FROM clientes WHERE id_cliente = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE clientes SET 
						nombre          = ?, 
						apellido        = ?,
                        telefono        = ?,
						direccion       = ?, 
						correo          = ?
				    WHERE id_cliente = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->Nombre,
                        $data->Apellido,
                        $data->Telefono,
                        $data->Direccion,
                        $data->Correo,
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Cliente $data)
    {
        try {
            $sql = "INSERT INTO clientes (identificacion, nombre, apellido, telefono, direccion, correo, usuario_id) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->Identificacion,
                        $data->Nombre,
                        $data->Apellido,
                        $data->Telefono,
                        $data->Direccion,
                        $data->Correo,
                        $data->usuario,
                    )
                );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}