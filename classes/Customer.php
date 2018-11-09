<?php 
	
	$filepath = realpath(dirname(__FILE__));
	
	include_once ($filepath."/../lib/Database.php"); 
	include_once ($filepath."/../helpers/Formate.php"); 
?>

<?php 
	
	class Customer{
	    private $db;
		private $fm;

	    public function __construct(){

	        $this->db = new Database();
	        $this->fm = new Formate();

	    }/*End Construct Method */




	    /* Customer Registration Method
		 =============================*/

	    public function customerRegistration($data){
	    	$name      =   $this->fm->validation($data['name']);
	    	$zipcode   =   $this->fm->validation($data['zipcode']);
	    	$city      =   $this->fm->validation($data['city']);
	    	$country   =   $this->fm->validation($data['country']);
	    	$email     =   $this->fm->validation($data['email']);
	    	$phone     =   $this->fm->validation($data['phone']);
	    	$password  =   $this->fm->validation($data['password']);

	    	$name      =   mysqli_real_escape_string($this->db->link,$name);
	    	$address   =   mysqli_real_escape_string($this->db->link,$data['address']);
	    	$zipcode   =   mysqli_real_escape_string($this->db->link,$zipcode);
	    	$city      =   mysqli_real_escape_string($this->db->link,$city);
	    	$country   =   mysqli_real_escape_string($this->db->link,$country);
	    	$email     =   mysqli_real_escape_string($this->db->link,$email);
	    	$phone     =   mysqli_real_escape_string($this->db->link,$phone);
	    	$password  =   mysqli_real_escape_string($this->db->link,$password);

	    	if ($name == "" || $address == "" || $zipcode == "" || $city == "" || $country == "" || $email == "" || $phone == "" || $password == "") {
			    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
		    			return $emperrmsg;
		    }

		    $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1 ";
		    $mailcheck = $this->db->select($mailquery);
		    
		    if ($mailcheck != false) {
		    	$emperrmsg = "<span class='error'>This email address already exist !!</span>";
		    			return $emperrmsg;

		    }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		    	$emperrmsg = "<span class='error'> Please Enter Valid Email !!</span>";
		    			return $emperrmsg;

		    }

		    if (strlen($password) < 7) {
            	$emperrmsg = "<span class='error'>Please choose a password with at least 8 characters.!!</span>";
		    			return $emperrmsg;
            
        	}elseif (!preg_match("#[0-9]+#", $password)) {
            	$emperrmsg = "<span class='error'>Password must contain at lest one numeric!!</span>";
		    			return $emperrmsg;

        	}elseif (!preg_match("#[A-Z]+#", $password)) {
            	$emperrmsg = "<span class='error'>Password must contain at lest one uppercase!!</span>";
		    			return $emperrmsg;

        	}elseif (!preg_match("#[a-z]+#", $password)) {
            	$emperrmsg = "<span class='error'>Password must contain at lest one lowercase !!</span>";
		    			return $emperrmsg;

        	}elseif (!preg_match("#[\W]+#", $password)) {
            	$emperrmsg = "<span class='error'>Password must contain at lest one special characters (@#$%^&+=§!?) !!</span>";
		    			return $emperrmsg;

        	/*}elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]$/', $password)) {
            	$emperrmsg = "<span class='error' style='font-size:11px !important;'>Password must contain at lest one lowercase, one uppercase, one numeric, and @#$%^& !!</span>";
		    			return $emperrmsg;*/

        	}else {
        		$password = md5($password);
        		$query  = "INSERT INTO  tbl_customer(name,address,zipcode,city,country,email,phone,password) VALUES('$name','$address','$zipcode','$city','$country','$email','$phone','$password')";
				    		$result = $this->db->insert($query);
				    		if ($result) {
				    			$successmsg = "<span class='successs'>Thank You. You have been Registerd</span>";
			    				return $successmsg;
				    		}else {
				    			$errormsg = "<span class='error'>Something went wrong !!</span>";
			    				return $errormsg;
				    		}
			}
        }/* End Customer Registration Method*/


	}

 ?>