<?php

    $connection = new mysqli('localhost','root', '','users_db');
    if($connection ->connect_error){
        die('no DB connected');
    } 

    if(isset($_POST['insert_product'])){

       
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_date = $_POST['expiry_date'];
         
        $image_file = $_FILES['product_image'];
        $tmp_name = $image_file['tmp_name'];
        $image_name = $image_file['name'];

        move_uploaded_file($tmp_name,'storage/products/'.$image_name);
        //    var_dump($_POST);  
        // $query = "INSERT INTO products (product_name,price,expiry_date,image) VALUES('$product_name','$product_price','$product_date','$image_name')";
        $query = "INSERT INTO products (product_name,price,expiry_date,image) VALUES ('$product_name',$product_price,";
        if($product_date){
            $query .=" '$product_date' ";
        }else{
            $query .= "NULL";
        }
        $query .=", '$image_name')";
        // echo $query;

        $connection -> query($query);
        header('location: home.php');
    }
    else if(isset($_POST['update_product'])){
        $id = $_POST['id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_date = $_POST['expiry_date'];

        $image_query = "SELECT image FROM products WHERE id=$id";
        $result = $connection -> query($image_query);
        $product_data = $result ->fetch_assoc();

        $image_name =$product_data['image'];


        if(isset($_FILES['product_image'])){

            unlink('storage/products/'.$image_name);
            $image_file = $_FILES['product_image'];
            $tmp_name = $image_file['tmp_name'];

            $image_name = $image_file['name'];    
            move_uploaded_file($tmp_name,'storage/products/'.$image_name);
        }
        $query = "UPDATE products SET product_name='$product_name',price='$product_price',expiry_date='$product_date',image='$image_name' WHERE id=$id ";
        
        $connection -> query($query);
        header('location:home.php');
    }
    else if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];

        $image_query = "SELECT image FROM products WHERE id= $id";
        $result = $connection -> query($image_query);
        $product_data = $result->fetch_assoc();

        unlink('sotrage/products/'.$product_data['image']);

        $query = "DELETE FROM products WHERE id=$id";
        $connection -> query($query);

        if($connection ->errror){
            echo $connection ->error;
        }else{
            header('location:home.php');
        }
        
    }

?>