<?php 
	
	include_once "../lib/Database.php"; 
	include_once "../helpers/Formate.php"; 
?>

<?php 

/* Brand Class
=======================*/

		class Brand{
		  
		    	private $db;
				private $fm;

		    	public function __construct(){

			        $this->db = new Database();
			        $this->fm = new Formate();

			    }/*End Construct Method */



			    /* Add Brand
			    =======================*/

			    public function addBrand($brandName){
			    	$brandName  = $this->fm->validation($brandName);
			    	$brandName  = mysqli_real_escape_string($this->db->link,$brandName);

			    	if (empty($brandName)) {
			    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
		    			return $emperrmsg;
			    	}else {
			    		$query  = "INSERT INTO  tbl_brand(brandName) VALUES('$brandName')";
			    		$result = $this->db->insert($query);
			    		if ($result) {
			    			$successmsg = "<span class='successs'>Brand Added Successfully !!</span>";
		    				return $successmsg;
			    		}else {
			    			$errormsg = "<span class='error'>Something went wrong !!</span>";
		    				return $errormsg;
			    		}
					}
			    }/*End Brand Add Method */




			    /* Show Brand List
			    =======================*/

			    public function getALLBrand(){
			    	$query  = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
			    	$result = $this->db->select($query);
			    	return $result;
			    	
			    }/*End Brand Show Method */





			    /* Get Brand
			    =======================*/

			    public function getBrandById($brandeditid){
			    	$brandeditid  = mysqli_real_escape_string($this->db->link,$brandeditid);
			    	$query  = "SELECT * FROM tbl_brand WHERE brandId = '$brandeditid' ";
			    	$result = $this->db->select($query);
			    	return $result;

			    }/*End Brand Get Method */





			    /* Update Brand
			    =======================*/

			     public function updateBrand($brandName, $brandeditid){
			    	$brandName    = $this->fm->validation($brandName);
			    	$brandName    = mysqli_real_escape_string($this->db->link,$brandName);
			    	$brandeditid  = mysqli_real_escape_string($this->db->link,$brandeditid);
			    	if (empty($brandName)) {
			    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
		    			return $emperrmsg;
			    	}else {
			    		$query = "UPDATE tbl_brand 
			    				 SET
			    				 brandName = '$brandName' 
			    				 WHERE brandId = '$brandeditid'";
			    		$result = $this->db->update($query);
			    		if ($result) {
			    			$successmsg = "<span class='successs'>Brand Update Successfully !!</span>";
		    				return $successmsg;
			    		}else {
			    			$errormsg = "<span class='error'>Something went wrong !!</span>";
		    				return $errormsg;
			    		}
			    	}
			    }/*End Brand Update Method */
			    




			    /* Delete Brand
			    =======================*/

			    public function deleteBrand($branddelid){
			    	$branddelid  = mysqli_real_escape_string($this->db->link,$branddelid);
			    	$query ="DELETE FROM tbl_brand WHERE brandId = '$branddelid' ";
			    	$result = $this->db->delete($query);
			    	if ($result) {
			    			$successmsg = "<span class='successs'>Brand Deleted Successfully !!</span>";
		    				return $successmsg;
			    		}else {
			    			$errormsg = "<span class='error'>Something went wrong !!</span>";
		    				return $errormsg;
			    		}
			    }/*End Brand Delete Method */

		}/*End Brand Class */

 ?>