<?php

class Category {
    private $id;
    private $name;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function create(){
        $name = $this->getName();
        $sql = "INSERT INTO categories VALUES (NULL, '$name');";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getCategory(){
        $id = $this->getId();
        $sql = "SELECT * FROM categories WHERE id = $id;";
        $category = $this->db->query($sql)->fetch_assoc();
        return $category;
    }

    public function getCategories(){
        $sql = "SELECT * FROM categories ORDER BY name;";
        $categories = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $categories;
    }

    public function update(){
        $id = $this->getId();
        $name = $this->getName();
        $sql = "UPDATE categories SET name = '$name' WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }

    public function delete(){
        $id = $this->getId();
        $sql = "DELETE FROM categories WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }
}