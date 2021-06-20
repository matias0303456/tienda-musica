<?php

class Comment{

    private $id;
    private $user_id;
    private $product_id;
    private $content;
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

    public function getContent(){
        return $this->content;
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

    public function setContent($content){
        $this->content = $content;
    }

    public function create(){
        $user_id = $this->getUser_id();
        $product_id = $this->getProduct_id();
        $content = $this->getContent();
        $sql = "INSERT INTO comments VALUES 
                (NULL, $user_id, $product_id, '$content', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP());";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getComment(){
        $id = $this->getId();
        $sql = "SELECT c.id, c.user_id, u.nick AS 'user', c.product_id, c.content, c.updated_at AS 'date'
                FROM comments c, users u WHERE c.id = $id AND c.user_id = u.id;";
        $result = $this->db->query($sql)->fetch_assoc();
        return $result;
    }

    public function getCommentsByProduct(){
        $product_id = $this->getProduct_id();
        $sql = "SELECT c.id, c.user_id, u.nick AS 'user', c.product_id, c.content, c.updated_at AS 'date' 
                FROM comments c, users u WHERE c.product_id = $product_id AND c.user_id = u.id;";
        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function update(){
        $id = $this->getId();
        $content = $this->getContent();
        $sql = "UPDATE comments SET content = '$content', updated_at = CURRENT_TIMESTAMP() WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }

    public function delete(){
        $id = $this->getId();
        $sql = "DELETE FROM comments WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }
}