<?php
require 'core/init.php';

  $user_id = $_GET['ID'];
  $row = $users->get_user($user_id); //retrive user object to populate fileds based on user id.


  if(isset($_POST['submit'])){

    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['id_no']) || empty($_POST['mobile_no']) || empty($_POST['email']) || empty($_POST['dob'])
    || empty($_POST['language'])){

        $errors[] = 'Please fill all fields';
    }

    //ensure correct data is etered.
    elseif (preg_match('/[^A-Za-z ]+/', $_POST['name'])
    || preg_match('/[^A-Za-z ]+/', $_POST['surname'])
    || preg_match('/[^A-Za-z ]+/', $_POST['language'])
    || preg_match('/[^0-9+\(\)-]/', $_POST['id_no'])
    || preg_match('/[^0-9+\(\)-]/', $_POST['mobile_no'])) {
    
        $errors[] = 'Invalid input';

    } else {
  
        $interests = serialize($_POST['interests']);
    
        $update_user = $users->update_user($_POST['name'], $_POST['surname'], $_POST['language'], $_POST['mobile_no'], $_POST['email'], $_POST['dob'], $_POST['id_no'], $interests, $user_id);
        header("Location: manage.php");
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

    <title>Admin | Update User</title>
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
          	<h3><i class="fa fa-angle-right"></i>Update User</h3>
             	
				<div class="row">
                  <div class="col-md-10">
                      <div class="content-panel">
                        <form autocomplete="off" class="form-horizontal style-form" role="form" name="adduser" action="" method="POST">

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['NAME']; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Surname</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="surname" value="<?php echo $row['SURNAME']; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">ID Number</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="id_no" maxlength="13" value="<?php echo $row['ID_NO']; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Mobile Number</label>
                              <div class="col-sm-10">
                                <input id="cellphone" type="text" class="form-control" name="mobile_no" maxlength="12" value="<?php echo $row['MOBILE_NO']; ?>">
                              </div>
                          </div>

                         <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Email</label>
                              <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="<?php echo $row['EMAIL']; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Birth Date</label>
                              <div class="col-sm-10">
                                <input type="date"  name="dob" class="form-control" max="<?php echo date('Y-m-d');?>" id="dob" value="<?php echo $row['DOB']; ?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Language</label>
                              <div class="col-sm-10">
                              <select class="form-control" name="language" id="language" onChange="getValue()">
                              <option value="<?php echo $row['LANGUAGE']; ?>"><?php echo $row['LANGUAGE']; ?></option>
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
                                <label style="margin-right:10px"><input type="checkbox" name="interests[]" <?php echo $checked['Writing']; ?> value="Writing"> <span>Writing</span></label>
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
