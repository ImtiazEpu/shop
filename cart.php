<?php include "inc/header.php"; ?>
<?php
	if (isset($_GET['delcartid'])){
			$delcartid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delcartid']) ;
			$deleteCartById = $crt->deleteCartById($delcartid);
		}

		?>
<?php	 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	        $cartId = $_POST['cartId'];
	        $quantity = $_POST['quantity'];
			$updateCart = $crt->updateCart($cartId, $quantity);
	       
	    }
 ?>
 <?php 

 	if (!isset($_GET['id'])){
 		echo "<meta http-equiv='refresh' content='0;URL=?id=realtime'/>";
 	}  


  ?>
  <style type="text/css">
  	.tbltwo {
	float: right;
	text-align: left;
	width: 50%;
	border: 2px solid #ddd;
	margin-right: 370px;
	margin-top: 10px;
}
.tbltwo tr td{text-align: right; padding: 15px 27px 15px 10px}
  </style>
<div class="main">
	<div class="content">
		<div class="cartoption">		
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php if (isset($updateCart)) {echo $updateCart;} ?>
				<?php if (isset($deleteCartById)) {echo $deleteCartById;} ?>
				<table class="tblone">
					<tr>
						<th width="5%">SL</th>
						<th width="25%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>

					<?php 

					$getAddToCart = $crt->getAddToCart();
						if ($getAddToCart) {
							$i=0;
							$sum = 0;
							$qty = 0;
							while ($result = $getAddToCart->fetch_assoc()) {$i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['productImage']; ?>" alt=""/></td>
								<td>$<?php echo $result['productPrice']; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>$
									<?php 
									$total = $result['productPrice'] * $result['quantity'];
									echo $total; 
									?>
									
								</td>
								<td><a  class="btn btn-red" onclick="return confirm('Are you sure to Delete ?')" href="?delcartid=<?php echo $result['cartId']; ?>">Delete</a></td>
							</tr>
							<?php 
								$sum = $sum + $total;
								$qty = $qty + $result['quantity'];
								Session::set("sum",$sum);
								Session::set("qty",$qty);

							?>
						<?php }} ?>
					</table>
					<?php 
						$getCart = $crt->checkCartTable();
							 if ($getCart) {
					 ?>
					<table class="tbltwo">
                        <tr>
                            <td style="text-align:left">Sub Total</td>
                            <td>:</td>
                            <td>$ <?php echo $sum; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:left">Quantity</td>
                            <td>:</td>
                            <td><?php echo $qty; ?></td>
                        </tr>
                        <tr style="border-bottom: 2px solid #ddd">
                            <td style="text-align:left">VAT(15%)</td>
                            <td>:</td>
                            <td>(+) <?php echo $vat = $sum * 0.15; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align:left">Grand Total</td>
                            <td>:</td>
                            <td>
                                $ <?php 
                                $vat = $sum * 0.15;
                                $gTotal = $sum + $vat;
                                echo $gTotal;
                                ?>
                            </td>
                        </tr>
                    </table>
				<?php }else {
					echo "<script type='text/javascript'>window.top.location='index.php';</script>"; 
				}
					?>
				</div>
				<div class="shopping">
					<div class="shopleft">
						<a href="index.php"> <img src="images/shop.png" alt="" /></a>
					</div>
					<div class="shopright">
						<a href="payment.php"> <img src="images/check.png" alt="" /></a>
					</div>
				</div>
			</div>  	
			<div class="clear"></div>
		</div>
	</div>
	<?php include "inc/footer.php" ?>