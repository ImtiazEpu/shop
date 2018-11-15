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
			    		$warningmsg = "<span style='margin-left: 25px;' class='warning'>Products Already Added To Cart !!</span>";
	    				return $warningmsg;

			    	}elseif ($quantity<=0) {
			    		$warningmsg = "<span style='margin-left: 25px;' class='warning'>Quantity must be 1 or More !!</span>";
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
					    			echo "<script type='text/javascript'>window.top.location='cart.php';</script>";
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




			   /* Product to cart
				 =======================*/
				 public function checkCartTable(){
				 	$sessionId = session_id();
				 	$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
				 	$result = $this->db->select($query);
				 	return $result;

			    } /* End Productto cart Method*/




			    /* Delete Customer cart(logout)
				 =======================*/
			    public function delCustomerCart(){
			    	$sessionId = session_id();
			    	$query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId' ";
			    	$result = $this->db->delete($query);
			    	return $result;
			    }/* End Delete Customer cart(logout)*/





			    /* Product order 
				 =======================*/
			    public function orderProduct($cmrId){
			    	$sessionId = session_id();
			    	$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
			    	$getProduct = $this->db->select($query);
			    	if ($getProduct) {
			    		while ($result    = $getProduct->fetch_assoc()) {
			    		    $productId    = $result['productId'];
			    		    $productName  = $result['productName'];
			    		    $quantity     = $result['quantity'];
			    		    $productPrice = $result['productPrice'] * $quantity;
			    		    $productImage = $result['productImage'];

			    		    $query  = "INSERT INTO tbl_order(cmrId,productId,productName,quantity,productPrice,productImage) VALUES('$cmrId','$productId','$productName','$quantity','$productPrice','$productImage')";
			    		    $this->db->insert($query);
					    	
			    		}
			    	}
			    	
			    }/* End Product order Method*/




			    /* Payable amount
				 =======================*/
			    public function payableAmount($cmrId){
			    	$query  = "SELECT productPrice FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
				 	$result = $this->db->select($query);
				 	return $result;
			    	
			    }/* End Payable amount*/



			    /* Order details
				 =======================*/
			    public function getOrderDetails($cmrId){
			    	$query  = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
				 	$result = $this->db->select($query);
				 	return $result;
			    	
			    }/* End Order details*/



			    /* Check Order details
				 =======================*/
			    public function checkOrder($cmrId){
			    	$query  = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
				 	$result = $this->db->select($query);
				 	return $result;
			    	
			    }/* End Check Order details*/



			    /* Get Order details in admin panel
				 =======================*/
			    public function getAllOrderProduct(){
			    	$query  = "SELECT * FROM tbl_order ORDER BY date DESC";
				 	$result = $this->db->select($query);
				 	return $result;
			    	
			    }/* End Get Order details in admin panel*/

			    


			    /* Product Shipped update
				 =======================*/
			    public function productShipped($id,$time,$price){
			    	$id    = $this->fm->validation($id);
			    	$time  = $this->fm->validation($time);
			    	$price = $this->fm->validation($price);

		    		$id    = mysqli_real_escape_string($this->db->link,$id);
		    		$time  = mysqli_real_escape_string($this->db->link,$time);
		    		$price = mysqli_real_escape_string($this->db->link,$price);

		    		$query = "UPDATE tbl_order 
			    				 SET
			    				 status = '1' 
			    				 WHERE cmrId = '$id' AND date = '$time' AND productPrice = '$price'";
					    		$result = $this->db->update($query);
					    		if ($result) {
					    			$successmsg = "<span class='successs'>Order Confirm Successfully !!</span>";
			    						return $successmsg;
					    		}else {
					    			$errormsg = "<span class='error'>Something went wrong !!</span>";
				    					return $errormsg;
					    		}
			    	
			    }/* End Product Shipped update*/




			    /* Delete order from admin panel
				 =======================*/
			    public function deletConfirmOrder($id,$time,$price){
			    	$id    = $this->fm->validation($id);
			    	$time  = $this->fm->validation($time);
			    	$price = $this->fm->validation($price);

		    		$id    = mysqli_real_escape_string($this->db->link,$id);
		    		$time  = mysqli_real_escape_string($this->db->link,$time);
		    		$price = mysqli_real_escape_string($this->db->link,$price);

			    	$query = "DELETE FROM tbl_cart WHERE cmrId = '$id' AND date = '$time' AND productPrice = '$price'";
			    	$result = $this->db->delete($query);
			    	if ($result) {
			    		$successmsg = "<span class='successs'>Order Deleted Successfully !!</span>";
			    			return $successmsg;
					}else {
					    $errormsg = "<span class='error'>Something went wrong !!</span>";
				    		return $errormsg;
					    }
			    }/* End  Delete order from admin panel*/





				/* Product Confirm update
				 =======================*/

				public function confirmOrder($id,$time,$price){
			    	$id    = $this->fm->validation($id);
			    	$time  = $this->fm->validation($time);
			    	$price = $this->fm->validation($price);

		    		$id    = mysqli_real_escape_string($this->db->link,$id);
		    		$time  = mysqli_real_escape_string($this->db->link,$time);
		    		$price = mysqli_real_escape_string($this->db->link,$price);

		    		$query = "UPDATE tbl_order 
			    				 SET
			    				 status = '2' 
			    				 WHERE cmrId = '$id' AND date = '$time' AND productPrice = '$price'";
					    		$result = $this->db->update($query);
					    		if ($result) {
					    			$successmsg = "<span class='successs'>Order Confirm Successfully !!</span>";
			    						return $successmsg;
					    		}else {
					    			$errormsg = "<span class='error'>Something went wrong !!</span>";
				    					return $errormsg;
					    		}
			    	
			    }/* End Product Confirm update*/



			    /* Product Received update
				 =======================*/

				public function receivedOrder($id,$time,$price){
			    	$id    = $this->fm->validation($id);
			    	$time  = $this->fm->validation($time);
			    	$price = $this->fm->validation($price);

		    		$id    = mysqli_real_escape_string($this->db->link,$id);
		    		$time  = mysqli_real_escape_string($this->db->link,$time);
		    		$price = mysqli_real_escape_string($this->db->link,$price);

		    		$query = "UPDATE tbl_order 
			    				 SET
			    				 status = '2' 
			    				 WHERE cmrId = '$id' AND date = '$time' AND productPrice = '$price'";
					    		$result = $this->db->update($query);
					    		if ($result) {
					    			$successmsg = "<span class='successs'>Product rececived Successfully !!</span>";
			    						return $successmsg;
					    		}else {
					    			$errormsg = "<span class='error'>Something went wrong !!</span>";
				    					return $errormsg;
					    		}
			    	
			    }/* End Product Received update*/





		} /*End Cart Class*/
?>