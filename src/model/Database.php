<?php
// src/model/Database.php

class Database {
    private $host = 'mysql';
    private $user = 'user';
    private $password = 'password123';
    private $dbname = 'merkliste';

    public function getConnection()
    {
        $dsn = 'mysql:dbname=merkliste;host=mysql';
        try {
            $conn = new PDO($dsn, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }

        return $conn;
    }
    }


