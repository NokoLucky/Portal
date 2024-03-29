<?php 
class General{

	public function logged_in() {
		return(isset($_SESSION['id'])) ? true : false;
	}

	public function logged_in_protect() {
		if ($this->logged_in() === true) {
			header('Location: manage.php');
			exit();		
		}
	}
	 
	public function logged_out_protect() {
		if ($this->logged_in() === false) {
			header('Location: index.php');
			exit();
		}	
	}
	
}