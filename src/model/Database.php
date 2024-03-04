<?php

class Database
{
    private $host = 'mysql';
    private $user = 'user';
    private $password = 'password123';
    private $dbname = 'merkliste';

    public function getConnection() {
        $dsn = 'mysql:dbname=merkliste;host=mysql';
        $conn = new PDO($dsn, $this->user, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // check ob eine tabelle namens notes existiert
        if (!$this->doesTableExist($conn, 'notes')) {
            $this->initializeDatabase($conn);
        }

        return $conn;
    }

    private function doesTableExist($conn, $tableName) {
        $stmt = $conn->query("SHOW TABLES LIKE '$tableName'");
        return $stmt->rowCount() > 0;
    }

    private function initializeDatabase($conn) {
        $sqlFilePath = __DIR__ . '/../data/notes.sql';
        $sql = file_get_contents($sqlFilePath);
        $conn->exec($sql);
    }
}



