<?php include "inc/header.php"; ?>


<?php 
	if (isset($_GET['proid'])){
		$proid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']) ;
	}

	    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	        $quantity = $_POST['quantity'];

	        $addToCart = $crt->addToCart($quantity, $proid);
	    }

?>
<?php
	$cmrId =Session::get("cmrId"); 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
		 $productId = $_POST['productId'];
        $productCompare = $prod->productCompare($cmrId,$productId);
    }
 ?>




	    <div class="main">
	    	<div class="content">
	    		<div class="section group">
	    			<div class="cont-desc span_1_of_2">	

	    				<?php 
							$getSingleProduct = $prod->getSingleProduct($proid);
		    				if ($getSingleProduct) {
		    					while ($result = $getSingleProduct->fetch_assoc()) {?>			
	    						<div class="grid images_3_of_2">
	    							<img src="admin/<?php echo $result['productImage']; ?>" alt="" />
	    						</div>
	    						<div style="margin-bottom: 2%" class="desc span_3_of_2">
	    							<h2><?php echo $result['productName']; ?></h2>				
	    							<div class="price">
	    								<p>Price: <span>$<?php echo $result['productPrice']; ?></span></p>
	    								<p>Category: <span><?php echo $result['catName']; ?></span></p>
	    								<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
	    							</div>
	    							<div class="add-cart">
	    								<form action="" method="post">
	    									<input type="number" class="buyfield" name="quantity" value="1"/>
	    									<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
	    								</form>				
	    							</div>
	    						</div>
	    						<?php if (isset($addToCart)) {echo $addToCart;} ?>
								<?php if (isset($productCompare)) {echo $productCompare;} ?>

								<?php 
									$login = Session::get("login");
									if ($login==true) {?> 
								<div style="margin-bottom: 2%" class="desc span_3_of_2">
									<div class="add-cart">
		    								<form action="" method="post">
		    									<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
		    									<input type="submit" class="buysubmit" name="compare" value="Add To Compare"/>
		    								</form>				
		    						</div>
		    					</div>
		    					<?php } ?>
	    						<div class="product-desc">
	    							<h2>Product Details</h2>
	    							<?php echo $result['productBody']; ?>
	    						</div>
	    					<?php }} ?>	
	    				</div>
	    				<div class="rightsidebar span_3_of_1">
	    					<h2>CATEGORIES</h2>
	    					<ul>
	    						<?php 
	    							$getALLCategory = $cat->getALLCategory();
	    							if ($getALLCategory) {
	    								while ($result = $getALLCategory->fetch_assoc()) {?>
	    						<li><a href="productbycat.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
	    						<?php }} ?>
	    					</ul>

	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<?php include "inc/footer.php" ?>