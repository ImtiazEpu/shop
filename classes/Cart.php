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

			    	$checkQuery = "SELECT *FROM tbl_cart WHERE productId = '$proid' AND sessionId = '$sessionId' ";
			    	$gerProduct = $this->db->select($checkQuery);
			    	if ($gerProduct) {
			    		$warningmsg = "<span class='warning'>Products Already Added To Cart !!</span>";
	    				return $warningmsg;

			    	}elseif ($quantity<=0) {
			    		$warningmsg = "<span class='warning'>Quantity must be 1 or More !!</span>";
			    		return $warningmsg;

			    	}else {
			    		
				    	$query  = "INSERT INTO tbl_cart(sessionId,productId,productName,productPrice,quantity,productImage) VALUES('$sessionId','$proid','$productName','$productPrice','$quantity','$productImage')";
				    	$result = $this->db->insert($query);
				    	if ($result) {
				    		echo "<script type='text/javascript'>window.top.location='cart.php';</script>"; 
				    	}else {
				    		echo "<script type='text/javascript'>window.top.location='404.php';</script>"; 
				    	}
			    	}/*END Add to cart Query*/


			    }/*END Add to cart Method*/





				 /* Product Add to cart
				 =======================*/
				 public function getAddToCart(){
				 	$sessionId = session_id();
				 	$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
				 	$result = $this->db->select($query);
				 	return $result;

			    } /* End Product Add to cart Method*/




				 /* Product Update to cart
				 =======================*/
				 public function updateCart($cartId, $quantity){
				 	$cartId    = $this->fm->validation($cartId);
				 	$quantity    = $this->fm->validation($quantity);
		    		$cartId    = mysqli_real_escape_string($this->db->link,$cartId);
		    		$quantity    = mysqli_real_escape_string($this->db->link,$quantity);
			    		if ($quantity<=0) {
			    			$warningmsg = "<span class='warning'>Product quantity must be 1 or More !!</span>";
		    				return $warningmsg;
			    		}else {
			    			 $query = "UPDATE tbl_cart 
			    				 SET
			    				 quantity = '$quantity' 
			    				 WHERE cartId = '$cartId'";
					    		$result = $this->db->update($query);
					    		if ($result) {
					    			$successmsg = "<span class='successs'>Quantity Update Successfully !!</span>";
				    				return $successmsg;
					    		}else {
					    			$errormsg = "<span class='error'>Something went wrong !!</span>";
				    				return $errormsg;
					    		}
			    		}
					   
				 }/* End Product Update to cart Method*/






		    	/* Delete Cart Product
				 =======================*/

			    public function deleteCartById($delcartid){
			    	$delcartid  = mysqli_real_escape_string($this->db->link,$delcartid);
			    	$query ="DELETE FROM tbl_cart WHERE cartId = '$delcartid' ";
			    	$result = $this->db->delete($query);
			    	if ($result) {
			    			$successmsg = "<span class='successs'>Product Deleted Successfully !!</span>";
			    			return $successmsg;
			    		}else {
			    			$errormsg = "<span class='error'>Something went wrong !!</span>";
		    				return $errormsg;
			    		}

			    }/*End Cart Product Delete Method */

			}/*End Cart Class*/
?>