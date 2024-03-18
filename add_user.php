<?php
require 'core/init.php';
$general->logged_out_protect(); 

$name = $surname = $language = $mobile_no = $email = $dob = $id_no = '';


if (isset($_POST['submit']))  
{
  $exist = $users->user_exists($_POST['id_no']); //check if id number exists in the database

  if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['id_no']) || empty($_POST['mobile_no']) || empty($_POST['email']) || empty($_POST['dob'])
  || empty($_POST['language'])  || empty($_POST['interests'])){
    
    //reset the values before showing erros
    $name      = trim($_POST['name']);
    $surname   = trim($_POST['surname']);
    $language  = trim($_POST['language']);
    $mobile_no = trim($_POST['mobile_no']);
    $email     = trim($_POST['email']);
    $dob       = trim($_POST['dob']);
    $id_no     = trim($_POST['id_no']);

    $errors[] = 'Please fill all fields';

  }

  elseif ($exist == 1){
    
    //reset the values before showing erros
    $name      = trim($_POST['name']);
    $surname   = trim($_POST['surname']);
    $language  = trim($_POST['language']);
    $mobile_no = trim($_POST['mobile_no']);
    $email     = trim($_POST['email']);
    $dob       = trim($_POST['dob']);
    $id_no     = trim($_POST['id_no']);

    $errors[] = 'User already exists.';
    
  }

  elseif (preg_match('/[^A-Za-z ]+/', $_POST['name'])
  || preg_match('/[^A-Za-z ]+/', $_POST['surname'])
  || preg_match('/[^A-Za-z ]+/', $_POST['language'])
  || preg_match('/[^0-9+\(\)-]/', $_POST['id_no'])
  || preg_match('/[^0-9+\(\)-]/', $_POST['mobile_no'])) {

    //reset the values before showing erros
    $name      = trim($_POST['name']);
    $surname   = trim($_POST['surname']);
    $language  = trim($_POST['language']);
    $mobile_no = trim($_POST['mobile_no']);
    $email     = trim($_POST['email']);
    $dob       = trim($_POST['dob']);
    $id_no     = trim($_POST['id_no']);
   
    $errors[] = 'Invalid input';

  } else {
  
    $fullcontact = $_POST['dial_code'] . $_POST['mobile_no'];
    $interests = serialize($_POST['interests']);

    $adduser = $users->add_user( $_POST['name'],$_POST['surname'], $_POST['language'], $fullcontact, $_POST['email'], $_POST['dob'], $_POST['id_no'], $interests);
    header("Location: send_mail.php?email=". $_POST['email']); //go to send email page and perfom mail funtion
    exit();
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
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Add User</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container">
      <header class="header black-bg">
            <a href="#" class="logo"><b>Admin Dashboard</b></a>
      </header>
      
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i>Add User</h3>
             	
				<div class="row">
                  <div class="col-md-10">
                      <div class="content-panel">
                        <form autocomplete="off" class="form-horizontal style-form" role="form" name="adduser" action="" method="POST">

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Surname</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="surname" value="<?php echo $surname; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">ID Number</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="id_no" maxlength="13" value="<?php echo $id_no; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Mobile Number</label>
                              <div class="col-sm-2">
                               <input readonly type="text" id="dial_code" class="form-control" name="dial_code" value="+27">
                              </div>

                              <div class="col-sm-8">
                                <input id="cellphone" type="text" class="form-control" name="mobile_no" maxlength="9" value="<?php echo $mobile_no; ?>">
                              </div>
                          </div>

                         <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Birth Date</label>
                              <div class="col-sm-10">
                                <input type="date"  name="dob" class="form-control" max="<?php echo date('Y-m-d');?>" id="dob" value="<?php echo $dob; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Language</label>
                              <div class="col-sm-10">
                              <select class="form-control" name="language" id="language" onChange="getValue()">
                              <option value=""></option>
                                <option value="Afrikaans">Afrikaans</option>
                                <option value="English">English</option>
                                <option value="Ndebele">Ndebele</option>
                                <option value="Sepedi">Sepedi</option>
                                <option value="Sesotho">Sesotho</option>
                                <option value="Swati">Swati</option>
                                <option value="Tsonga">Tsonga</option>
                                <option value="Tswana">Tswana</option>
                                <option value="Venda">Venda</option>
                                <option value="Xhosa">Xhosa</option>
                                <option value="Zulu">Zulu</option>
                              </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Interests</label>
                              <div class="col-sm-10">
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Writing"> <span>Writing</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Traveling"> <span>Traveling</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Blogging"> <span>Blogging</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Reading"> <span>Reading</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Sports"> <span>Sports</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Art"> <span>Art</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Dance"> <span>Dance</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Yoga"> <span>Yoga</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Making Music"> <span>Making Music</span></label>
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" value="Video Games"> <span>Video Games</span></label>
                              </div>
                          </div>
                          
                          <div style="margin-left:100px;">
                            <input type="submit" name="submit" value="Submit" class="btn btn-theme">
                            <button type="button" onclick="location.href='manage.php';" class="btn btn-theme">Back </button>
                          </div>

                          <?php 
                            if(empty($errors) === false){
                            echo '<p style="color:red;text-align:center;font-size:1.875em;">' . implode('</p><p style="color:red">', $errors) . '</p>';  
                            }
                          ?>
                        </form>
                      </div>
                  </div>
              </div>
		</section>

      </section></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
  </body>
</html>
