<?php
require_once 'models/Category.php';

class categoriasController{

    public function lista(){
        $categories = $this->getCategories();
        require_once 'views/categories/lista.php';
    }

    public function gestion(){
        $categories = $this->getCategories();
        require_once 'views/categories/gestion.php';
    }

    public function crear(){
        $categories = $this->getCategories();
        require_once 'views/categories/crear.php';
    }

    public function create(){
        if(isset($_POST)){
            $name = $_POST['name'];
            $create = new Category();
            $create->setName($name);
            $result = $create->create();
            if($result){
                $_SESSION['create'] = 'success';
                header('Location:'.base_url.'categorias/gestion');
            }else{
                $_SESSION['create'] = 'fail';
                header('Location:'.base_url.'categorias/crear');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    private function getCategory($id){
        $getOne = new Category();
        $getOne->setId($id);
        $category = $getOne->getCategory();
        return $category;
    }

    public function getCategories(){
        $getAll = new Category();
        $categories = $getAll->getCategories();
        return $categories;
    }

    public function editar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $category = $this->getCategory($id);
            require_once 'views/categories/editar.php';
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function update(){
        if(isset($_GET['id']) && isset($_POST['name'])){
            $id = $_GET['id'];
            $name = $_POST['name'];
            $edit = new Category();
            $edit->setId($id);
            $edit->setName($name);
            $result = $edit->update();
            if($result){
                $_SESSION['edit'] = 'success';
                header('Location:'.base_url.'categorias/gestion');
            }else{
                $_SESSION['edit'] = 'fail';
                header('Location:'.base_url.'categorias/editar');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function borrar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = new Category();
            $delete->setId($id);
            $result = $delete->delete();

            if($result){
                $_SESSION['delete'] = 'success';
            }else{
                $_SESSION['delete'] = 'fail';
            }
            header('Location:'.base_url.'categorias/gestion');
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }



}