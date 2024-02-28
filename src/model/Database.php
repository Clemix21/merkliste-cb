<?php
// src/model/Database.php

class Database {
    private $host = 'mysql';
    private $user = 'user';
    private $pass = 'password123';
    private $dbname = 'merkliste';

    public function getConnection() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $conn = new PDO($dsn, $this->user, $this->pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    }
}

