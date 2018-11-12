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

		    if (strlen($password) < 8) {
            	$emperrmsg = "<span class='error'>Please choose a password with at least 8 characters.!!</span>";
		    			return $emperrmsg;
            
        	}
        	if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
            	$emperrmsg = "<span class='error'>Password is weak. please choose a stronger password</span>";
		    			return $emperrmsg;

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






        /* Customer Login Method
		 =============================*/
        public function customerLogin($data){
        	$email     =   $this->fm->validation($data['email']);
	    	$password  =   $this->fm->validation($data['password']);

	    	$email     =   mysqli_real_escape_string($this->db->link,$email);
	    	$password  =   mysqli_real_escape_string($this->db->link,$password);

	    	if ($email == "" || $password == "") {
			    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
		    			return $emperrmsg;
		    }

		    $password = md5($password);
		    $logquery = "SELECT * FROM tbl_customer WHERE email = '$email' AND password ='$password'";
		    $logcheck = $this->db->select($logquery);
		    	if ($logcheck != false) {
		    		$result = $logcheck->fetch_assoc();
		    			Session::set("login", true);
						Session::set("cmrName", $result['name']);
						Session::set("cmrId",   $result['cusId']);
						echo "<script type='text/javascript'>window.top.location='order.php';</script>";
				}else {
					$emperrmsg = "<span class='error'>The Username or Password is incorrect !!</span>";
		    				return $emperrmsg;
				}
		    		
        	
        }/* End Customer Login Method*/






        /* Get Customer Data(Profile)
		===============================*/
        public function getCustomerDataByID($id){
        	$query  = "SELECT * FROM tbl_customer WHERE cusId = '$id' ";
				 	$result = $this->db->select($query);
				 	return $result;

        }/* End Get Customer Data(Profile)*/



        /* Update Profile
		    =======================*/

		    public function profileUpdate($data,$cmrId){
		    	$name      =   $this->fm->validation($data['name']);
		    	$zipcode   =   $this->fm->validation($data['zipcode']);
		    	$city      =   $this->fm->validation($data['city']);
		    	$country   =   $this->fm->validation($data['country']);
		    	$email     =   $this->fm->validation($data['email']);
		    	$phone     =   $this->fm->validation($data['phone']);
		    	

		    	$name      =   mysqli_real_escape_string($this->db->link,$name);
		    	$address   =   mysqli_real_escape_string($this->db->link,$data['address']);
		    	$zipcode   =   mysqli_real_escape_string($this->db->link,$zipcode);
		    	$city      =   mysqli_real_escape_string($this->db->link,$city);
		    	$country   =   mysqli_real_escape_string($this->db->link,$country);
		    	$email     =   mysqli_real_escape_string($this->db->link,$email);
		    	$phone     =   mysqli_real_escape_string($this->db->link,$phone);
			    	if ($name == "" || $address == "" || $zipcode == "" || $city == "" || $country == "" || $email == "" || $phone == "") {
				    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
			    			return $emperrmsg;
			    	}
			    	if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				    	$emperrmsg = "<span class='error'> Please Enter Valid Email !!</span>";
				    			return $emperrmsg;
					}
			    	else {
				    		$query = "UPDATE tbl_customer 
				    				 SET
				    				 name    = '$name', 
				    				 address = '$address', 
				    				 zipcode = '$zipcode', 
				    				 city    = '$city', 
				    				 country = '$country', 
				    				 email   = '$email', 
				    				 phone   = '$phone' 
				    				 WHERE cusId = '$cmrId'";
				    		$result = $this->db->update($query);
				    		if ($result) {
				    			$successmsg = "<span class='successs'>Profile Update Successfully !!</span>";
			    				return $successmsg;
				    		}else {
				    			$errormsg = "<span class='error'>Something went wrong !!</span>";
			    				return $errormsg;
				    		}
				    }
		    	
		    }/*End Profile  Update Method */


	}

 ?>