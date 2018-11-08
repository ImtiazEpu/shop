<?php 
	
	include_once "../lib/Database.php"; 
	include_once "../helpers/Formate.php"; 
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