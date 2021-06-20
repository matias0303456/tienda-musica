<?php

class Cart{

    private $id;
    private $user_id;
    private $product_id;
    private $amount;
    private $total;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getUser_id(){
        return $this->user_id;
    }

    public function getProduct_id(){
        return $this->product_id;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function getTotal(){
        return $this->total;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }

    public function setAmount($amount){
        $this->mount = $amount;
    }

    public function setTotal($total){
        $this->total = $total;
    }

    public function save(){
        $user_id = $this->getUser_id();
        $product_id = $this->getProduct_id();
        $amount = $this->getAmount();
        $total = $this->getTotal();
        $sql = "INSERT INTO carts VALUES (NULL, $user_id, $product_id, $amount, $total)";
        $result = $this->db->query($sql);
        return $result;
    }

}