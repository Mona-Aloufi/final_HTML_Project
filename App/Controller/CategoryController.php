<?php
namespace App\Controller;
use App\Model\Category;
class CategoryController{
    private $conn;
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function getCategory(){

        $categoryModel=new Category($this->conn);
        return $categoryModel->callCategory();
       
    }
    public function createCategory($Name,$numberOfProduct):string{
        $category=new Category($this->conn);
        $category->name=$Name;
        $category->number_of_product=$numberOfProduct;
        if($category->saveData()){
            return "Category add<br>";
        }else{
            return "Category not add<br>";
        }
    }
    public function deleteCategory($id):string{
        $category=new Category($this->conn);
        if($category->delete($id)){
            return "Category Deleted<br>";
        }else{
            return "Category not Deleted<br>";
        }
    }
    
    public function updateCategory($id,$user_name,$product_name):string{
        $category=new Category($this->conn);
        if($category->updateC($id,$user_name,$product_name)){
            return "Category updated successfully<br>";
        }else{
            return "Category updating user<br>";
        }
    }
}