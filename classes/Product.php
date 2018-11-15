<?php 

$filepath = realpath(dirname(__FILE__));
	
	include_once ($filepath."/../lib/Database.php"); 
	include_once ($filepath."/../helpers/Formate.php"); 
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
		    	$productPrice  = $this->fm->validation($data['productPrice']);
		    	$productType   = $this->fm->validation($data['productType']);

		    	$productName   = mysqli_real_escape_string($this->db->link,$productName);
		    	$catId         = mysqli_real_escape_string($this->db->link,$catId);
		    	$brandId       = mysqli_real_escape_string($this->db->link,$brandId);
		    	$productBody   = mysqli_real_escape_string($this->db->link,$data['productBody']);
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
		    	$productPrice  = $this->fm->validation($data['productPrice']);
		    	$productType   = $this->fm->validation($data['productType']);

		    	$productName   = mysqli_real_escape_string($this->db->link,$productName);
		    	$catId         = mysqli_real_escape_string($this->db->link,$catId);
		    	$brandId       = mysqli_real_escape_string($this->db->link,$brandId);
		    	$productBody   = mysqli_real_escape_string($this->db->link,$data['productBody']);
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





			/* Delete Category
		    =======================*/

		    public function deleteProduct($prodelid){
		    	$prodelid  = mysqli_real_escape_string($this->db->link,$prodelid);
		    	$query = "SELECT * FROM tbl_product WHERE productId = '$prodelid'";
		    	$getData = $this->db->select($query);
		    	if ($getData) {
		    		while ($delImg = $getData->fetch_assoc()) {
		    		    $delLink = $delImg['productImage'];
		    		    unlink($delLink);
		    		}
		    	}

		    	$query ="DELETE FROM tbl_product WHERE productId = '$prodelid' ";
		    	$result = $this->db->delete($query);
		    	if ($result) {
		    			$successmsg = "<span class='successs'>Product Deleted Successfully !!</span>";
	    				return $successmsg;
		    		}else {
		    			$errormsg = "<span class='error'>Something went wrong !!</span>";
	    				return $errormsg;
		    		}

		    }/*End Category Delete Method */




		    /* Get Fetured Product
		    =======================*/
		    public function getFeturedProduct(){
		    	$query  = "SELECT * FROM tbl_product WHERE productType = '0' ORDER BY productId DESC LIMIT 4 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End Fetured Product Select Method */




		    /* Get New Product
		    =======================*/
		    public function getNewProduct(){
		    	$query  = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End New Product Select Method */


		    /* Get Single Product Details
		    ============================*/
		    public function getSingleProduct($proid){
		    	$proid  = mysqli_real_escape_string($this->db->link,$proid);
		    	$query = "SELECT p.*, c.catName, b.brandName
						  FROM tbl_product as p, tbl_category as c, tbl_brand as b
						  WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$proid' ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End Single Product Details Method */




		    /* Get New Brand
		    =======================*/
		    public function latestFromIphone(){
		    	$query  = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End New Brand Select Method */



		    /* Get New Brand
		    =======================*/
		    public function latestFromSamsung(){
		    	$query  = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End New Brand Select Method */



		    /* Get New Brand
		    =======================*/
		    public function latestFromIAcer(){
		    	$query  = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End New Brand Select Method */



		    /* Get New Brand
		    =======================*/
		    public function latestFromCanon(){
		    	$query  = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId DESC LIMIT 1 ";
		    	$result = $this->db->select($query);
		    	return $result;
		    }/*End New Brand Select Method */



		    /* Get Product category
		    =======================*/

		    public function productByCategory($catid){
		    	$catid  = mysqli_real_escape_string($this->db->link,$catid);
		    	$query  = "SELECT * FROM tbl_product WHERE catId = '$catid' ";
		    	$result = $this->db->select($query);
		    	return $result;

		    }/*End Product category Get Method */



		    



		    /* Insert Compare Product 
		    =======================*/

		    public function productCompare($cmrId,$productId){
		    	$cmrId  = mysqli_real_escape_string($this->db->link,$cmrId);
		    	$productId  = mysqli_real_escape_string($this->db->link,$productId);

		    	$query  = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId'";
		    	$result = $this->db->select($query);
		    	if ($result) {
		    		$warningmsg = "<span style='margin-left: 25px;' class='warning'>Products Already Added For Compare !!</span>";
	    				return $warningmsg;
		    	}

		    	$query  = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
			    	$result = $this->db->select($query)->fetch_assoc();
			    	if ($result) {
			    		    $productId    = $result['productId'];
			    		    $productName  = $result['productName'];
			    		    $productPrice = $result['productPrice'];
			    		    $productImage = $result['productImage'];

			    		    $query  = "INSERT INTO tbl_compare(cmrId,productId,productName,productPrice,productImage) VALUES('$cmrId','$productId','$productName','$productPrice','$productImage')";
			    		    $insert_row = $this->db->insert($query);
			    		    if ($insert_row) {
			    		    		$successmsg = "<span style='margin-left: 25px;' class='successs'>Added !! Check Compare Page</span>";
	    							return $successmsg;
				    		}else {
				    			$errormsg = "<span style='margin-left: 25px;' class='error'>Something went wrong !!</span>";
			    				return $errormsg;
				    		}
			    		 	
			    	}

		    }/*End Insert Compare Product */





		    /* Insert Compare Product 
		    =======================*/
		    public function getCompareProduct($cmrId){
		    	$cmrId  = mysqli_real_escape_string($this->db->link,$cmrId);
		    	$query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC";
		    	$result = $this->db->select($query);
		    	return $result;
		    	
		    }/*End Insert Compare Product */



		    /* Delete Compare Data(logout)
				 =======================*/
			    public function delComparedata($cmrId){
			    	$query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId' ";
			    	$result = $this->db->delete($query);
			    	return $result;
			    }/* End Delete Compare Data(logout)*/





	}/*End Product Class */
