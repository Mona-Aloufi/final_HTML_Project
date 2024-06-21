<?php
require "./vendor/autoload.php";
use App\Controller\ProductController as Product;
use App\Controller\UserController as User;
use App\Controller\OrderController as Order;
use App\Controller\CategoryController as Category;
use App\DataBase\DataBase;


$config=include "./config/DB.php";

$dataBase=new DataBase($config);
$dbb=$dataBase->getConnection();

$userController=new User($dbb);
//echo $userController->createUser("Maha","Amel@gmail.com");
//echo $userController->updateUser(5,"Maha","Maha@gmail.com");
//echo $userController->deleteUsers(4);
//$userController->getUsers();

$productController=new Product($dbb);
//echo $productController->createProduct("learn problem solveing","Education",10);
//echo $productController->updateProduct(5,"learn problem solving","Education",8);
//echo $productController->deleteProduct(4);
//$productController->getProduct();

$orderController=new Order($dbb);
//$orderController->getOrder();
//echo $orderController->createOrder("Amel","Pen");
//echo $orderController->updateOrder(6,"Asma","Pen");
//echo $orderController->deleteOrder(6);

$categoryController=new Category($dbb);
//$categoryController->getCategory();
//echo $categoryController->createCategory("Book",4);
//echo $categoryController->deleteCategory(4);
//echo $categoryController->updateCategory(5,"Stories",3);