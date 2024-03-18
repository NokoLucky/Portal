<?php
require 'core/init.php';
$general->logged_out_protect(); 


$users_obj = $users->get_users();


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin | Manage Users</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

  <section id="container" >
      <header class="header black-bg">
              
            <a class="logo"><b>Admin Dashboard</b></a>
            <div class="nav notify-row" id="top_menu">
               
                         
                   
                </ul>
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
		    <li><a class="logout" href="add_user.php">Add New User</a></li>
                    <li><a class="logout" href="logout.php">LOGOUT</a></li>
            	</ul>
            </div>
        </header>
      

      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Manage Users</h3>
     
                  <div class="col-md-10">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  <h4><i class="fa fa-angle-right"></i> All User Details </h4>
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Surname</th>
                                  <th>ID Number</th>
                                  <th>Mobile Number</th>
                                  <th>Email</th>
                                  <th>Date OF Birth</th>
                                  <th>Language</th>
                                  <th>Interests</th>
                                  <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>

                              <?php foreach ($users_obj as $row) {?>
                              <tr>
                                  <td><?php echo $row['NAME'];?></td>
                                  <td><?php echo $row['SURNAME'];?></td>
                                  <td><?php echo $row['ID_NO'];?></td>
                                  <td><?php echo $row['MOBILE_NO'];?></td>
                                  <td><?php echo $row['EMAIL'];?></td>
                                  <td><?php echo $row['DOB'];?></td>
                                  <td><?php echo $row['LANGUAGE'];?></td>

                                  <td><?php $interests = unserialize($row['INTERESTS']); 
                                    foreach ($interests as $interest) { 
                                      echo htmlspecialchars($interest) . ', ';
                                    } ?></td>
                                      
                                  <td>
                                    <a href="update_user.php?ID=<?php echo $row['ID'];?>"> Edit</a>
                                     |
                                    <a href="delete_user.php?ID=<?php echo $row['ID']?>" style="color:red" onClick="return confirm('Are you sure you want to delete this user?');">Delete</a>  
                                  </td>
                              </tr>
                              <?php }?>
                             
                              </tbody>
                          </table>
                      </div>
                  </div>
		</section>

      </section
  ></section>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
