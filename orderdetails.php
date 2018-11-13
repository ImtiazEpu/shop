<?php include "inc/header.php"; ?>
<?php 
	
	$login = Session::get("login");
	if ($login==false) {
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
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
								<td>
									<?php 
										if ($result['status'] == 0 ) {
											echo "Pending";
										}else {
											echo "Confrirm";
										}
									?>
									
								</td>
								<?php 
									if ($result['status'] == 1 ) {?>
								<td><a  class="btn btn-red" onclick="return confirm('Are you sure to Delete ?')" href="">Delete</a></td>
							<?php }else {?>
								<td>N/A</td>
							<?php } ?>
							</tr>
						<?php }} ?>
					</table>
    			</div>
		</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include "inc/footer.php" ?>