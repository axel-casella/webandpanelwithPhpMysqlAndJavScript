<?php


class Auth
{
    public function login($email, $password){
            $usuario = new Usuario;
            $usuario = $usuario->verificarEmail($email);

        if($usuario !== null) {
            if(password_verify($password, $usuario->getPassword())) {
                $this->setAsAuthenticated($usuario);
                return true;
            }
        }
        return false;
    }

    public function logout(){
        unset($_SESSION['id']);
    }

    /**
    *   @param Usuario $usuario
    */
    public function setAsAuthenticated(Usuario $usuario): void
    {
        $_SESSION['id'] = $usuario->getId();
    }


    /**
     *
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return isset($_SESSION['id']);
    }

    /**
     *
     * @return Usuario|null
     */
    public function getUser()
    {
        if(!$this->isAuthenticated()) {
            return null;
        }

        $usuario = new Usuario;
        return $usuario->getById($_SESSION['id']);
    }

}