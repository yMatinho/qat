<?php

namespace Framework\DB;

use PDO;

class MySQLDB extends DB {
    protected $username;
    protected $password;
    protected $database;
    protected $host;
    private static $instance;

    protected function __construct()
    {
        parent::__construct(DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_HOST);
    }

    public static function get():MySQLDB {
        if(!self::$instance)
            self::$instance = new MySQLDB();
        return self::$instance;
    }

    public function connection() {
        $pdo = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
        return $pdo;
    }
    public function rawQuery(string $query, bool $return=false, $returnMany=false) {
        $pdo = $this->connection();
        $query = $pdo->prepare($query);
        $query->execute();

        if($return) {
            $returnedData = $query->fetchAll();
            if(!$returnMany)
                return $returnedData[0];
            return $returnedData;
        }
    }
}