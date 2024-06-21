<?php
namespace App\Controller;
use App\Model\Order;
class OrderController{
    private $conn;
    public function __construct($conn){
        $this->conn=$conn;
    }
    public function getOrder(){
        $orderModel=new Order($this->conn);
        return $orderModel->callOrder();
    }
    public function createOrder($userName,$productName):string{
        $order=new Order($this->conn);
        $order->userName=$userName;
        $order->prodeuctName=$productName;
        if($order->saveData()){
            return "Order add<br>";
        }else{
            return "Order not add<br>";
        }
    }
    public function deleteOrder($id):string{
        $order=new Order($this->conn);
        if($order->delete($id)){
            return "Order Deleted<br>";
        }else{
            return "Order not Deleted<br>";
        }
    }
    
    public function updateOrder($id,$user_name,$product_name):string{
        $order=new Order($this->conn);
        if($order->updateO($id,$user_name,$product_name)){
            return "Order updated successfully<br>";
        }else{
            return "Order updating user<br>";
        }
    }
}