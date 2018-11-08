<?php 
	
	include_once "../lib/Database.php"; 
	include_once "../helpers/Formate.php"; 
?>

<?php 

/* Product Class
=======================*/
	
	class Product{
	   
	    	private $db;
			private $fm;

	    	public function __construct(){

		        $this->db = new Database();
		        $this->fm = new Formate();

		    }/*End Construct Method */


		    /* Add Product
		    =======================*/

		    public function addProduct($data,$file) {

		    	$productName   = $this->fm->validation($data['productName']);
		    	$catId  	   = $this->fm->validation($data['catId']);
		    	$brandId  	   = $this->fm->validation($data['brandId']);
		    	$productBody   = $this->fm->validation($data['productBody']);
		    	$productPrice  = $this->fm->validation($data['productPrice']);
		    	$productType   = $this->fm->validation($data['productType']);

		    	$productName   = mysqli_real_escape_string($this->db->link,$productName);
		    	$catId         = mysqli_real_escape_string($this->db->link,$catId);
		    	$brandId       = mysqli_real_escape_string($this->db->link,$brandId);
		    	$productBody   = mysqli_real_escape_string($this->db->link,$productBody);
		    	$productPrice  = mysqli_real_escape_string($this->db->link,$productPrice);
		    	$productType   = mysqli_real_escape_string($this->db->link,$productType);

		    	$permited = array('jpg','jpeg','png','gif');
			    $file_name = $file['productImage']['name'];
			    $file_size = $file['productImage']['size'];
			    $file_temp = $file['productImage']['tmp_name'];

			    $div = explode('.', $file_name);
			    $file_ext = strtolower(end($div));
			    $unique_name = substr(md5(time()), 0,10).'.'.$file_ext;
			    $uploded_image = "upload/". $unique_name;

			    	if ($productName == "" || $productBody == "" || $productPrice == "") {
			    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
		    			return $emperrmsg;

		    		}elseif ($catId == "") {
					      $emperrmsg = "<span class='error'>You must select at least one Category item !!</span>";
					      return $emperrmsg;

					}elseif ($brandId == "") {
					      $emperrmsg = "<span class='error'>You must select at least one Brand item !!</span>";
					      return $emperrmsg;

					}elseif ($productType == "") {
					      $emperrmsg = "<span class='error'>You must select at least one Product Type !!</span>";
					      return $emperrmsg;      

					}elseif (empty($file_name)) {
					      $emperrmsg = "<span class='error'>Please select an image !!</span>";
					      return $emperrmsg;

					}elseif ($file_size>2097152) {
					      $emperrmsg = "<span class='error'>Maximum image size 2MB !!</span>";
					      return $emperrmsg;

				    }elseif (in_array($file_ext, $permited)===false) {
				      $emperrmsg = "<span class='error'>You can only upload : ".implode(', ', $permited)."</span>";
				      return $emperrmsg;

						}else {


			    			move_uploaded_file($file_temp, $uploded_image);
				    		$query  = "INSERT INTO  tbl_product(productName,catId,brandId,productBody,productPrice,productImage,productType) VALUES('$productName','$catId','$brandId','$productBody','$productPrice','$uploded_image','$productType')";
				    		$result = $this->db->insert($query);
				    		if ($result) {
				    			$successmsg = "<span class='successs'>Product Added Successfully !!</span>";
			    				return $successmsg;
				    		}else {
				    			$errormsg = "<span class='error'>Something went wrong !!</span>";
			    				return $errormsg;
				    		}
						}

		    }/*End Product Add Method */



		    /* Show Product list
		    =======================*/

		    public function getAllProduct(){
		    	$query = "SELECT p.*, c.catName, b.brandName
						  FROM tbl_product as p, tbl_category as c, tbl_brand as b
						  WHERE p.catId = c.catId AND p.brandId = b.brandId
						  ORDER BY p.productId DESC
		    			 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    	
		    }/*End Product Show Method */




		     /* Get Product
		    =======================*/

		    public function getProductById($proeditid){
		    	$proeditid  = mysqli_real_escape_string($this->db->link,$proeditid);
		    	$query  = "SELECT * FROM tbl_product WHERE productId = '$proeditid' ";
		    	$result = $this->db->select($query);
		    	return $result;

		    }/*End Product Get Method */




		    /* Update Product
		    =======================*/

		    public function updateProduct($data,$file,$proeditid) {

		    	$productName   = $this->fm->validation($data['productName']);
		    	$catId  	   = $this->fm->validation($data['catId']);
		    	$brandId  	   = $this->fm->validation($data['brandId']);
		    	$productBody   = $this->fm->validation($data['productBody']);
		    	$productPrice  = $this->fm->validation($data['productPrice']);
		    	$productType   = $this->fm->validation($data['productType']);

		    	$productName   = mysqli_real_escape_string($this->db->link,$productName);
		    	$catId         = mysqli_real_escape_string($this->db->link,$catId);
		    	$brandId       = mysqli_real_escape_string($this->db->link,$brandId);
		    	$productBody   = mysqli_real_escape_string($this->db->link,$productBody);
		    	$productPrice  = mysqli_real_escape_string($this->db->link,$productPrice);
		    	$productType   = mysqli_real_escape_string($this->db->link,$productType);

		    	$permited = array('jpg','jpeg','png','gif');
			    $file_name = $file['productImage']['name'];
			    $file_size = $file['productImage']['size'];
			    $file_temp = $file['productImage']['tmp_name'];

			    $div = explode('.', $file_name);
			    $file_ext = strtolower(end($div));
			    $unique_name = substr(md5(time()), 0,10).'.'.$file_ext;
			    $uploded_image = "upload/". $unique_name;

			    	if ($productName == "" || $productBody == "" || $productPrice == "") {
			    		$emperrmsg = "<span class='error'>Filed must not be empty !!</span>";
		    			return $emperrmsg;

		    		}elseif ($catId == "") {
					      $emperrmsg = "<span class='error'>You must select at least one Category item !!</span>";
					      return $emperrmsg;

					}elseif ($brandId == "") {
					      $emperrmsg = "<span class='error'>You must select at least one Brand item !!</span>";
					      return $emperrmsg;

					}elseif ($productType == "") {
					      $emperrmsg = "<span class='error'>You must select at least one Product Type !!</span>";
					      return $emperrmsg;      

					}else{/*Query Start */
						if (!empty($file_name)) {  /*Update Query with image */
								
								if ($file_size>2097152) {
								      $emperrmsg = "<span class='error'>Maximum image size 2MB !!</span>";
								      return $emperrmsg;

							    }elseif (in_array($file_ext, $permited)===false) {
							      $emperrmsg = "<span class='error'>You can only upload : ".implode(', ', $permited)."</span>";
							      return $emperrmsg;

								}else {


					    			move_uploaded_file($file_temp, $uploded_image);

						    		$query = "UPDATE tbl_product 
											 SET
											 productName     = '$productName',
											 catId           = '$catId',
											 brandId         = '$brandId',
											 productBody     = '$productBody',
											 productPrice    = '$productPrice',
											 productImage    = '$uploded_image',
											 productType     = '$productType'
											 WHERE productId = '$proeditid'";
						    		$result = $this->db->update($query);
						    		if ($result) {
						    			$successmsg = "<span class='successs'>Product Updated Successfully !!</span>";
					    				return $successmsg;
						    		}else {
						    			$errormsg = "<span class='error'>Something went wrong !!</span>";
					    				return $errormsg;
						    		}
								}
						}/*End Update Query with image */

						else {/*Update Query Without image */

							$query = "UPDATE tbl_product 
											 SET
											 productName     = '$productName',
											 catId           = '$catId',
											 brandId         = '$brandId',
											 productBody     = '$productBody',
											 productPrice    = '$productPrice',
											 productType     = '$productType'
											 WHERE productId = '$proeditid'";
						    		$result = $this->db->update($query);
						    		if ($result) {
						    			$successmsg = "<span class='successs'>Product Updated Successfully !!</span>";
					    				return $successmsg;
						    		}else {
						    			$errormsg = "<span class='error'>Something went wrong !!</span>";
					    				return $errormsg;
						    		}
						}/*End Update Query Without image */
					}/*Query End */
			}/*End Product Update Method */






	}/*End Product Class */
 ?>