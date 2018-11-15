<?php include "inc/header.php"; ?>

  <style type="text/css">
  	
table.tblone img{ height: 90px; width: 100px; }
  </style>
<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>Product Compare</h2>
				<?php if (isset($updateCart)) {echo $updateCart;} ?>
				<?php if (isset($deleteCartById)) {echo $deleteCartById;} ?>
				<table class="tblone">
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>
					</tr>

					<?php 
					$cmrId =Session::get("cmrId"); 
					$getCompareProduct = $prod->getCompareProduct($cmrId);
						if ($getCompareProduct) {
							$i=0;
							while ($result = $getCompareProduct->fetch_assoc()) {$i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><?php echo $result['productPrice']; ?></td>
								<td><img src="admin/<?php echo $result['productImage']; ?>" alt=""/></td>
								<td><a class="btn btn-blue" href="preview.php?proid=<?php echo $result['productId']; ?>">View</a></td>
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