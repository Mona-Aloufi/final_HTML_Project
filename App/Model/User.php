<?php
namespace App\Model;
use PDO;

class User{
    private $conn;
    public $name;
    public $email;
    public $id;
    private $tableName='users';
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function callUser():void{
        $query = "SELECT * FROM ".$this->tableName;   
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            echo "ID: " . $user['id'] . "<br>";
            echo "Name: " . $user['name'] . "<br>";
            echo "Email: " . $user['email'] . "<br><br>";
        }
        
    }
    public function saveData():bool{
        $query="INSERT INTO ".$this->tableName." (name,email) VALUES (:name,:email)";
        $stmt=$this->conn->prepare($query);
        $name=htmlspecialchars(strip_tags($this->name));
        $email=htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":email",$email);
        return $stmt->execute();
    }
    public function delete($id):bool{
        $query = "DELETE FROM ".$this->tableName." WHERE id= " .$id;   
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public function updateUserr($userId, $newName, $newEmail):bool {
        $sql = "UPDATE ".$this->tableName." SET name = :newName, email = :newEmail WHERE id = :userId";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':newName', $newName);
            $stmt->bindParam(':newEmail', $newEmail);
            $stmt->bindParam(':userId', $userId);

            return $stmt->execute();
        
    }
}