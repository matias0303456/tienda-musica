<?php
require_once 'models/Category.php';
require_once 'models/Product.php';
require_once 'models/Image.php';
require_once 'models/Comment.php';

class productosController {

    public function lista(){
        $products = $this->getProducts();
        $images = $this->getImages();
        require_once 'views/products/lista.php';
    }

    public function categoria(){
        if(isset($_GET['id'])){
            $category_id = $_GET['id'];
            $get_category = new Category();
            $get_category->setId($category_id);
            $category = $get_category->getCategory();
            $images = $this->getImages();
            $products = $this->getProductsByCategory($category_id);
            require_once 'views/products/products-by-category.php';
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function gestion(){
        $products = $this->getProducts();
        require_once 'views/products/gestion.php';
    }

    public function crear(){
        $getAll = new Category();
        $categories = $getAll->getCategories();
        require_once 'views/products/crear.php';
    }

    public function create(){
        if(isset($_POST)){
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];

            $product = new Product();
            $product->setCategory_id($category_id);
            $product->setName($name);
            $product->setDescription($description);
            $product->setPrice($price);
            $product->setStock($stock);

            $result = $product->create();

            if($result){
                $_SESSION['create'] = 'success';
                header('Location:'.base_url.'productos/gestion');
            }else{
                $_SESSION['create'] = 'fail';
                header('Location:'.base_url.'productos/crear');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function producto(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $images = $this->getImagesByProduct($id);
            $product = $this->getProduct($id);
            $comments = $this->getCommentsByProduct($id);
            require_once 'views/products/producto.php';
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    private function getProduct($id){
        $getOne = new Product();
        $getOne->setId($id);
        $product = $getOne->getProduct();
        return $product;
    }

    public function getProducts(){
        $getAll = new Product();
        $products = $getAll->getProducts();
        return $products;
    }

    private function getProductsByCategory($category_id){
        $getAll = new Product();
        $getAll->setCategory_id($category_id);
        $products = $getAll->getProductsByCategory();
        return $products;
    }

    public function editar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $images = $this->getImagesByProduct($id);
            $product = $this->getProduct($id);
            $getAll = new Category();
            $categories = $getAll->getCategories();
            require_once 'views/products/editar.php';
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function update(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $category_id = $_POST['category'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];

            $edit = new Product();
            $edit->setId($id);
            $edit->setCategory_id($category_id);
            $edit->setName($name);
            $edit->setDescription($description);
            $edit->setPrice($price);
            $edit->setStock($stock);

            if(isset($_FILES) && !empty($_FILES['image']['name'])){
                $this->upload();
            }
            
            $result = $edit->update();

            if($result){
                $_SESSION['edit'] = 'success';
                header('Location:'.base_url.'productos/gestion');
            }else{
                $_SESSION['edit'] = 'fail';
                header('Location:'.base_url.'productos/editar');
            }
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function borrar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = new Product();
            $delete->setId($id);
            $result = $delete->delete();

            if($result){
                $_SESSION['delete'] = 'success';
            }else{
                $_SESSION['delete'] = 'fail';
            }
            header('Location:'.base_url.'productos/gestion');
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function upload(){
        if(isset($_FILES['image']) && count($_FILES['image']['name']) <= 10){
            foreach($_FILES['image']['tmp_name'] as $key => $tmp_name){

                if(strpos($_FILES['image']['name'][$key], '.jpg')){
    
                    $filename = time().$_FILES["image"]["name"][$key];
                    $source = $_FILES["image"]["tmp_name"][$key];
                    
                    $directorio = 'assets/products';
                    
                    $dir = opendir($directorio);
    
                    $target_path = $directorio.'/'.$filename;
    
                    if(move_uploaded_file($source, $target_path)) {
                        $product_id = $_GET['id'];
                        $save_image = new Image();
                        $save_image->setProduct_id($product_id);
                        $save_image->setPath($target_path);
                        $result = $save_image->save();

                        if($result){
                            $_SESSION['upload'] = 'success';
                            header('Location:'.base_url.'productos/gestion');
                        }else{
                            $_SESSION['upload'] = 'fail';
                            header('Location:'.base_url.'productos/editar');
                        }
                    }else{
                        $_SESSION['upload'] = 'fail';
                        header('Location:'.base_url.'productos/editar');
                    }
                    closedir($dir);
                }else{
                    $_SESSION['upload'] = 'fail';
                    header('Location:'.base_url.'reportes/editar');
                }
            }
        }
    }

    private function getImages(){
        $getAll = new Image();
        $images = $getAll->getImages();
        return $images;
    }

    private function getImagesByProduct($product_id){
        $getAll = new Image();
        $getAll->setProduct_id($product_id);
        $images = $getAll->getImagesByProduct();
        return $images;
    }

    public function borrar_imagen(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $delete = new Image();
            $delete->setId($id);
            $image = $delete->getImage();
            unlink($image['path']);
            $result = $delete->delete();
            if($result){
                $_SESSION['delete'] = 'success';
            }else{
                $_SESSION['delete'] = 'fail';
            }
            header('Location:'.base_url.'productos/editar&id='.$image['product_id']);
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function comment(){
        if(isset($_POST)){
            $user_id = $_SESSION['identity']['id'];
            $product_id = $_POST['product_id'];
            $content = $_POST['content'];
            $comment = new Comment();
            $comment->setUser_id($user_id);
            $comment->setProduct_id($product_id);
            $comment->setContent($content);
            $result = $comment->create();
            if(!$result){
                $_SESSION['comment'] = 'fail';
            }
            header('Location:'.base_url.'productos/producto&id='.$product_id);
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

    public function getCommentsByProduct($product_id){
        $getAll = new Comment();
        $getAll->setProduct_id($product_id);
        $comments  = $getAll->getCommentsByProduct();
        return $comments;
    }

    public function borrar_comentario(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $getOne = new Comment();
            $getOne->setId($id);
            $comment = $getOne->getComment();
            $delete = $getOne->delete();
            if($delete){
                $_SESSION['delete'] = 'success';
            }else{
                $_SESSION['delete'] = 'fail';
            }
            header('Location:'.base_url.'productos/producto&id='.$comment['product_id']);
        }else{
            header('Location:'.base_url.'error/no_encontrado');
        }
    }

}