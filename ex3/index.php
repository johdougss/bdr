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