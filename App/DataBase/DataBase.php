<?php
namespace App\DataBase;
use PDO;
use PDOException;
class DataBase{
    private $dbName;
    private $dbhost;
    private $dbUserName;
    private $dbpassward;
    private $conn;
    public function __construct($config)
{
    $this->dbhost = $config['DB_HOST'];
    $this->dbName = $config['DB_NAME'];
    $this->dbUserName = $config['DB_USER'];
    $this->dbpassward = $config['DB_PASS'];
}

    public function getConnection() {
        $this->conn = null;
        try {
            $dsn="mysql:host=$this->dbhost;dbname=$this->dbName";
            $this->conn = new PDO($dsn, $this->dbUserName, $this->dbpassward);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"connection is done!<br>";
        } catch (PDOException $exception) {
            echo "Connection Error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
