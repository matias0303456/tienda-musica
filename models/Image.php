<?php

class Image{

    private $id;
    private $product_id;
    private $path;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getProduct_id(){
        return $this->product_id;
    }

    public function getPath(){
        return $this->path;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setProduct_id($product_id){
        $this->product_id = $product_id;
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function save(){
        $product_id = $this->getProduct_id();
        $path = $this->getPath();
        $sql = "INSERT INTO images VALUES (NULL, $product_id, '$path');";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getImage(){
        $id = $this->getId();
        $sql = "SELECT * FROM images WHERE id = $id;";
        $result = $this->db->query($sql)->fetch_assoc();
        return $result;
    }

    public function getImages(){
        $sql = "SELECT * FROM images;";
        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getImagesByProduct(){
        $product_id = $this->getProduct_id();
        $sql = "SELECT * FROM images WHERE product_id = $product_id;";
        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function delete(){
        $id = $this->getId();
        $sql = "DELETE FROM images WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }


}