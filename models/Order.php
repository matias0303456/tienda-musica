<?php 

class Order{

    private $id;
    private $user_id;
    private $product_id;
    private $amount;
    private $total;
    private $destination;
    private $contact;
    private $status;
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

    public function getDestination(){
        return $this->destination;
    }

    public function getContact(){
        return $this->contact;
    }

    public function getStatus(){
        return $this->status;
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
        $this->amount = $amount;
    }

    public function setTotal($total){
        $this->total = $total;
    }

    public function setDestination($destination){
        $this->destination = $destination;
    }

    public function setContact($contact){
        $this->contact = $contact;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function create(){
        $user_id = $this->getUser_id();
        $product_id = $this->getProduct_id();
        $amount = $this->getAmount();
        $total = $this->getTotal();
        $destination = $this->getDestination();
        $contact = $this->getContact();
        $status = $this->getStatus();
        $sql = "INSERT INTO orders VALUES (NULL, $user_id, $product_id, $amount, $total, '$destination', '$contact', '$status',
                CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getOrders(){
        $sql = "SELECT o.id, u.email AS 'user', o.destination, o.contact, 
                o.status, o.updated_at FROM orders o, users u WHERE o.user_id = u.id ORDER BY updated_at";
        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getOrderByUser(){
        $user_id = $this->getUser_id();
        $sql = "SELECT o.id AS 'order', o.updated_at, p.name AS 'product', p.price AS 'price', o.amount 
                FROM orders o, products p WHERE o.user_id = $user_id AND o.product_id = p.id
                ORDER BY updated_at DESC LIMIT 1";
        $result = $this->db->query($sql)->fetch_assoc();
        return $result;
    }

    public function getOrdersByUser(){
        $user_id = $this->getUser_id();
        $sql = "SELECT o.id, CONCAT(u.name,' ',u.surname) AS 'user', o.destination, o.contact, o.status, o.updated_at
                FROM orders o, users u WHERE o.user_id = $user_id ORDER BY updated_at";
        $result = $this->db->query($sql)->fetch_assoc();
        return $result;
    }

    public function update(){
        $id = $this->getId();
        $amount = $this->getAmount();
        $total = $this->getTotal();
        $destination = $this->getDestination();
        $contact =$this->getContact();
        $status = $this->getStatus();
        $sql = "UPDATE orders SET amount = $amount, total = $total, destination = '$destination', contact = '$contact', 
                status = '$status', updated_at = CURRENT_TIMESTAMP() WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }

    public function delete(){
        $id = $this->getId();
        $sql = "DELETE FROM orders WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }



}