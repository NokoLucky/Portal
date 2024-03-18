<?php 
require 'core/init.php';
$general->logged_out_protect(); 

$user_id = $_GET['ID'];

$delete = $users->delete_user($user_id);

header('Location:manage.php');

?>