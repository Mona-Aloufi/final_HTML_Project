<?php
namespace App\Model;
use PDO;

class Product{
    private $conn;
    public $name;
    public $type;
    public $amount;
    public $id;
    private $tableName='product';
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function callProducts():void{
        $query = "SELECT * FROM ".$this->tableName;   
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($products as $product) {
            echo "ID: " . $product['id'] . "<br>";
            echo "Name: " . $product['name'] . "<br>";
            echo "type: " . $product['type'] . "<br>";
            echo "amount: " . $product['amount'] . "<br><br>";
        }
        
    }
    public function saveData():bool{
        $query="INSERT INTO ".$this->tableName." (name,type,amount) VALUES (:name,:type,:amount)";
        $stmt=$this->conn->prepare($query);
        $name=htmlspecialchars(strip_tags($this->name));
        $type=htmlspecialchars(strip_tags($this->type));
        $amount = intval($this->amount);
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":type",$type);
        $stmt->bindParam(":amount",$amount);
        return $stmt->execute();
    }
    public function delete($id):bool{
        $query = "DELETE FROM ".$this->tableName." WHERE id= " .$id;   
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public function updateP($productId, $newName, $newType,$newAmount):bool {
        $sql = "UPDATE ".$this->tableName." SET name = :newName, type = :newType, amount = :newAmount WHERE id = :productId";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':newName', $newName);
            $stmt->bindParam(':newType', $newType);
            $stmt->bindParam(':newAmount', $newAmount);
            $stmt->bindParam(':productId', $productId);

            return $stmt->execute();
        
    }
}