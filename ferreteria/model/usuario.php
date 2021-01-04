<?php
class Usuario
{
    private $pdo;

    public $id;
    public $usuario;
    public $clave;
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

            $stm = $this->pdo->prepare("SELECT * FROM usuarios");
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
                ->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");

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
                ->prepare("DELETE FROM usuarios WHERE id_usuario = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data)
    {
        try {
            $sql = "UPDATE usuarios SET 
						usuario       = ?, 
						clave         = ?,
                        rol_id        = ?
				    WHERE id_usuario = ?";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->usuario,
                        $data->clave,
                        $data->rol,
                        $data->id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Usuario $data)
    {
        try {
            $password = password_hash($data->clave, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (usuario, clave, rol_id) 
		        VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->usuario,
                        $password,
                        $data->rol,
                    )
                );
            return $this->pdo->lastInsertId();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Login($usuario, $clave)
    {
        try {
            $stm = $this->pdo
                ->prepare("SELECT * FROM usuarios WHERE usuario = ?");

            $stm->execute(array($usuario));
            $usuario = $stm->fetch(PDO::FETCH_OBJ);
            if (password_verify($clave, $usuario->clave)) {
                unset($usuario->clave);
                return $usuario;
            } else {
                return false;
            }
            //return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}