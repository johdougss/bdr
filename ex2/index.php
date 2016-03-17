<?php


class LoginController
{
    protected $session_name = 'loggedin';
    protected $cookie_name = 'Loggedin';
    public $redirect = 'http://www.google.com';


    /**
     * verifica se está logado
     */
    public function isLogged()
    {
        if ($this->isCookieLogin() || $this->isSessionLogin())
            $this->redirect();
    }

    public function isCookieLogin()
    {
        return !empty($_COOKIE[$this->session_name]);
    }

    public function isSessionLogin()
    {
//        session_start();
        return !empty($_SESSION[$this->session_name]);
    }

    private function redirect()
    {
        header("Location: " . $this->redirect);
        //removido o exit(); pois assim possibilita a execução de testes unitarios.
    }
}
