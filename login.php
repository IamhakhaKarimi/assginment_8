<?php 
    session_start();
    if(isset($_SESSION['authenticated'])){
        header('location:home.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/bootstrap.css">

</head>
<body>
    <div class="row">
         
        <div class="container col-sm-6" >
        <form action="login_controller.php" method="post" class="shadow form-control col-sm-4"  >

            <h4 class="fs-3 display-3">LOGIN</h4><br>
            <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" required  value=" ">
            </div>
            <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="pwd" required class="form-control" >
            </div>
            <input type="submit"  name='login' class="btn btn-primary" value='Login' > <br>
           
        </form>
   </div>
<script src="js/bootstrap.bundle.js">
</script>
</body>
</html>