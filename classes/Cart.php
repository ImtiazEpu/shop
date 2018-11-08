<?php 
	
	$filepath = realpath(dirname(__FILE__));
	
	include_once ($filepath."/../lib/Database.php"); 
	include_once ($filepath."/../helpers/Formate.php");
?>

<?php 
	
	class Cart{
	    private $db;
		private $fm;

	    public function __construct(){

	        $this->db = new Database();
	        $this->fm = new Formate();

	    }/*End Construct Method */
	}

 ?>