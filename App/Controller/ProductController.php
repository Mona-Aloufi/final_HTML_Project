<?php
namespace App\Controller;
use App\Model\Product;
class ProductController{
    private $conn;
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function getProduct(){

        $proModel=new Product($this->conn);
        return $proModel->callProducts();
       
    }
    public function createProduct($name,$type,$amount):string{
        $pro=new Product($this->conn);
        $pro->name=$name;
        $pro->type=$type;
        $pro->amount=$amount;
        if($pro->saveData()){
            return "Product add<br>";
        }else{
            return "Product not add<br>";
        }
    }
    public function deleteProduct($id):string{
        $pro=new Product($this->conn);
        if($pro->delete($id)){
            return "Product Deleted<br>";
        }else{
            return "Product not Deleted<br>";
        }
    }
    
    public function updateProduct($id,$name,$type,$amount):string{
        $pro=new Product($this->conn);
        if($pro->updateP($id,$name,$type,$amount)){
            return "Product updated successfully<br>";
        }else{
            return "Product updating user<br>";
        }
    }
}