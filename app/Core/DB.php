<?php

namespace Core;
use PDO;

class DB{


    public function connect(){
        return $this->pdo();
    }

    protected function pdo(){
        $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
        $dbusername = $_ENV['DB_USER'];
        $dbpassword = $_ENV['DB_PASS'];

        try {
            $pdo = new PDO($dsn, $dbusername, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
        } catch ( PDOException $e ) {
            echo "connection faild " . $e->getMassage();
        }

        return $pdo;

    }
}