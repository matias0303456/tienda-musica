<?php

class Product{

    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getCategory_id(){
        return $this->category_id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setCategory_id($category_id){
        $this->category_id = $category_id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    public function create(){
        $category_id = $this->getCategory_id();
        $name = $this->getName();
        $description = $this->getDescription();
        $price = $this->getPrice();
        $stock = $this->getStock();

        $sql = "INSERT INTO products VALUES (NULL, '$category_id', '$name', '$description', $price, $stock, CURRENT_TIMESTAMP());";
        $create = $this->db->query($sql);

        return $create;
    }

    public function getProduct(){
        $id = $this->getId();
        $sql = "SELECT *, p.id, p.name, c.name AS 'category' 
                FROM products p, categories c 
                WHERE p.id = $id AND p.category_id = c.id;";
        $product = $this->db->query($sql)->fetch_assoc();
        return $product;
    }

    public function getProducts(){
        $sql = "SELECT *, p.id, p.name, c.name AS 'category' 
                FROM products p, categories c 
                WHERE p.category_id = c.id ORDER BY updated_at;";
        $products = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $products;
    }

    public function getProductsByCategory(){
        $category_id = $this->getCategory_id();
        $sql = "SELECT * FROM products WHERE category_id = $category_id;";
        $products = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $products;
    }

    public function update(){
        $id = $this->getId();
        $category_id = $this->getCategory_id();
        $name = $this->getName();
        $description = $this->getDescription();
        $price = $this->getPrice();
        $stock = $this->getStock();
        $sql = "UPDATE products SET category_id = $category_id, name = '$name', description = '$description',
                price = $price, stock = $stock, updated_at = CURRENT_TIMESTAMP() 
                WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }

    public function delete(){
        $id = $this->getId();
        $sql = "DELETE FROM products WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }
}