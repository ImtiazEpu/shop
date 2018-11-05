<?php 
	
	include_once "../lib/Database.php"; 
	include_once "../helpers/Formate.php"; 
?>




<?php 

		class Category{
		    
		 	private $db;
			private $fm;

	    	public function __construct(){

		        $this->db = new Database();
		        $this->fm = new Formate();

		    }



		    public function addCategory($catName) {

		    	$catName = $this->fm->validation($catName);
		    	$catName  = mysqli_real_escape_string($this->db->link,$catName);

		    	if (empty($catName)) {
		    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
	    			return $emperrmsg;
		    	}else {
		    		$query = "INSERT INTO  tbl_category(catName) VALUES('$catName')";
		    		$result = $this->db->insert($query);
		    		if ($result) {
		    			$successmsg = "<span class='successs'>Category Added Successfully !!</span>";
	    				return $successmsg;
		    		}else {
		    			$errormsg = "<span class='error'>Something went wrong !!</span>";
	    				return $errormsg;
		    		}
				}
		    }




		    public function getALLCategory(){
		    	$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
		    	$result = $this->db->select($query);
		    	return $result;
		    	
		    }




		    public function getCategoryById($cateditid){
		    	$cateditid  = mysqli_real_escape_string($this->db->link,$cateditid);
		    	$query = "SELECT * FROM tbl_category WHERE catId = '$cateditid' ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }





		    public function updateCategory($catName, $cateditid){
		    	$catName = $this->fm->validation($catName);
		    	$catName  = mysqli_real_escape_string($this->db->link,$catName);
		    	$cateditid  = mysqli_real_escape_string($this->db->link,$cateditid);
		    	if (empty($catName)) {
		    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
	    			return $emperrmsg;
		    	}else {
		    		$query = "UPDATE tbl_category 
		    				 SET
		    				 catName = '$catName' 
		    				 WHERE catId = '$cateditid'";
		    		$result = $this->db->update($query);
		    		if ($result) {
		    			$successmsg = "<span class='successs'>Category Update Successfully !!</span>";
	    				return $successmsg;
		    		}else {
		    			$errormsg = "<span class='error'>Something went wrong !!</span>";
	    				return $errormsg;
		    		}
		    	}
		    	
		    }


		    public function deleteCategory($catdelid){
		    	$catdelid  = mysqli_real_escape_string($this->db->link,$catdelid);
		    	$query ="DELETE FROM tbl_category WHERE catId = '$catdelid' ";
		    	$result = $this->db->delete($query);
		    	if ($result) {
		    			$successmsg = "<span class='successs'>Category Delete Successfully !!</span>";
	    				return $successmsg;
		    		}else {
		    			$errormsg = "<span class='error'>Something went wrong !!</span>";
	    				return $errormsg;
		    		}
		    }
		


		}
?>