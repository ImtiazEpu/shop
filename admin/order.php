<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

	$filepath = realpath(dirname(__FILE__));

	include_once ($filepath."/../classes/Cart.php"); 
	include_once ($filepath."/../helpers/Formate.php");
	$fm =  new Formate();
	$crt = new Cart();
?>
<?php 
	if (isset($_GET['shippedid'])) {
		$id = $_GET['shippedid'];
		$time = $_GET['time'];
		$price = $_GET['price'];

		$shipped = $crt->productShipped($id,$time,$price);
	}

	if (isset($_GET['delid'])) {
		$id = $_GET['shippedid'];
		$time = $_GET['time'];
		$price = $_GET['price'];

		$deletConfirmOrder = $crt->deletConfirmOrder($id,$time,$price);
		
	}

 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Order Data</h2>
                 <?php if (isset($shipped)) {
                	echo $shipped;
                } ?> 
                <?php if (isset($deletConfirmOrder)) {
                	echo $deletConfirmOrder;
                } ?>  
                <div class="block"> 
                     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date & Time</th>
							<th>Image</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							
							$getOrder = $crt->getAllOrderProduct();
								if ($getOrder) {
									while ($result = $getOrder->fetch_assoc()) {?>
										<tr class="odd gradeX">
											<td><?php echo $result['id']; ?></td>
											<td><?php echo $fm->formateDate($result['date']); ?></td>
											<td><img src="<?php echo $result['productImage']; ?>"width="20%" alt=""/></td>
											<td><?php echo $result['productName']; ?></td>
											<td><?php echo $result['quantity']; ?></td>
											<td>$<?php echo $result['productPrice']; ?></td>
											<td><?php echo $result['cmrId']; ?></td>
											<td><a class="btn btn-blue" href="customeaddress.php?custid=<?php echo $result['cmrId']; ?>">View Details</a></td>
											<?php 
												if ($result['status'] == '0') {?>
													<td><a class="btn btn-green" href="?shippedid=<?php echo $result['cmrId'];?>&price=<?php echo $result['productPrice'];?>&time=<?php echo $result['date'];?>">Confirm Order </a></td>
													
												<?php }else { ?>
													<td><a class="btn btn-red" href="?delid=<?php echo $result['cmrId'];?>&price=<?php echo $result['productPrice'];?>&time=<?php echo $result['date'];?>">Detete</a></td>
												<?php } ?>
										</tr>
								<?php }} ?>
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
