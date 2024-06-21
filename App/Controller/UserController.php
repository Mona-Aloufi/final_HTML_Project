<?php
namespace App\Controller;
use App\Model\User;
class UserController{
    private $conn;
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function getUsers(){

        $userModel=new User($this->conn);
        return $userModel->callUser();
       
    }
    public function createUser($name,$email):string{
        $user=new User($this->conn);
        $user->name=$name;
        $user->email=$email;
        if($user->saveData()){
            return "User Created<br>";
        }else{
            return "User not Created<br>";
        }
    }
    public function deleteUsers($id):string{
        $user=new User($this->conn);
        if($user->delete($id)){
            return "User Deleted<br>";
        }else{
            return "User not Deleted<br>";
        }
    }
    
    public function updateUser($id,$name,$email):string{
        $user=new User($this->conn);
        if($user->updateUserr($id,$name,$email)){
            return "User updated successfully<br>";
        }else{
            return "Error updating user<br>";
        }
    }
}