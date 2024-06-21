<?php
namespace App\Model;
use PDO;

class Order {
    private $conn;
    public $userName;
    public $prodeuctName;
    private $tableName = 'orders';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function callOrder(): void {
        $query = "SELECT * FROM ".$this->tableName;   
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as $order) {
            echo "order_id: " . $order['order_id'] . "<br>";
            echo "user_name: " . $order['user_name'] . "<br>";
            echo "product_name: " . $order['product_name'] . "<br><br>";
        }
    }

    public function saveData(): bool {
        $query = "INSERT INTO " . $this->tableName . " (user_name, product_name) VALUES (:userName, :prodeuctName)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":userName", $this->userName);
        $stmt->bindParam(":prodeuctName", $this->prodeuctName);
        return $stmt->execute();
    }
    
    

    public function delete($id): bool {
        $query = "DELETE FROM " . $this->tableName . " WHERE order_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function updateO($orderId, $newName, $ProN): bool {
        $sql = "UPDATE " . $this->tableName . " SET user_name = :newName, product_name = :ProN WHERE order_id = :orderId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':newName', $newName);
        $stmt->bindParam(':ProN', $ProN);
        $stmt->bindParam(':orderId', $orderId);
        return $stmt->execute();
    }
}

