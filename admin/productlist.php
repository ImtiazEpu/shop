<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../Classes/Product.php";?>
<?php include_once "../helpers/Formate.php";  ?>

<?php 
	$prod = new Product();
	$fm   = new Formate();

 ?>
 <?php 
 	if (isset($_GET['prodelid'])) {
         $prodelid  = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['prodelid']);
         $deleteProduct = $prod->deleteProduct($prodelid);
        }

  ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <?php if (isset($deleteProduct)) {echo $deleteProduct; }?> 
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="3%">No</th>
					<th width="15%">Product Name</th>
					<th width="12%">Category</th>
					<th width="5%">Brand</th>
					<th width="20%">Description</th>
					<th width="10%">Price</th>
					<th width="10%">Image</th>
					<th width="10%">Type</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$getPorduct = $prod->getAllProduct();
					if ($getPorduct) {
						$i=0;
						while ($result = $getPorduct->fetch_assoc()) { $i++;?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td><?php echo $result['brandName']; ?></td>
					<td><?php echo $fm->textShorten($result['productBody'],50); ?></td>
					<td>$<?php echo $result['productPrice']; ?></td>
					<td><img src="<?php echo $result['productImage']; ?>" height="40px" width="60px" alt=""></td>
					<td>
						<?php 
							if ($result['productType'] == 0) {
							 	echo "Featured";
							 }else {
							 	echo "General";
							 }
						?>
							
					</td>
					<td><a class="btn btn-info" href="editpro.php?proeditid=<?php echo $result['productId']; ?>">Edit</a>  <a class="btn btn-danger" onclick="return confirm('Are you sure to Delete ?');" href="?prodelid=<?php echo $result['productId']; ?>">Delete</a></td>
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
