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



//
///**
// * assumindo que os valores possiveis para essas variáveis sejam TRUE e FALSE, a função empty pode ser utilizada.
// */
//if ((!empty($_SESSION['loggedin'])) || (!empty($_COOKIE['Loggedin']))) {
//    location('http://www.google.com');
//}

//
//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//    header("Location: http://www.google.com");
//    exit();
//} elseif (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true) {
//    header("Location: http://www.google.com");
//    exit();
//}







