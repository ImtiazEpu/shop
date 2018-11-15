<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
	}

 ?>
 <?php 

 	if (isset($_GET['customerid'])) {
		$id    = $_GET['customerid'];
		$time  = $_GET['time'];
		$price = $_GET['price'];

		$confirmOrder = $crt->confirmOrder($id,$time,$price);
		
	}

  ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="Order">
    				<h2>Your Order Details</h2>
    				<table class="tblone">
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Image</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>

					<?php 
					$cmrId = Session::get("cmrId");
					$getOrderDetails = $crt->getOrderDetails($cmrId);
						if ($getOrderDetails) {
							$i=0;
							while ($result = $getOrderDetails->fetch_assoc()) {$i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['productImage']; ?>" alt=""/></td>
								<td><?php echo $result['quantity']; ?></td>
								<td>$ <?php echo $result['productPrice']; ?></td>
								<td><?php echo $fm->formateDate($result['date']); ?></td>


									<?php if ($result['status'] == '1' ) {?>
										<td><a class="btn btn-grey" href="#">N/A</a></td>
									<?php }elseif ($result['status'] == '2' ){?>
										<td><a class="btn btn-green" href="#">Order Received</a></td>
									<?php }elseif ($result['status'] == '0' ) {?>
										<td><a class="btn btn-grey" href="#">N/A</a></td>
									<?php } ?>

									<td>

										<?php 
											if ($result['status'] == '0' ) {
												echo "<a class='btn btn-orange' href='#'>Pending</a>";

											}elseif ($result['status'] == '1'){
													echo "<a class='btn btn-blue' href='#'>Shipped</a>";
											}else {
													echo "<a class='btn btn-green' href='#'>Confirm</a>";
											} 
										?>
									</td>

									
								

								


							</tr>
						<?php }} ?>
					</table>
    			</div>
		</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include "inc/footer.php" ?>

