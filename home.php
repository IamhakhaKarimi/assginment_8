<?php 

    session_start();
    if(!isset($_SESSION['authenticated'])){
        header('location:login.php'); 
    }

    $auth = $_SESSION['auth'];
    $connection = new mysqli('localhost','root', '','users_db');
    $query = "SELECT * FROM  products";
    $result= $connection ->query($query);
    $products = $result ->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Register</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
            td img,img {
                width: 50px;
                height: 50px;
            }
    </style>
</head>
<body  >
  
               
        <div class="contianer card card-body ">
        <div class="row ">
       
            <div class=" col-sm-6 table-responsive" >
                <p> welcome, <strong>  <?php echo $auth['uname'] ?> </strong>  </p>
               

                <table class='table table-striped border border-primary table-hover'>
                <legend>Products Query </legend>
                <caption>List of Products</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Expiry Date</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php foreach($products as $product){
                        echo    "<tr>
                                    <td>".$product['id']."</td>
                                    <td>".$product['product_name']."</td>
                                    <td>".$product['price']."</td>
                                    <td>".$product['expiry_date']."</td>
                                    <td>
                                        
                                        <img src='storage/products/{$product['image']}' />
                                    </td>
                                    <td>
                                    <a href='home.php?edit_id={$product['id']}'>Edit</a>
                                    <a href='product_controller.php?delete_id={$product['id']}'>Delete</a>
                                    </td>
                                    
                                </tr>";
                    }
                    
                    ?>    
                    </tr> 
                </tbody>
               </table>
               <?php
                    $edit_product = null;
                    if(isset($_GET['edit_id'])){
                    $id = $_GET['edit_id'];
                    // die('id:'.$id);
                    $product_query = "SELECT * FROM products WHERE id=${id}";
                    // die($select_product_query);
                    $product_result = $connection -> query($product_query);
                    $edit_product = $product_result -> fetch_assoc();
                    // var_dump($edit_product);

                    }
                ?>
            </div>
            <div class=" col-sm-4 ">
                <form action="product_controller.php" method="post" enctype="multipart/form-data" class="form d-flex justify-content-center">
            
                <div class="form-group">
                <h3 class=""> Upload Prodcuts </h3> 
                <input type="hidden" name="id" value="<?php echo ($edit_product) ? $edit_product['id'] : ''; ?> ">
                <label>Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Enter product Name" value="<?php echo ($edit_product) ? $edit_product['product_name'] : ''; ?>" required ><br>

                <label>Price</label>
                <input type="number" class="form-control" name="product_price" placeholder="Enter price" value="<?php echo ($edit_product) ? $edit_product['price'] : '' ?>" required><br>

                <label>Expiry Date</label>
                <input type="date" class="form-control" name="expiry_date" placeholder="Enter Expiry Date" value="<?php echo ($edit_product) ? $edit_product['expiry_date'] : ''; ?>"><br>

                <label>Product Image</label>
                <input type="file" class="form-control" name="product_image" >
                <?php if($edit_product){ ?>
                    <label> 
                    <img src="storage/products/<?php echo $edit_product['image'] ?>">
                <?php  } ?> </label><br>

                <input type="submit" class="form-control btn btn-primary" value="save"   name="<?php echo ($edit_product) ? 'update_product' : 'insert_product'; ?>">
                <label></label>
                <a href="home.php" class=" form-control btn btn-light ">Clear </a>
                
            </div>
               
            </form>
        </div><p class=" ">  <a href="login_controller.php?logout=true" class="btn btn-danger">Logout</a>  </p>
        
        
        </div>
        
    </div>
<script src="js/bootstrap.bundle.js">
</script>

</body>
</html>