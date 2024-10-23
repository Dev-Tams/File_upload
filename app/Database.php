<?php

namespace App;

use PDO;
use PDOException;

use function functions\abort;

class Database
{
    public $connection;
    public $statement;


    
    public function __construct($config)
    {


        $username = $config['username'];
        $password = $config['password'];
        $host = $config['host'];
        $database = $config['database'];
        $charset = $config['charset'];

        
        $dsn = "mysql:host=$host;dbname=$database;charset=$charset";
        try {
            $this->connection =  new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
           $e->getMessage();
        }
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function findOrFail()
    {
        $find = $this->statement->fetch();
        if (! $find) {
            abort(404);
        }
        return $find;
    }
    public function get()
    {
        return $this->statement->fetchAll();
    }
}
