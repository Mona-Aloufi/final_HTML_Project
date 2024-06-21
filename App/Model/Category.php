<?php
namespace App\Model;
use PDO;
class Category{
    private $conn;
    public $name;
    public $number_of_product;
    public $id;
    private $tableName='categories';
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function callCategory(){
        $query = "SELECT * FROM ".$this->tableName;   
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) {
            echo "id: " . $category['id'] . "<br>";
            echo "name: " . $category['name'] . "<br>";
            echo "number_of_product: " . $category['number_of_product'] . "<br><br>";
        }
    }
    public function saveData():bool{
        $query="INSERT INTO ".$this->tableName." (name,number_of_product) VALUES (:name,:number_of_product)";
        $stmt=$this->conn->prepare($query);
        $name=htmlspecialchars(strip_tags($this->name));
        $number_of_product = intval($this->number_of_product);
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":number_of_product",$number_of_product);
        return $stmt->execute();
    }
    public function delete($id):bool{
        $query = "DELETE FROM ".$this->tableName." WHERE id= " .$id;   
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
 
    public function updateC($CategoryID, $newName, $newNumberOfProduct):bool {
        $sql = "UPDATE ".$this->tableName." SET name = :newName, number_of_product = :newNumberOfProduct WHERE id = :CategoryID";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':newName', $newName);
            $stmt->bindParam(':newNumberOfProduct', $newNumberOfProduct);
            $stmt->bindParam(':CategoryID', $CategoryID);

            return $stmt->execute();
    }

}