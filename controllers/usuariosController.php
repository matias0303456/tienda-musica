<?php
require_once 'models/User.php';

class usuariosController{

    public function registro(){
        require_once 'views/users/registro.php';
    }

    public function register(){
        if(isset($_POST)){
            $nick = $_POST['nick'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $register = new User();
            $register->setNick($nick);
            $register->setName($name);
            $register->setSurname($surname);
            $register->setEmail($email);
            $register->setPassword($password);
            $register->setRole($role);
            $result = $register->register();
            if($result){
                $_SESSION['register'] = 'success';
                if(isset($_SESSION['identity']) && $_SESSION['identity']['role'] == 'admin'){
                    header('Location:'.base_url.'usuarios/gestion');
                }else{
                    header('Location:'.base_url.'usuarios/iniciar_sesion');
                }
            }else{
                $_SESSION['register'] = 'fail';
                header('Location:'.base_url.'usuarios/registro');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function iniciar_sesion(){
        require_once 'views/users/iniciar-sesion.php';
    }

    public function login(){
        if(isset($_POST)){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $login = new User();
            $login->setEmail($email);
            $login->setPassword($password);
            $user = $login->login();
            if(!is_null($user)){
                $_SESSION['login'] = 'success';
                $_SESSION['identity'] = $user;
                header('Location:'.base_url);
            }else{
                header('Location:'.base_url.'usuarios/iniciar_sesion');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function cerrar_sesion(){
        Utils::deleteSession('total_carrito');
        Utils::deleteSession('carrito');
        Utils::deleteSession('identity');
        header('Location:'.base_url);
    }

    private function getUser($id){
        $getOne = new User();
        $getOne->setId($id);
        $user = $getOne->getUser();
        return $user;
    }

    public function gestion(){
        $getAll = new User();
        $users = $getAll->getUsers();
        require_once 'views/users/gestion.php';
    }

    public function datos_usuario(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $user = $this->getUser($id);
            require_once 'views/users/datos-usuario.php';
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function update(){
        if(isset($_POST)){
            $id = $_GET['id'];
            $nick = $_POST['nick'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $update = new User();
            $update->setId($id);
            $update->setNick($nick);
            $update->setName($name);
            $update->setSurname($surname);
            $update->setEmail($email);
            $update->setRole($role);

            $result = $update->update();
            if($result){
                $_SESSION['update'] = 'success';
                if($_SESSION['identity']['role'] == 'admin'){
                    header('Location:'.base_url.'usuarios/gestion');
                }else{
                    header('Location:'.base_url);
                }
            }else{
                header('Location:'.base_url.'usuarios/datos_usuario');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function eliminar_cuenta(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = new User();
            $delete->setId($id);
            $delete->delete();
            if($id == $_SESSION['identity']['id']){
                $this->cerrar_sesion();
            }else{
                header('Location:'.base_url.'usuarios/gestion');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }


}