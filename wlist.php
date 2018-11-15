<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}

 ?>

<?php 
	if (isset($_GET['delwlist'])) {
		$productId = $_GET['delwlist'];
		$delWlistdata = $prod->delWlistdata($productId,$cmrId);
	}

 ?>

  <style type="text/css">
  	
table.tblone img{ height: 90px; width: 100px; }
  </style>
<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>WishList</h2>
				<?php if (isset($delWlistdata)) {echo $delWlistdata;} ?>
				<table class="tblone">
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>
					</tr>

					<?php  
					$getWishlist = $prod->getWishlist($cmrId);
						if ($getWishlist) {
							$i=0;
							while ($result = $getWishlist->fetch_assoc()) {$i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$<?php echo $result['productPrice']; ?></td>
								<td><img src="admin/<?php echo $result['productImage']; ?>" alt=""/></td>
								<td>
									<a class="btn btn-green" href="preview.php?proid=<?php echo $result['productId']; ?>">Buy Now</a> 
									<a class="btn btn-red" href="?delwlist=<?php echo $result['productId']; ?>">Remove</a>
								</td>
							</tr>
							
						<?php }} ?>
					</table>
					
				</div>
				<div class="shopping">
					<div class="shopcenter">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
				</div>
			</div>  	
			<div class="clear"></div>
		</div>
	</div>
	<?php include "inc/footer.php" ?>