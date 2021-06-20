<?php
require_once 'models/Cart.php';
require_once 'models/Product.php';

class carritoController{

    public function mi_carrito(){
        require_once 'views/cart/mi-carrito.php';
    }

    public function add(){
        $product_id = $_GET['id'];
        $get_product = new Product();
        $get_product->setId($product_id);
        $product = $get_product->getProduct();

        $_SESSION['carrito'][] = array(
            'product_id' => $product['id'],
            'product_name' => $product['name'],
            'price' => $product['price'],
            'amount' => 1,
            'product' => $product
        );

        foreach($_SESSION['carrito'] as $index => $element){
            if($product_id == $element['product_id']){
                $element['amount']++;
            }else{
                $element['amount'] = 1;
                $element['total'] = $element['amount']*$element['price'];
            }
        }

        if(!isset($_SESSION['total_carrito'])){
            $_SESSION['total_carrito'] = $element['price'];
        }else{
            $_SESSION['total_carrito'] = $_SESSION['total_carrito']+$element['price'];
        }

        $_SESSION['add_carrito'] = 'success';

        header('Location:'.base_url.'productos/producto&id='.$product_id);

    }

    public function eliminar(){
        $product_id = $_GET['id'];
        foreach($_SESSION['carrito'] as $index => $element){
            if($product_id == $element['product_id']){
                unset($_SESSION['carrito'][$index]);
                $_SESSION['total_carrito'] = $_SESSION['total_carrito'] - $element['total'];
                if(empty($_SESSION['carrito'])){
                    unset($_SESSION['total_carrito']);
                }
            }
        }
        header('Location:'.base_url.'carrito/mi_carrito');
    }


}