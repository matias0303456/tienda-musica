<?php
require_once 'models/Product.php';
require_once 'models/Order.php';

class comprasController{

    public function confirmacion(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $getOne = new Product();
            $getOne->setId($id);
            $product = $getOne->getProduct();
            require_once 'views/buys/confirmacion.php';
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function generate(){
        if(isset($_POST)){
            $user_id = $_SESSION['identity']['id'];
            $product_id = $_POST['product_id'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];
            $total = $price*$amount;
            $destination = $_POST['destination'];
            $contact = $_POST['contact'];
            $status = $_POST['status'];
            $order = new Order();
            $order->setUser_id($user_id);
            $order->setProduct_id($product_id);
            $order->setAmount($amount);
            $order->setTotal($total);
            $order->setDestination($destination);
            $order->setContact($contact);
            $order->setStatus($status);
            $result = $order->create();
            if($result){
                header('Location:'.base_url.'compras/payment');
            }else{
                $_SESSION['confirm'] = 'fail';
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function payment(){
        $getOne = new Order();
        $user_id = $_SESSION['identity']['id'];
        $getOne->setUser_id($user_id);
        $order_data = $getOne->getOrderByUser();
        require_once 'views/buys/payment.php';
    }

    public function gestion_de_ordenes(){
        $getAll = new Order();
        $orders = $getAll->getOrders();
        require_once 'views/buys/gestion-de-ordenes.php';
    }

    public function borrar_orden(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = new Order();
            $delete->setId($id);
            $result = $delete->delete();

            if($result){
                $_SESSION['delete'] = 'success';
            }else{
                $_SESSION['delete'] = 'fail';
            }
            header('Location:'.base_url.'compras/gestion_de_ordenes');
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function gracias(){
        require_once 'views/buys/thankyou.php';
    }


}