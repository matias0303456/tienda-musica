<?php

class User{

    private $id;
    private $nick;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $role;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getNick(){
        return $this->nick;
    }

    public function getName(){
        return $this->name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return hash('sha256', $this->password);
    }

    public function getRole(){
        return $this->role;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNick($nick){
        $this->nick = $nick;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function register(){
        $nick = $this->getNick();
        $name = $this->getName();
        $surname = $this->getSurname();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $role = $this->getRole();
        $sql = "INSERT INTO users VALUES (NULL, '$nick', '$name', 
                '$surname', '$email', '$password', '$role');";
        $result = $this->db->query($sql);
        return $result;
    }

    public function login(){
        $email = $this->getEmail();
        $password = $this->getPassword();
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password';";
        $result = $this->db->query($sql)->fetch_assoc();
        return $result;
    }

    public function getUser(){
        $id = $this->getId();
        $sql = "SELECT * FROM users WHERE id = $id;";
        $result = $this->db->query($sql)->fetch_assoc();
        return $result;
    }

    public function getUsers(){
        $sql = "SELECT * FROM users ORDER BY nick;";
        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function update(){
        $id = $this->getId();
        $nick = $this->getNick();
        $name = $this->getName();
        $surname = $this->getSurname();
        $email = $this->getEmail();
        $role = $this->getRole();
        $sql = "UPDATE users SET nick = '$nick', name = '$name', surname = '$surname',
                email = '$email', role = '$role' WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }

    public function delete(){
        $id = $this->getId();
        $sql = "DELETE FROM users WHERE id = $id;";
        $result = $this->db->query($sql);
        return $result;
    }
}