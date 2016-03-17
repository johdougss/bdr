#Teste de Conhecimentos – Analista Desenvolvedor - vaga de Desenvolvedor PHP Pleno.

###Todos os requisitos do escopo dos testes foram implementados inclusive os considerados diferenciais

### Instalação

### Requisitos
* PHP 5.3 ou superior.
* MySQL

Clonar o repositório na raiz de um servidor apache.
```
git clone https://github.com/johnathansantos/bdr.git
```

Acessar o seguinte endereços do seu navegador:

```
http://localhost/bdr/
```

Para o exercício 4 é necessário a inclusão do banco de dados que se encontra na raiz do projeto

```
dump.sql
```



## Tarefa 1

Escreva um programa que imprima números de 1 a 100. Mas, para múltiplos de 3 imprima
“Fizz” em vez do número e para múltiplos de 5 imprima “Buzz”. Para números múltiplos
de ambos (3 e 5), imprima “FizzBuzz”.

### Solução:
```php
<?php
class Multiple
{
    public function verifyFizzBuzz($start, $end)
    {
        $result = '';
        for ($i = $start; $i <= $end; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $result .= 'FizzBuzz<br>';
            } elseif ($i % 3 == 0) {
                $result .= 'Fizz<br>';
            } elseif ($i % 5 == 0) {
                $result .= 'Buzz<br>';
            } else {
                $result .= $i . '<br>';
            }
        }
        return $result;
    }
}

$multiple = new Multiple;
echo $multiple->verifyFizzBuzz(1, 100);
```

## Tarefa 2
Refatore o código abaixo, fazendo as alterações que julgar necessário.
```php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("Location: http://www.google.com");
    exit();
} elseif (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true) {
    header("Location: http://www.google.com");
    exit();
}
```
### Solução:
```php
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

```



## Tarefa 3
Refatore o código abaixo, fazendo as alterações que julgar necessário
```php
<?php

class MyUserClass
{
    public function getUserList()
    {
        $dbconn = new DatabaseConnection('localhost','user','password');
        $results = $dbconn->query('select name from user');
        sort($results);
        return $results;
    }
}
```

### Solução:
```php
<?php

/**
 * Interface IDatabaseConnection
 *
 * Interface com os metodos necessários para utilização do banco.
 * Com isso é isolado a implementação, ou seja pode-se criar diferentes implementações para essa interface
 * e consequentemente fazer a injeção nas classes dependentes com a implementação desejada.
 *
 */
interface IDatabaseConnection
{
    public function query($query_str);
}

/**
 * Class MyDatabaseConnection
 *
 * Exemplo de uma das implementações possiveis para a interface.
 *
 */
class MyDatabaseConnection implements IDatabaseConnection
{

    protected $dbconn;

    function __construct()
    {
        $this->dbconn = new DatabaseConnection('localhost', 'user', 'password');
    }


    public function query($query_str)
    {
        return $this->dbconn->query($query_str);
    }
}

/**
 * Class UserRepository
 * Classe com o nome alterado para refletir a tarefa executada.
 *
 */
class UserRepository
{

    protected $connection;

    /**
     * UserRepository constructor.
     * @param IDatabaseConnection $connection - inject dependency - a conexão com o banco poderia ser injetado,
     * através de um motor de injeção de dependência.
     */
    function __construct(IDatabaseConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Retorna uma lista de usuarios, ordenados pelo nome
     * @return []
     */
    public function getUserList()
    {
        $results = $this->connection->query('select name from user order by name');
        // realizar a ordenação na propria query.
//        sort($results);
        return $results;
    }
}

```


--------------------------------------