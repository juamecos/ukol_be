<?php

namespace App\Database\Adapters;

use PDO;

require __DIR__ . './../../../vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class MariaDBAdapter implements DatabaseAdapterInterface {
    private $connection;
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $options;

    // Public constructor
    public function __construct() {
        $this->host = $_ENV['MYSQL_HOST'];
        $this->db = $_ENV['MYSQL_DATABASE'];
        $this->user = $_ENV['MYSQL_USER'];
        $this->pass = $_ENV['MYSQL_PASSWORD'];
        $this->charset = $_ENV['MYSQL_CHARSET'];
        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        $this->connect();
    }

    // Connect to the MariaDB database
    public function connect() {
        
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
            $this->connection = new PDO($dsn, $this->user, $this->pass, $this->options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Execute an SQL query on the database
    public function query($query) {
        if (!$this->connection) {
            $this->connect(); 
        }
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    // Return the ID of the last inserted row
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }

    // Disconnect from the database
    public function disconnect() {
        $this->connection = null;
    }
}
