<?php


class Usuario
{
    private $id;
    private $email;
    private $password;
    private $usuario;


    /**
     * @param string $email
     * @return Usuario|null
     */
    public function verificarEmail($email){
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM usuarios
                   WHERE email = ?";

        $stmt = $db->prepare($query);
        $stmt->execute([$email]);

        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)){
            return null;
        }

        
        $usuario = new Usuario;
        $usuario->id = $fila['id'];
        $usuario->password = $fila['password'];
        $usuario->email = $fila['email'];

        return $usuario;

    }

    /**
     * @param int $pk
     * @return Usuario|null
     */
    public function getById(int $id)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM usuarios
                    WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        if(!$fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return null;
        }

        $usuario = new Usuario;
        $usuario->id = $fila['id'];
        $usuario->password = $fila['password'];
        $usuario->email = $fila['email'];

        return $usuario;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }



}