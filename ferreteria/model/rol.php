<?php
class Rol
{
    private $pdo;

    public $id;
    public $rol;

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

            $stm = $this->pdo->prepare("SELECT * FROM roles");
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
                ->prepare("SELECT * FROM roles WHERE id_rol = ?");


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
                ->prepare("DELETE FROM roles WHERE id_rol = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE roles SET 
						rol       = ?
				    WHERE id_rol = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->rol,
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Rol $data)
    {
        try {
            $sql = "INSERT INTO roles (rol) 
		        VALUES (?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->rol,
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}