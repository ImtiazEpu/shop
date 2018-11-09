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




	    /* Add to cart
		=======================*/

	    public function addToCart($quantity, $proid){
	    	$quantity  = $this->fm->validation($quantity);
		    $quantity  = mysqli_real_escape_string($this->db->link,$quantity);
		    $proid     = mysqli_real_escape_string($this->db->link,$proid);
		    $sessionId = session_id();


		    $query  = "SELECT *FROM tbl_product WHERE productId = '$proid' ";
	    	$result = $this->db->select($query)->fetch_assoc();

	    	$productName  = $result['productName'];
	    	$productPrice = $result['productPrice'];
	    	$productImage = $result['productImage'];

					    	$query  = "INSERT INTO  
					    	tbl_cart(sessionId,productId,productName,productPrice,quantity,productImage) 
					    	VALUES('$sessionId','$proid','$productName','$productPrice','$quantity','$productImage')";
							$result = $this->db->insert($query);
					    		if ($result) {
					    			echo "<script type='text/javascript'>window.top.location='cart.php';</script>"; 
					    		}else {
					    			echo "<script type='text/javascript'>window.top.location='404.php';</script>"; 
					    		}
		}/*END Add to cart*/


		 /* Product Add to cart
		=======================*/
	    public function getAddToCart(){
	    	$sessionId = session_id();
	    	$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
		    	$result = $this->db->select($query);
		    	return $result;
	    	
	    } /* End Product Add to cart
		=======================*/
	}

 ?>