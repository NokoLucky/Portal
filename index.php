<?php
require 'core/init.php';
$general->logged_in_protect(); 

if (empty($_POST) === false) {

    if(empty($_POST['username']) || empty($_POST['password'])){

        $errors[] = 'We need your username and password.';

    } else {

      $username = trim($_POST['username']);
      $password = trim($_POST['password']);

      $login = $users->admin_login($username, $password);

         if ($login === false) {

            $errors[] = 'Invalid login credentials';

         } else {

            $_SESSION['id'] =  $login;
            header('Location: manage.php');
            exit();
         }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content=" Bootstrap, Admin, Theme, Responsive, Fluid, Retina">

    <title>Admin | Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
      
		    <form autocomplete="off" class="form-login" action="" method="post">
		     <h2 class="form-login-heading">sign in now</h2>
		      <div class="login-wrap">

		        <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
		        <br>
		        <input type="password" name="password" class="form-control" placeholder="Password"><br >
		        <input  name="login" class="btn btn-theme btn-block" type="submit">

                <?php 
                if(empty($errors) === false) //Display error messages
                {
                    echo '<p style="color:red;text-align:center;">' . implode('</p><p style="color:red">', $errors) . '</p>';  
                }
                ?>
		         
		      </div>
		    </form>	  	
	  	
	  	</div>
	  </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
