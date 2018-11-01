<?php 
	include "../lib/Session.php"; 
	Session::checklogin();

	include_once "../lib/Database.php"; 
	include_once "../helpers/Formate.php"; 
?>

<?php 

	
	class Adminlogin{
		private $db;
		private $fm;

	    
	    public function __construct(){
	        $this->db = new Database();
	        $this->fm = new Formate();
	    }

	    public function adminLogin($admin_user, $admin_password){

	    	$admin_user     = $this->fm->validation($admin_user);
	    	$admin_password = $this->fm->validation($admin_password);

	    	$admin_user     	= mysqli_real_escape_string($this->db->link,$admin_user);
	    	$admin_password     = mysqli_real_escape_string($this->db->link,$admin_password);

	    	if (empty($admin_user) || empty($admin_password)) {
	    		$loginmsg = "<span class='error'>Filed must not be empty !!</span>";
	    		return $loginmsg;
	    	}else {

	    		$query = "SELECT * FROM tbl_admin WHERE admin_user = '$admin_user' AND admin_password = '$admin_password' ";
	    		$result = $this->db->select($query);
	    		if ($result != false) {
	    			$value = $result->fetch_assoc();
	    			Session::set("adminlogin", true);
	    			Session::set("adminId", $value['admin_id']);
	    			Session::set("adminUser", $value['admin_user']);
	    			Session::set("adminName", $value['admin_name']);
	    			echo "<script type='text/javascript'>window.top.location='index.php';</script>";
				}else {
					$loginerrormsg = "<span class='error'>The Username or Password is incorrect !!</span>";
					return $loginerrormsg;
				}
	    		
	    	}


	    }


	}


 ?>